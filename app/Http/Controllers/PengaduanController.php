<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


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

     public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');
        $kategori = $request->input('kategori');

        // Query dengan filter
        $query = Pengaduan::with(['pelapor', 'kategori', 'tanggapan.penanggap']);

        // Filter tanggal
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_pengaduan', [$startDate, $endDate]);
            $periode = Carbon::parse($startDate)->format('d M Y') . ' - ' . Carbon::parse($endDate)->format('d M Y');
        } else {
            // Default bulan ini
            $query->whereMonth('tanggal_pengaduan', now()->month)
                  ->whereYear('tanggal_pengaduan', now()->year);
            $periode = now()->format('F Y');
        }

        // Filter status
        if ($status) {
            $query->where('status_pengaduan', $status);
        }

        // Filter kategori
        if ($kategori) {
            $query->where('id_kategori', $kategori);
        }

        $pengaduan = $query->orderBy('tanggal_pengaduan', 'desc')->get();

        // Hitung statistik
        $statistik = [
            'total' => $pengaduan->count(),
            'menunggu' => $pengaduan->where('status_pengaduan', 'Menunggu Konfirmasi')->count(),
            'diproses' => $pengaduan->where('status_pengaduan', 'Diproses')->count(),
            'selesai' => $pengaduan->where('status_pengaduan', 'Selesai')->count(),
            'ditolak' => $pengaduan->where('status_pengaduan', 'Ditolak')->count(),
        ];

        // Hitung per kategori
        $perKategori = $pengaduan->groupBy('kategori.nama_kategori')
            ->map(fn($items) => $items->count())
            ->sortDesc();

        // Hitung rata-rata penyelesaian (untuk yang selesai)
        $selesai = $pengaduan->where('status_pengaduan', 'Selesai')->filter(function($item) {
            return $item->tanggapan;
        });
        
        $rataRata = $selesai->count() > 0 
            ? round($selesai->avg(function($item) {
                return $item->tanggal_pengaduan->diffInDays($item->tanggapan->tanggal_tanggapan);
            }), 1)
            : 0;

        $data = [
            'pengaduan' => $pengaduan,
            'statistik' => $statistik,
            'perKategori' => $perKategori,
            'rataRata' => $rataRata,
            'periode' => $periode,
            'tanggal_cetak' => now()->format('d F Y, H:i') . ' WIB',
        ];

        $pdf = Pdf::loadView('admin.pengaduan.pdf-rekap', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Pengaduan_' . now()->format('d-m-Y') . '.pdf');
    }

    /**
     * Export PDF Detail Individual
     */
    public function exportPdfDetail(Pengaduan $pengaduan)
    {
        $pengaduan->load(['pelapor', 'kategori', 'tanggapan.penanggap']);

        // Hitung durasi penyelesaian
        $durasi = null;
        if ($pengaduan->tanggapan && $pengaduan->status_pengaduan === 'Selesai') {
            $mulai = $pengaduan->tanggal_pengaduan;
            $selesai = $pengaduan->tanggapan->tanggal_tanggapan;
            
            $days = $mulai->diffInDays($selesai);
            $hours = $mulai->copy()->addDays($days)->diffInHours($selesai);
            
            $durasi = $days . ' hari ' . $hours . ' jam';
        }

        $data = [
            'pengaduan' => $pengaduan,
            'durasi' => $durasi,
            'tanggal_cetak' => now()->format('d F Y, H:i') . ' WIB',
        ];

        $pdf = Pdf::loadView('admin.pengaduan.pdf-detail', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Detail_Pengaduan_' . $pengaduan->id_pengaduan . '.pdf');
    }

    /**
     * Export PDF Laporan Tanggapan
     */
    public function exportPdfTanggapan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = \App\Models\TanggapanPengaduan::with(['pengaduan.pelapor', 'pengaduan.kategori', 'penanggap']);

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_tanggapan', [$startDate, $endDate]);
            $periode = Carbon::parse($startDate)->format('d M Y') . ' - ' . Carbon::parse($endDate)->format('d M Y');
        } else {
            $query->whereMonth('tanggal_tanggapan', now()->month)
                  ->whereYear('tanggal_tanggapan', now()->year);
            $periode = now()->format('F Y');
        }

        $tanggapan = $query->orderBy('tanggal_tanggapan', 'desc')->get();

        // Statistik per penanggap
        $perPenanggap = $tanggapan->groupBy('penanggap.nama_lengkap')
            ->map(fn($items) => $items->count())
            ->sortDesc();

        $data = [
            'tanggapan' => $tanggapan,
            'total' => $tanggapan->count(),
            'perPenanggap' => $perPenanggap,
            'periode' => $periode,
            'tanggal_cetak' => now()->format('d F Y, H:i') . ' WIB',
        ];

        $pdf = Pdf::loadView('admin.tanggapan.pdf-rekap', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Tanggapan_' . now()->format('d-m-Y') . '.pdf');
    }
}
