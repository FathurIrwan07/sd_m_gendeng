<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\TenagaPendidik;
use App\Models\Kegiatan;
use App\Models\Fasilitas;
use App\Models\InfoPpdb;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hero Section - Stats
        $totalPrestasi = Prestasi::count();
        $totalGuru = TenagaPendidik::count();
        
        // Program Section - Get 3 unggulan/featured programs
        $programUnggulan = Kegiatan::with('kategori')
            ->latest()
            ->take(3)
            ->get();
        
        // Prestasi Section - Get prioritized achievements
        $prestasiStats = $this->getPrestasiStats();
        
        // Fasilitas Section - Get all facilities (without images for display)
        $fasilitas = Fasilitas::select('nama_fasilitas')
            ->latest()
            ->take(8)
            ->get();
        
        // PPDB Section - Get latest active PPDB info
        $infoPpdb = InfoPpdb::with(['gelombang' => function($query) {
            $query->where('status', 'aktif')
                  ->orWhere('status', 'belum_mulai')
                  ->orderBy('nomor_gelombang');
        }])
        ->latest()
        ->first();
        
        return view('home', compact(
            'totalPrestasi',
            'totalGuru',
            'programUnggulan',
            'prestasiStats',
            'fasilitas',
            'infoPpdb'
        ));
    }
    
    /**
     * Get prestasi statistics with priority
     * Priority: Internasional > Nasional > Provinsi > Kabupaten/Kota > Kecamatan
     */
    private function getPrestasiStats()
    {
        $totalPrestasi = Prestasi::count();
        
        // Priority levels
        $priorities = ['Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Kecamatan'];
        
        $displayStats = [];
        
        // Add total prestasi as FIRST stat (paling kiri)
        $displayStats[] = [
            'value' => $totalPrestasi,
            'label' => 'Total Prestasi',
            'icon' => '🏆'
        ];
        
        $foundCount = 0;
        
        // Find first two non-zero priority levels
        foreach ($priorities as $priority) {
            $count = Prestasi::where('tingkat_prestasi', $priority)->count();
            
            if ($count > 0 && $foundCount < 2) {
                $displayStats[] = [
                    'value' => $count,
                    'label' => $priority,
                    'icon' => $this->getPrestasiIcon($priority)
                ];
                $foundCount++;
            }
            
            if ($foundCount >= 2) {
                break;
            }
        }
        
        // If less than 2 priority stats found, fill remaining slots
        while (count($displayStats) < 3) {
            $displayStats[] = [
                'value' => 0,
                'label' => 'Belum Ada Data',
                'icon' => '📊'
            ];
        }
        
        return $displayStats;
    }
    
    /**
     * Get icon based on prestasi level
     */
    private function getPrestasiIcon($tingkat)
    {
        $icons = [
            'Internasional' => '🌍',
            'Nasional' => '🥇',
            'Provinsi' => '🥈',
            'Kabupaten/Kota' => '🥉',
            'Kecamatan' => '🏅'
        ];
        
        return $icons[$tingkat] ?? '🏆';
    }
}