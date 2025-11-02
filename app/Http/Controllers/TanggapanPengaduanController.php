<?php

namespace App\Http\Controllers;

use App\Models\TanggapanPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TanggapanPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggapan = TanggapanPengaduan::with(['pengaduan.pelapor', 'pengaduan.kategori', 'penanggap'])
            ->latest()
            ->get();
        
        return view('admin.tanggapan.index', compact('tanggapan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pengaduanId = $request->query('pengaduan_id');
        $pengaduan = null;
        
        if ($pengaduanId) {
            $pengaduan = Pengaduan::with(['pelapor', 'kategori'])->find($pengaduanId);
        }
        
        $pengaduanList = Pengaduan::with(['pelapor', 'kategori'])
            ->whereDoesntHave('tanggapan')
            ->where('status_pengaduan', '!=', 'Selesai')
            ->where('status_pengaduan', '!=', 'Ditolak')
            ->get();
        
        return view('admin.tanggapan.create', compact('pengaduanList', 'pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'required|date',
        ], [
            'id_pengaduan.required' => 'Pengaduan wajib dipilih',
            'id_pengaduan.exists' => 'Pengaduan tidak ditemukan',
            'isi_tanggapan.required' => 'Isi tanggapan wajib diisi',
            'tanggal_tanggapan.required' => 'Tanggal tanggapan wajib diisi',
            'tanggal_tanggapan.date' => 'Format tanggal tidak valid',
        ]);

        // Check if pengaduan already has tanggapan
        $existingTanggapan = TanggapanPengaduan::where('id_pengaduan', $validated['id_pengaduan'])->first();
        if ($existingTanggapan) {
            return back()->withErrors(['id_pengaduan' => 'Pengaduan ini sudah memiliki tanggapan.'])->withInput();
        }

        // Set user_id from authenticated admin
        $validated['user_id'] = auth()->id();

        $tanggapan = TanggapanPengaduan::create($validated);

        // Update status pengaduan to "Diproses"
        $tanggapan->pengaduan->update(['status_pengaduan' => 'Diproses']);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil ditambahkan dan status pengaduan diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TanggapanPengaduan $tanggapan)
    {
        $tanggapan->load(['pengaduan.pelapor', 'pengaduan.kategori', 'penanggap']);
        return view('admin.tanggapan.show', compact('tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TanggapanPengaduan $tanggapan)
    {
        $tanggapan->load(['pengaduan.pelapor', 'pengaduan.kategori']);
        return view('admin.tanggapan.edit', compact('tanggapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TanggapanPengaduan $tanggapan)
    {
        $validated = $request->validate([
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'required|date',
        ], [
            'isi_tanggapan.required' => 'Isi tanggapan wajib diisi',
            'tanggal_tanggapan.required' => 'Tanggal tanggapan wajib diisi',
            'tanggal_tanggapan.date' => 'Format tanggal tidak valid',
        ]);

        $tanggapan->update($validated);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TanggapanPengaduan $tanggapan)
    {
        // Update status pengaduan back to "Menunggu Konfirmasi"
        $tanggapan->pengaduan->update(['status_pengaduan' => 'Menunggu Konfirmasi']);
        
        $tanggapan->delete();

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil dihapus dan status pengaduan dikembalikan.');
    }
}