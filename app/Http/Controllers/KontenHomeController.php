<?php

namespace App\Http\Controllers;

use App\Models\KontenHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KontenHomeController extends Controller
{
    public function publicIndex()
    {
        $sambutan = KontenHome::where('tipe_konten', 'Sambutan')->first();
        $visi = KontenHome::where('tipe_konten', 'Visi')->first();
        $misi = KontenHome::where('tipe_konten', 'Misi')->first();
        
        return view('about', compact('sambutan', 'visi', 'misi'));
    }
    
    public function index()
    {
        $sambutan = KontenHome::where('tipe_konten', 'Sambutan')->first();
        $visi = KontenHome::where('tipe_konten', 'Visi')->first();
        $misi = KontenHome::where('tipe_konten', 'Misi')->first();
        
        return view('admin.konten-home.index', compact('sambutan', 'visi', 'misi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_konten' => ['required', Rule::in(['Sambutan', 'Visi', 'Misi']), 'unique:konten_home,tipe_konten'],
            'isi_konten' => 'required|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'tipe_konten.unique' => 'Konten ' . $request->tipe_konten . ' sudah ada.',
            'isi_konten.required' => 'Isi konten wajib diisi.',
            'foto_kepsek.image' => 'File harus berupa gambar.',
            'foto_kepsek.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('foto_kepsek')) {
            $validated['foto_kepsek_url'] = $request->file('foto_kepsek')->store('foto-kepsek', 'public');
        }

        KontenHome::create($validated);

        return redirect()->route('konten-home.index')
            ->with('success', 'Konten ' . $request->tipe_konten . ' berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kontenHome = KontenHome::findOrFail($id);
        
        $validated = $request->validate([
            'tipe_konten' => ['required', Rule::in(['Sambutan', 'Visi', 'Misi']), Rule::unique('konten_home', 'tipe_konten')->ignore($kontenHome->home_id, 'home_id')],
            'isi_konten' => 'required|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'isi_konten.required' => 'Isi konten wajib diisi.',
            'foto_kepsek.image' => 'File harus berupa gambar.',
            'foto_kepsek.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('foto_kepsek')) {
            // Delete old photo if exists
            if ($kontenHome->foto_kepsek_url) {
                Storage::disk('public')->delete($kontenHome->foto_kepsek_url);
            }
            $validated['foto_kepsek_url'] = $request->file('foto_kepsek')->store('foto-kepsek', 'public');
        }

        $kontenHome->update($validated);

        return redirect()->route('konten-home.index')
            ->with('success', 'Konten ' . $request->tipe_konten . ' berhasil diperbarui.');
    }

    /**
     * Delete photo from konten
     */
    public function deletePhoto($id)
    {
        $kontenHome = KontenHome::findOrFail($id);
        
        if ($kontenHome->foto_kepsek_url) {
            Storage::disk('public')->delete($kontenHome->foto_kepsek_url);
            $kontenHome->update(['foto_kepsek_url' => null]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}