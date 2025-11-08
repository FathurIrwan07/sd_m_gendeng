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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter'); // Filter waktu (minggu, bulan, tahun)

        // Query dasar dengan relasi
        $query = Pengaduan::with(['pelapor', 'kategori', 'tanggapan']);

        // 🔍 Jika ada pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'like', '%' . $search . '%')
                    ->orWhere('status_pengaduan', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where('nama_kategori', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('pelapor', function ($query) use ($search) {
                        $query->where('nama_lengkap', 'like', '%' . $search . '%')
                            ->orWhere('username', 'like', '%' . $search . '%');
                    });
            });
        }

        // 🗓️ Filter berdasarkan waktu
        if ($filter) {
            if ($filter === 'minggu') {
                $query->whereBetween('tanggal_pengaduan', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'bulan') {
                $query->whereMonth('tanggal_pengaduan', now()->month)
                    ->whereYear('tanggal_pengaduan', now()->year);
            } elseif ($filter === 'tahun') {
                $query->whereYear('tanggal_pengaduan', now()->year);
            }
        }

        // Urutkan berdasarkan tanggal terbaru
        $pengaduan = $query->latest()->get();

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
     * Update status pengaduan.
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
