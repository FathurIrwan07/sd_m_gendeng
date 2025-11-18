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
        $kontenHome = KontenHome::with('user')->get();
        return view('admin.konten-home.index', compact('kontenHome')); // ← UBAH INI
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.konten-home.create'); // ← UBAH INI
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_konten' => ['required', Rule::in(['Sambutan', 'Visi', 'Misi']), 'unique:konten_home,tipe_konten'],
            'judul_konten' => 'nullable|string|max:50',
            'isi_konten' => 'required|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('foto_kepsek')) {
            $validated['foto_kepsek_url'] = $request->file('foto_kepsek')->store('foto-kepsek', 'public');
        }

        KontenHome::create($validated);

        return redirect()->route('konten-home.index')
            ->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $kontenHome = KontenHome::with(['user.role']) // Eager load user dan role
        ->findOrFail($id);
    
    return view('admin.konten-home.show', compact('kontenHome'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontenHome $kontenHome)
    {
        return view('admin.konten-home.edit', compact('kontenHome')); // ← UBAH INI
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontenHome $kontenHome)
    {
        $validated = $request->validate([
            'tipe_konten' => ['required', Rule::in(['Sambutan', 'Visi', 'Misi']), Rule::unique('konten_home', 'tipe_konten')->ignore($kontenHome->home_id, 'home_id')],
            'judul_konten' => 'nullable|string|max:50',
            'isi_konten' => 'required|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            ->with('success', 'Konten berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontenHome $kontenHome)
    {
        // Delete photo if exists
        if ($kontenHome->foto_kepsek_url) {
            Storage::disk('public')->delete($kontenHome->foto_kepsek_url);
        }

        $kontenHome->delete();

        return redirect()->route('konten-home.index')
            ->with('success', 'Konten berhasil dihapus.');
    }

    /**
     * Delete photo from konten
     */
    public function deletePhoto(KontenHome $kontenHome)
    {
        if ($kontenHome->foto_kepsek_url) {
            Storage::disk('public')->delete($kontenHome->foto_kepsek_url);
            $kontenHome->update(['foto_kepsek_url' => null]);
        }

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}