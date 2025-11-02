<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik Pengaduan
        $totalPengaduan = Pengaduan::count();
        $menungguKonfirmasi = Pengaduan::where('status_pengaduan', 'Menunggu Konfirmasi')->count();
        $diproses = Pengaduan::where('status_pengaduan', 'Diproses')->count();
        $selesai = Pengaduan::where('status_pengaduan', 'Selesai')->count();
        
        // Pengaduan Terbaru (5 data terakhir)
        $pengaduanTerbaru = Pengaduan::with(['pelapor', 'kategori'])
            ->latest()
            ->limit(5)
            ->get();
        
        // Statistik per Kategori
        $kategoriStats = KategoriPengaduan::withCount('pengaduan')
            ->orderBy('pengaduan_count', 'desc')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menungguKonfirmasi',
            'diproses',
            'selesai',
            'pengaduanTerbaru',
            'kategoriStats'
        ));
    }
}
