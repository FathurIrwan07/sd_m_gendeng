<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use Illuminate\Http\Request;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriKegiatan::withCount('kegiatan')->get();
        return view('admin.kategori-kegiatan.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori_kegiatan,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
        ]);

        KategoriKegiatan::create($validated);

        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKegiatan $kategoriKegiatan)
    {
        $kategoriKegiatan->load('kegiatan.user');
        return view('admin.kategori-kegiatan.show', compact('kategoriKegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKegiatan $kategoriKegiatan)
    {
        return view('admin.kategori-kegiatan.edit', compact('kategoriKegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriKegiatan $kategoriKegiatan)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:50|unique:kategori_kegiatan,nama_kategori,' . $kategoriKegiatan->id_kategori . ',id_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.max' => 'Nama kategori maksimal 50 karakter',
            'nama_kategori.unique' => 'Kategori ini sudah ada',
        ]);

        $kategoriKegiatan->update($validated);

        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKegiatan $kategoriKegiatan)
    {
        // Cek apakah kategori memiliki kegiatan
        if ($kategoriKegiatan->kegiatan()->count() > 0) {
            return redirect()->route('kategori-kegiatan.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki program kegiatan.');
        }

        $kategoriKegiatan->delete();

        return redirect()->route('kategori-kegiatan.index')
            ->with('success', 'Kategori kegiatan berhasil dihapus.');
    }
}