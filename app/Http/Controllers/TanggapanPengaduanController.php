<?php

namespace App\Http\Controllers;

use App\Models\TanggapanPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TanggapanPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate tanggapan with 10 items per page
        $tanggapan = TanggapanPengaduan::with(['pengaduan.pelapor', 'pengaduan.kategori', 'penanggap'])
            ->latest()
            ->paginate(10);
        
        return view('admin.tanggapan.index', compact('tanggapan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pengaduanId = $request->query('pengaduan_id');
        $pengaduan = null;
        
        if ($pengaduanId) {
            $pengaduan = Pengaduan::with(['pelapor', 'kategori'])->find($pengaduanId);
        }
        
        $pengaduanList = Pengaduan::with(['pelapor', 'kategori'])
            ->whereDoesntHave('tanggapan')
            ->where('status_pengaduan', '!=', 'Selesai')
            ->where('status_pengaduan', '!=', 'Ditolak')
            ->get();
        
        return view('admin.tanggapan.create', compact('pengaduanList', 'pengaduan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'required|date',
        ], [
            'id_pengaduan.required' => 'Pengaduan wajib dipilih',
            'id_pengaduan.exists' => 'Pengaduan tidak ditemukan',
            'isi_tanggapan.required' => 'Isi tanggapan wajib diisi',
            'tanggal_tanggapan.required' => 'Tanggal tanggapan wajib diisi',
            'tanggal_tanggapan.date' => 'Format tanggal tidak valid',
        ]);

        // Check if pengaduan already has tanggapan
        $existingTanggapan = TanggapanPengaduan::where('id_pengaduan', $validated['id_pengaduan'])->first();
        if ($existingTanggapan) {
            return back()->withErrors(['id_pengaduan' => 'Pengaduan ini sudah memiliki tanggapan.'])->withInput();
        }

        // Set user_id from authenticated admin
        $validated['user_id'] = auth()->id();

        $tanggapan = TanggapanPengaduan::create($validated);

        // Update status pengaduan to "Diproses"
        $tanggapan->pengaduan->update(['status_pengaduan' => 'Diproses']);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil ditambahkan dan status pengaduan diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TanggapanPengaduan $tanggapan)
    {
        $tanggapan->load(['pengaduan.pelapor', 'pengaduan.kategori', 'penanggap']);
        return view('admin.tanggapan.show', compact('tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TanggapanPengaduan $tanggapan)
    {
        $tanggapan->load(['pengaduan.pelapor', 'pengaduan.kategori']);
        return view('admin.tanggapan.edit', compact('tanggapan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TanggapanPengaduan $tanggapan)
    {
        $validated = $request->validate([
            'isi_tanggapan' => 'required|string',
            'tanggal_tanggapan' => 'required|date',
        ], [
            'isi_tanggapan.required' => 'Isi tanggapan wajib diisi',
            'tanggal_tanggapan.required' => 'Tanggal tanggapan wajib diisi',
            'tanggal_tanggapan.date' => 'Format tanggal tidak valid',
        ]);

        $tanggapan->update($validated);

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TanggapanPengaduan $tanggapan)
    {
        // Update status pengaduan back to "Menunggu Konfirmasi"
        $tanggapan->pengaduan->update(['status_pengaduan' => 'Menunggu Konfirmasi']);
        
        $tanggapan->delete();

        return redirect()->route('tanggapan.index')
            ->with('success', 'Tanggapan berhasil dihapus dan status pengaduan dikembalikan.');
    }
    
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
    
    public function exportPdfGabungan(Request $request)
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
            'periode' => $periode,
            'tanggal_cetak' => now()->format('d F Y, H:i') . ' WIB',
        ];

        $pdf = Pdf::loadView('admin.tanggapan.pdf-gabungan', $data)
            ->setPaper('a4', 'landscape'); // Landscape karena kolom lebih banyak

        return $pdf->download('Laporan_Pengaduan_Tanggapan_' . now()->format('d-m-Y') . '.pdf');
    }
}