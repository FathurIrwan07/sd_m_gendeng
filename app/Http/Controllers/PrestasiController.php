<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $prestasi = Prestasi::with('user')->latest()->get();
        return view('admin.prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'nama_peraih' => 'required|string|max:150',
            'tingkat_prestasi' => 'required|in:Internasional,Nasional,Provinsi,Kabupaten/Kota,Kecamatan',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul_prestasi.required' => 'Judul prestasi wajib diisi',
            'judul_prestasi.max' => 'Judul prestasi maksimal 255 karakter',
            'nama_peraih.required' => 'Nama peraih prestasi wajib diisi',
            'nama_peraih.max' => 'Nama peraih maksimal 150 karakter',
            'tingkat_prestasi.required' => 'Tingkat prestasi wajib dipilih',
            'tingkat_prestasi.in' => 'Tingkat prestasi tidak valid',
            'tanggal.date' => 'Format tanggal tidak valid',
            'deskripsi.required' => 'Deskripsi prestasi wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        Prestasi::create($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $prestasi->load('user');
        return view('admin.prestasi.show', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'judul_prestasi' => 'required|string|max:255',
            'nama_peraih' => 'required|string|max:150',
            'tingkat_prestasi' => 'required|in:Internasional,Nasional,Provinsi,Kabupaten/Kota,Kecamatan',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul_prestasi.required' => 'Judul prestasi wajib diisi',
            'judul_prestasi.max' => 'Judul prestasi maksimal 255 karakter',
            'nama_peraih.required' => 'Nama peraih prestasi wajib diisi',
            'nama_peraih.max' => 'Nama peraih maksimal 150 karakter',
            'tingkat_prestasi.required' => 'Tingkat prestasi wajib dipilih',
            'tingkat_prestasi.in' => 'Tingkat prestasi tidak valid',
            'tanggal.date' => 'Format tanggal tidak valid',
            'deskripsi.required' => 'Deskripsi prestasi wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old photo if exists
            if ($prestasi->gambar) {
                Storage::disk('public')->delete($prestasi->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('prestasi', 'public');
        }

        $prestasi->update($validated);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        // Delete photo if exists
        if ($prestasi->gambar) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    /**
     * Delete photo from prestasi
     */
    public function deletePhoto($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        
        if ($prestasi->gambar) {
            Storage::disk('public')->delete($prestasi->gambar);
            $prestasi->update(['gambar' => null]);
        }

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}