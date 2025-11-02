<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriPengaduan::withCount('pengaduan')->get();
        return view('admin.kategori-pengaduan.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
        ]);

        KategoriPengaduan::create($validated);

        return redirect()->route('kategori-pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriPengaduan $kategoriPengaduan)
    {
        $kategoriPengaduan->load('pengaduan.pelapor', 'pengaduan.tanggapan');
        return view('admin.kategori-pengaduan.show', compact('kategoriPengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriPengaduan $kategoriPengaduan)
    {
        return view('admin.kategori-pengaduan.edit', compact('kategoriPengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriPengaduan $kategoriPengaduan)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori,' . $kategoriPengaduan->id_kategori . ',id_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
        ]);

        $kategoriPengaduan->update($validated);

        return redirect()->route('kategori-pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPengaduan $kategoriPengaduan)
    {
        // Cek apakah kategori memiliki pengaduan
        if ($kategoriPengaduan->pengaduan()->count() > 0) {
            return redirect()->route('kategori-pengaduan.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki pengaduan.');
        }

        $kategoriPengaduan->delete();

        return redirect()->route('kategori-pengaduan.index')
            ->with('success', 'Kategori pengaduan berhasil dihapus.');
    }
}