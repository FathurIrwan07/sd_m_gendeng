<?php

namespace App\Http\Controllers;

use App\Models\InfoPpdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoPpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoPpdb = InfoPpdb::with('user')->latest()->get();
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
            'syarat_pendaftaran' => 'required|string',
            'gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'syarat_pendaftaran.required' => 'Syarat pendaftaran wajib diisi',
            'gambar_brosur.image' => 'File harus berupa gambar',
            'gambar_brosur.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'gambar_brosur.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('gambar_brosur')) {
            $validated['gambar_brosur'] = $request->file('gambar_brosur')->store('ppdb', 'public');
        }

        InfoPpdb::create($validated);

        return redirect()->route('info-ppdb.index')
            ->with('success', 'Info PPDB berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InfoPpdb $infoPpdb)
    {
        $infoPpdb->load('user');
        return view('admin.info-ppdb.show', compact('infoPpdb'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InfoPpdb $infoPpdb)
    {
        return view('admin.info-ppdb.edit', compact('infoPpdb'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InfoPpdb $infoPpdb)
    {
        $validated = $request->validate([
            'syarat_pendaftaran' => 'required|string',
            'gambar_brosur' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'syarat_pendaftaran.required' => 'Syarat pendaftaran wajib diisi',
            'gambar_brosur.image' => 'File harus berupa gambar',
            'gambar_brosur.mimes' => 'Format gambar harus: jpeg, png, jpg, gif',
            'gambar_brosur.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('gambar_brosur')) {
            // Delete old photo if exists
            if ($infoPpdb->gambar_brosur) {
                Storage::disk('public')->delete($infoPpdb->gambar_brosur);
            }
            $validated['gambar_brosur'] = $request->file('gambar_brosur')->store('ppdb', 'public');
        }

        $infoPpdb->update($validated);

        return redirect()->route('info-ppdb.index')
            ->with('success', 'Info PPDB berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoPpdb $infoPpdb)
    {
        // Delete photo if exists
        if ($infoPpdb->gambar_brosur) {
            Storage::disk('public')->delete($infoPpdb->gambar_brosur);
        }

        $infoPpdb->delete();

        return redirect()->route('info-ppdb.index')
            ->with('success', 'Info PPDB berhasil dihapus.');
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