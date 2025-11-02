<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource (Admin).
     */
    public function index()
    {
        $pengaduan = Pengaduan::with(['pelapor', 'kategori', 'tanggapan'])
            ->latest()
            ->get();
        
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['pelapor', 'kategori', 'tanggapan.penanggap']);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        $kategori = KategoriPengaduan::all();
        return view('admin.pengaduan.edit', compact('pengaduan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'deskripsi' => 'required|string',
            'status_pengaduan' => 'required|in:Menunggu Konfirmasi,Diproses,Selesai,Ditolak',
            'tanggal_pengaduan' => 'required|date',
        ], [
            'id_kategori.required' => 'Kategori pengaduan wajib dipilih',
            'id_kategori.exists' => 'Kategori yang dipilih tidak valid',
            'deskripsi.required' => 'Deskripsi pengaduan wajib diisi',
            'status_pengaduan.required' => 'Status pengaduan wajib dipilih',
            'tanggal_pengaduan.required' => 'Tanggal pengaduan wajib diisi',
            'tanggal_pengaduan.date' => 'Format tanggal tidak valid',
        ]);

        $pengaduan->update($validated);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    /**
     * Update status pengaduan
     */
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status_pengaduan' => 'required|in:Menunggu Konfirmasi,Diproses,Selesai,Ditolak',
        ]);

        $pengaduan->update($validated);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}