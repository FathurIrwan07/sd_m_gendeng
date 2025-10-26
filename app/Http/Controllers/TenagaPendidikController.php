<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenagaPendidik = TenagaPendidik::with('user')->latest()->paginate(10);
        return view('admin.tenaga-pendidik.index', compact('tenagaPendidik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tenaga-pendidik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'foto_tenaga_pendidik' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto_tenaga_pendidik')) {
            $validated['foto_tenaga_pendidik'] = $request->file('foto_tenaga_pendidik')
                ->store('tenaga-pendidik', 'public');
        }

        TenagaPendidik::create($validated);

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TenagaPendidik $tenagaPendidik)
    {
        $tenagaPendidik->load('user');
        return view('admin.tenaga-pendidik.show', compact('tenagaPendidik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenagaPendidik $tenagaPendidik)
    {
        return view('admin.tenaga-pendidik.edit', compact('tenagaPendidik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TenagaPendidik $tenagaPendidik)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'jabatan' => 'required|string|max:100',
            'foto_tenaga_pendidik' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('foto_tenaga_pendidik')) {
            // Delete old photo
            if ($tenagaPendidik->foto_tenaga_pendidik) {
                Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
            }
            $validated['foto_tenaga_pendidik'] = $request->file('foto_tenaga_pendidik')
                ->store('tenaga-pendidik', 'public');
        }

        $tenagaPendidik->update($validated);

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenagaPendidik $tenagaPendidik)
    {
        // Delete photo if exists
        if ($tenagaPendidik->foto_tenaga_pendidik) {
            Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
        }

        $tenagaPendidik->delete();

        return redirect()->route('tenaga-pendidik.index')
            ->with('success', 'Tenaga pendidik berhasil dihapus.');
    }

    /**
     * Delete foto only
     */
    public function deleteFoto($id)
    {
        $tenagaPendidik = TenagaPendidik::findOrFail($id);
        
        if ($tenagaPendidik->foto_tenaga_pendidik) {
            Storage::disk('public')->delete($tenagaPendidik->foto_tenaga_pendidik);
            $tenagaPendidik->foto_tenaga_pendidik = null;
            $tenagaPendidik->save();
        }

        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}