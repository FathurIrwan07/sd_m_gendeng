<?php

namespace App\Http\Controllers;

use App\Models\InfoPpdb;
use App\Models\GelombangPpdb;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PpdbPublicController extends Controller
{
    public function index()
    {
        // Ambil info PPDB terbaru
        $infoPpdb = InfoPpdb::with(['gelombang' => function($query) {
            $query->orderBy('nomor_gelombang')
                  ->with(['tahapan' => function($q) {
                      $q->orderBy('urutan');
                  }]);
        }])
        ->latest()
        ->first();

        // Update status semua gelombang
        if ($infoPpdb && $infoPpdb->gelombang) {
            foreach ($infoPpdb->gelombang as $gelombang) {
                $gelombang->updateStatus();
            }
        }

        // Ambil gelombang yang sedang berlangsung atau terdekat
        $activeGelombang = null;
        if ($infoPpdb) {
            $activeGelombang = $infoPpdb->gelombang()
                ->where('status', 'berlangsung')
                ->orWhere('status', 'belum_mulai')
                ->orderBy('nomor_gelombang')
                ->first();
        }

        // Build timeline dari tahapan
        $timeline = [];
        if ($activeGelombang && $activeGelombang->tahapan) {
            foreach ($activeGelombang->tahapan as $tahapan) {
                $timeline[] = [
                    'icon' => $this->getTimelineIcon($tahapan->nama_tahapan),
                    'title' => $tahapan->nama_tahapan,
                    'date' => $tahapan->rentang_tanggal,
                    'description' => $tahapan->deskripsi ?? 'Tahap ' . $tahapan->nama_tahapan,
                    'status' => $tahapan->status_tahapan
                ];
            }
        }

        // Parse requirements dari syarat_pendaftaran
        $requirements = [];
        if ($infoPpdb && $infoPpdb->syarat_pendaftaran) {
            $requirements = $this->parseRequirements($infoPpdb->syarat_pendaftaran);
        }

        // Contact info
        $contactInfo = [
            [
                'icon' => '📞',
                'type' => 'Telepon',
                'value' => $infoPpdb->telepon ?? '(0274) 123456'
            ],
            [
                'icon' => '✉️',
                'type' => 'Email',
                'value' => $infoPpdb->email ?? 'ppdb@sdgendeng.sch.id'
            ],
            [
                'icon' => '📍',
                'type' => 'Alamat',
                'value' => $infoPpdb->alamat ?? 'Jl. Pendidikan No. 123, Yogyakarta'
            ]
        ];

        return view('ppdb', compact(
            'infoPpdb',
            'activeGelombang',
            'timeline',
            'requirements',
            'contactInfo'
        ));
    }

    /**
     * Get icon based on tahapan name
     */
    private function getTimelineIcon($namaTahapan)
    {
        $icons = [
            'pendaftaran' => '📝',
            'seleksi' => '📋',
            'pengumuman' => '📢',
            'daftar ulang' => '✅',
            'verifikasi' => '🔍',
            'hasil' => '🎯'
        ];

        $namaTahapan = strtolower($namaTahapan);
        
        foreach ($icons as $key => $icon) {
            if (strpos($namaTahapan, $key) !== false) {
                return $icon;
            }
        }

        return '📌'; // Default icon
    }

    /**
     * Parse requirements text to array
     */
    private function parseRequirements($text)
    {
        // Split by newline or numbered list
        $lines = preg_split('/\r\n|\r|\n/', $text);
        $requirements = [];

        foreach ($lines as $line) {
            $line = trim($line);
            // Remove numbers and bullets
            $line = preg_replace('/^[\d\.\-\*\•]+\s*/', '', $line);
            
            if (!empty($line)) {
                $requirements[] = $line;
            }
        }

        return $requirements;
    }
}