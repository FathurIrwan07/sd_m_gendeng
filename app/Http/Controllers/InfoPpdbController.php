<?php

namespace App\Http\Controllers;

use App\Models\InfoPpdb;
use App\Models\GelombangPpdb;
use App\Models\TahapanPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InfoPpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoPpdb = InfoPpdb::with(['user', 'gelombang' => function($query) {
            $query->orderBy('nomor_gelombang');
        }, 'gelombang.tahapan'])->latest()->get();
        foreach ($infoPpdb as $item) {
            foreach ($item->gelombang as $gelombang) {
                $gelombang->updateStatus(); // ← Gunakan method dari model
            }
        }
        
        return view('admin.info-ppdb.index', compact('infoPpdb'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.info-ppdb.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:20',
            'syarat_pendaftaran' => 'required|string',
            'biaya_pendaftaran' => 'required|string|max:50',
            'keterangan_biaya' => 'nullable|string',
            'gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'lokasi_kantor' => 'nullable|string|max:255',
            'link_pendaftaran' => 'nullable|url|max:255',
            
            // Gelombang
            'gelombang.*.nama_gelombang' => 'required|string|max:50',
            'gelombang.*.nomor_gelombang' => 'required|integer|min:1',
            'gelombang.*.tanggal_mulai' => 'required|date',
            'gelombang.*.tanggal_selesai' => 'required|date|after_or_equal:gelombang.*.tanggal_mulai',
            'gelombang.*.keterangan' => 'nullable|string',
            
            // Tahapan per gelombang
            'gelombang.*.tahapan.*.nama_tahapan' => 'required|string|max:100',
            'gelombang.*.tahapan.*.deskripsi' => 'nullable|string',
            'gelombang.*.tahapan.*.tanggal_mulai' => 'required|date',
            'gelombang.*.tahapan.*.tanggal_selesai' => 'required|date|after_or_equal:gelombang.*.tahapan.*.tanggal_mulai',
        ], [
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'status.required' => 'Status wajib dipilih',
            'syarat_pendaftaran.required' => 'Syarat pendaftaran wajib diisi',
            'biaya_pendaftaran.required' => 'Biaya pendaftaran wajib diisi',
            'gambar_brosur.image' => 'File harus berupa gambar',
            'gambar_brosur.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'gambar_brosur.max' => 'Ukuran gambar maksimal 2MB',
            'gelombang.*.nama_gelombang.required' => 'Nama gelombang wajib diisi',
            'gelombang.*.nomor_gelombang.required' => 'Nomor gelombang wajib diisi',
            'gelombang.*.tanggal_mulai.required' => 'Tanggal mulai gelombang wajib diisi',
            'gelombang.*.tanggal_selesai.required' => 'Tanggal selesai gelombang wajib diisi',
            'gelombang.*.tahapan.*.nama_tahapan.required' => 'Nama tahapan wajib diisi',
            'gelombang.*.tahapan.*.tanggal_mulai.required' => 'Tanggal mulai tahapan wajib diisi',
            'gelombang.*.tahapan.*.tanggal_selesai.required' => 'Tanggal selesai tahapan wajib diisi',
        ]);

        DB::beginTransaction();
        try {
            $validated['user_id'] = auth()->id();

            // Handle file upload
            if ($request->hasFile('gambar_brosur')) {
                $validated['gambar_brosur'] = $request->file('gambar_brosur')->store('ppdb', 'public');
            }

            // Create Info PPDB
            $infoPpdb = InfoPpdb::create($validated);

            // Create Gelombang dan Tahapan
            if ($request->has('gelombang')) {
                foreach ($request->gelombang as $gelombangData) {
                    $gelombang = GelombangPpdb::create([
                        'id_info_ppdb' => $infoPpdb->id_info_ppdb,
                        'nama_gelombang' => $gelombangData['nama_gelombang'],
                        'nomor_gelombang' => $gelombangData['nomor_gelombang'],
                        'tanggal_mulai' => $gelombangData['tanggal_mulai'],
                        'tanggal_selesai' => $gelombangData['tanggal_selesai'],
                        'keterangan' => $gelombangData['keterangan'] ?? null,
                        'status' => 'belum_mulai'
                    ]);

                    // Create Tahapan for this Gelombang
                    if (isset($gelombangData['tahapan'])) {
                        foreach ($gelombangData['tahapan'] as $index => $tahapan) {
                            TahapanPpdb::create([
                                'id_gelombang' => $gelombang->id_gelombang,
                                'urutan' => $index + 1,
                                'nama_tahapan' => $tahapan['nama_tahapan'],
                                'deskripsi' => $tahapan['deskripsi'] ?? null,
                                'tanggal_mulai' => $tahapan['tanggal_mulai'],
                                'tanggal_selesai' => $tahapan['tanggal_selesai'],
                            ]);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('info-ppdb.index')
                ->with('success', 'Info PPDB, gelombang, dan tahapan berhasil ditambahkan.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InfoPpdb $infoPpdb)
    {
        $infoPpdb->load(['user', 'gelombang' => function($query) {
            $query->orderBy('nomor_gelombang')->with('tahapan');
        }]);
        
        return view('admin.info-ppdb.show', compact('infoPpdb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoPpdb $infoPpdb)
    {
        $infoPpdb->load(['gelombang' => function($query) {
            $query->orderBy('nomor_gelombang')->with(['tahapan' => function($q) {
                $q->orderBy('urutan');
            }]);
        }]);
        
        return view('admin.info-ppdb.edit', compact('infoPpdb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoPpdb $infoPpdb)
    {
        $validated = $request->validate([
            'tahun_ajaran' => 'required|string|max:20',

            'syarat_pendaftaran' => 'required|string',
            'biaya_pendaftaran' => 'required|string|max:50',
            'keterangan_biaya' => 'nullable|string',
            'gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'lokasi_kantor' => 'nullable|string|max:255',
            'link_pendaftaran' => 'nullable|url|max:255',
            
            // Gelombang
            'gelombang.*.id_gelombang' => 'nullable|integer',
            'gelombang.*.nama_gelombang' => 'required|string|max:50',
            'gelombang.*.nomor_gelombang' => 'required|integer|min:1',
            'gelombang.*.tanggal_mulai' => 'required|date',
            'gelombang.*.tanggal_selesai' => 'required|date|after_or_equal:gelombang.*.tanggal_mulai',
            'gelombang.*.keterangan' => 'nullable|string',
            
            // Tahapan per gelombang
            'gelombang.*.tahapan.*.id_tahapan' => 'nullable|integer',
            'gelombang.*.tahapan.*.nama_tahapan' => 'required|string|max:100',
            'gelombang.*.tahapan.*.deskripsi' => 'nullable|string',
            'gelombang.*.tahapan.*.tanggal_mulai' => 'required|date',
            'gelombang.*.tahapan.*.tanggal_selesai' => 'required|date|after_or_equal:gelombang.*.tahapan.*.tanggal_mulai',
        ]);

        DB::beginTransaction();
        try {
            $validated['user_id'] = auth()->id();

            // Handle file upload
            if ($request->hasFile('gambar_brosur')) {
                if ($infoPpdb->gambar_brosur) {
                    Storage::disk('public')->delete($infoPpdb->gambar_brosur);
                }
                $validated['gambar_brosur'] = $request->file('gambar_brosur')->store('ppdb', 'public');
            }

            // Update Info PPDB
            $infoPpdb->update($validated);

            // Track gelombang IDs yang masih digunakan
            $newGelombangIds = [];
            $existingGelombangIds = $infoPpdb->gelombang()->pluck('id_gelombang')->toArray();

            // Update atau create Gelombang
            if ($request->has('gelombang')) {
                foreach ($request->gelombang as $gelombangData) {
                    $gelombangId = $gelombangData['id_gelombang'] ?? null;

                    if ($gelombangId && in_array($gelombangId, $existingGelombangIds)) {
                        // Update existing gelombang
                        $gelombang = GelombangPpdb::find($gelombangId);
                        $gelombang->update([
                            'nama_gelombang' => $gelombangData['nama_gelombang'],
                            'nomor_gelombang' => $gelombangData['nomor_gelombang'],
                            'tanggal_mulai' => $gelombangData['tanggal_mulai'],
                            'tanggal_selesai' => $gelombangData['tanggal_selesai'],
                            'keterangan' => $gelombangData['keterangan'] ?? null,
                        ]);
                        $newGelombangIds[] = $gelombangId;
                    } else {
                        // Create new gelombang
                        $gelombang = GelombangPpdb::create([
                            'id_info_ppdb' => $infoPpdb->id_info_ppdb,
                            'nama_gelombang' => $gelombangData['nama_gelombang'],
                            'nomor_gelombang' => $gelombangData['nomor_gelombang'],
                            'tanggal_mulai' => $gelombangData['tanggal_mulai'],
                            'tanggal_selesai' => $gelombangData['tanggal_selesai'],
                            'keterangan' => $gelombangData['keterangan'] ?? null,
                            'status' => 'belum_mulai'
                        ]);
                        $newGelombangIds[] = $gelombang->id_gelombang;
                    }

                    // Handle Tahapan for this Gelombang
                    $newTahapanIds = [];
                    $existingTahapanIds = TahapanPpdb::where('id_gelombang', $gelombang->id_gelombang)
                        ->pluck('id_tahapan')->toArray();

                    if (isset($gelombangData['tahapan'])) {
                        foreach ($gelombangData['tahapan'] as $index => $tahapan) {
                            $tahapanId = $tahapan['id_tahapan'] ?? null;

                            if ($tahapanId && in_array($tahapanId, $existingTahapanIds)) {
                                // Update existing tahapan
                                $tahapanObj = TahapanPpdb::find($tahapanId);
                                $tahapanObj->update([
                                    'urutan' => $index + 1,
                                    'nama_tahapan' => $tahapan['nama_tahapan'],
                                    'deskripsi' => $tahapan['deskripsi'] ?? null,
                                    'tanggal_mulai' => $tahapan['tanggal_mulai'],
                                    'tanggal_selesai' => $tahapan['tanggal_selesai'],
                                ]);
                                $newTahapanIds[] = $tahapanId;
                            } else {
                                // Create new tahapan
                                TahapanPpdb::create([
                                    'id_gelombang' => $gelombang->id_gelombang,
                                    'urutan' => $index + 1,
                                    'nama_tahapan' => $tahapan['nama_tahapan'],
                                    'deskripsi' => $tahapan['deskripsi'] ?? null,
                                    'tanggal_mulai' => $tahapan['tanggal_mulai'],
                                    'tanggal_selesai' => $tahapan['tanggal_selesai'],
                                ]);
                            }
                        }
                    }

                    // Delete tahapan yang dihapus
                    $tahapanToDelete = array_diff($existingTahapanIds, $newTahapanIds);
                    if (!empty($tahapanToDelete)) {
                        TahapanPpdb::whereIn('id_tahapan', $tahapanToDelete)->delete();
                    }
                }
            }

            // Delete gelombang yang dihapus
            $gelombangToDelete = array_diff($existingGelombangIds, $newGelombangIds);
            if (!empty($gelombangToDelete)) {
                GelombangPpdb::whereIn('id_gelombang', $gelombangToDelete)->delete();
            }

            DB::commit();
            return redirect()->route('info-ppdb.index')
                ->with('success', 'Info PPDB, gelombang, dan tahapan berhasil diperbarui.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoPpdb $infoPpdb)
    {
        DB::beginTransaction();
        try {
            // Delete photo if exists
            if ($infoPpdb->gambar_brosur) {
                Storage::disk('public')->delete($infoPpdb->gambar_brosur);
            }

            // Delete gelombang dan tahapannya (cascade will handle this if FK is set)
            GelombangPpdb::where('id_info_ppdb', $infoPpdb->id_info_ppdb)->delete();
            
            // Delete info PPDB
            $infoPpdb->delete();

            DB::commit();
            return redirect()->route('info-ppdb.index')
                ->with('success', 'Info PPDB, gelombang, dan tahapan berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Delete brosur from info PPDB
     */
    public function deleteBrosur($id)
    {
        $infoPpdb = InfoPpdb::findOrFail($id);
        
        if ($infoPpdb->gambar_brosur) {
            Storage::disk('public')->delete($infoPpdb->gambar_brosur);
            $infoPpdb->update(['gambar_brosur' => null]);
        }

        return back()->with('success', 'Brosur berhasil dihapus.');
    }
}