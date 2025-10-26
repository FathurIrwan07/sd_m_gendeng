<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KategoriKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatan = Kegiatan::with(['kategori', 'user'])->latest()->get();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriKegiatan::all();
        return view('admin.kegiatan.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_kegiatan,id_kategori',
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_program' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'id_kategori.required' => 'Kategori kegiatan wajib dipilih',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_program.max' => 'Nama program maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi program wajib diisi',
            'foto_program.image' => 'File harus berupa gambar',
            'foto_program.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'foto_program.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('foto_program')) {
            $validated['foto_program'] = $request->file('foto_program')->store('foto-kegiatan', 'public');
        }

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Program kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load(['kategori', 'user']);
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        $kategori = KategoriKegiatan::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_kegiatan,id_kategori',
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_program' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'id_kategori.required' => 'Kategori kegiatan wajib dipilih',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_program.max' => 'Nama program maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi program wajib diisi',
            'foto_program.image' => 'File harus berupa gambar',
            'foto_program.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'foto_program.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('foto_program')) {
            // Delete old photo if exists
            if ($kegiatan->foto_program) {
                Storage::disk('public')->delete($kegiatan->foto_program);
            }
            $validated['foto_program'] = $request->file('foto_program')->store('foto-kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Program kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        // Delete photo if exists
        if ($kegiatan->foto_program) {
            Storage::disk('public')->delete($kegiatan->foto_program);
        }

        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Program kegiatan berhasil dihapus.');
    }

    public function deletePhoto($id_kegiatan)
    {
        $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)->firstOrFail();
        
        if ($kegiatan->foto_program) {
            Storage::disk('public')->delete($kegiatan->foto_program);
            $kegiatan->update(['foto_program' => null]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}