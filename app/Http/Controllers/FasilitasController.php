<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FasilitasController extends Controller
{
    public function publicIndex()
    {
        // Get all facilities
        $fasilitas = Fasilitas::latest()->get();
        return view('facilities', compact('fasilitas'));
    }
    public function index()
    {
        $fasilitas = Fasilitas::with('user')->latest()->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        Fasilitas::create($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilita)
    {
        $fasilita->load('user');
        return view('admin.fasilitas.show', compact('fasilita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.edit', compact('fasilita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($fasilita->gambar) {
                Storage::disk('public')->delete($fasilita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $fasilita->update($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilita)
    {
        // Delete image if exists
        if ($fasilita->gambar) {
            Storage::disk('public')->delete($fasilita->gambar);
        }

        $fasilita->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }

    /**
     * Delete gambar only
     */
    public function deleteGambar($id)
    {
        $fasilita = Fasilitas::findOrFail($id);
        
        if ($fasilita->gambar) {
            Storage::disk('public')->delete($fasilita->gambar);
            $fasilita->gambar = null;
            $fasilita->save();
        }

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}