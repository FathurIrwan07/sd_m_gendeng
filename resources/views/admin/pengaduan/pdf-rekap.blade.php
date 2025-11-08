{{-- ============================================ --}}
{{-- FILE: resources/views/admin/pengaduan/pdf-rekap.blade.php --}}
{{-- LAPORAN REKAP PENGADUAN --}}
{{-- ============================================ --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; color: #333; }
        .header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 3px solid #800000; }
        .header h1 { color: #800000; font-size: 18px; margin: 10px 0; }
        .header h2 { color: #4b0000; font-size: 16px; margin: 5px 0; }
        .info { margin-bottom: 20px; font-size: 11px; }
        .section { margin-bottom: 25px; }
        .section-title { background: #800000; color: white; padding: 8px 10px; font-size: 13px; font-weight: bold; margin-bottom: 15px; }
        .stats-grid { display: table; width: 100%; margin-bottom: 20px; }
        .stat-box { display: table-cell; width: 20%; text-align: center; padding: 15px; border: 1px solid #ddd; }
        .stat-number { font-size: 24px; font-weight: bold; color: #800000; }
        .stat-label { font-size: 10px; color: #666; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f8f9fa; color: #333; padding: 10px 8px; text-align: left; font-size: 11px; border: 1px solid #ddd; }
        td { padding: 8px; border: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; }
        .badge-menunggu { background: #ffc107; color: #000; }
        .badge-diproses { background: #17a2b8; color: white; }
        .badge-selesai { background: #28a745; color: white; }
        .badge-ditolak { background: #dc3545; color: white; }
        .footer { margin-top: 50px; display: table; width: 100%; }
        .signature { display: table-cell; width: 50%; text-align: center; padding: 20px; }
        .signature-line { margin-top: 60px; border-top: 1px solid #333; width: 200px; margin-left: auto; margin-right: auto; padding-top: 5px; }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <div class="header">
        <h1>SD MUHAMMADIYAH GENDENG</h1>
        <h2>LAPORAN PENGADUAN MASYARAKAT</h2>
    </div>

    {{-- INFO LAPORAN --}}
    <div class="info">
        <table style="border: none;">
            <tr style="background: none;">
                <td style="border: none; width: 120px;"><strong>Periode Laporan</strong></td>
                <td style="border: none;">: {{ $periode }}</td>
            </tr>
            <tr style="background: none;">
                <td style="border: none;"><strong>Tanggal Cetak</strong></td>
                <td style="border: none;">: {{ $tanggal_cetak }}</td>
            </tr>
        </table>
    </div>

    {{-- STATISTIK --}}
    <div class="section">
        <div class="section-title">📊 RINGKASAN STATISTIK</div>
        
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-number">{{ $statistik['total'] }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $statistik['menunggu'] }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $statistik['diproses'] }}</div>
                <div class="stat-label">Diproses</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $statistik['selesai'] }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $statistik['ditolak'] }}</div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>

        <table style="margin-top: 20px;">
            <tr>
                <th style="width: 50%;">Kategori Terbanyak</th>
                <th style="width: 50%;">Rata-rata Penyelesaian</th>
            </tr>
            <tr>
                <td>
                    @foreach($perKategori->take(3) as $nama => $jumlah)
                        <div>• {{ $nama }}: <strong>{{ $jumlah }} pengaduan</strong></div>
                    @endforeach
                    @if($perKategori->count() == 0)
                        <div>Tidak ada data</div>
                    @endif
                </td>
                <td style="text-align: center;">
                    <strong style="font-size: 16px; color: #800000;">{{ $rataRata }} hari</strong>
                </td>
            </tr>
        </table>
    </div>

    {{-- DAFTAR PENGADUAN --}}
    <div class="section">
        <div class="section-title">📋 DAFTAR PENGADUAN</div>
        
        @if($pengaduan->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th style="width: 15%;">Pelapor</th>
                    <th style="width: 12%;">Kategori</th>
                    <th style="width: 36%;">Deskripsi</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 10%;">Ditanggapi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengaduan as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_pengaduan->format('d/m/Y') }}</td>
                    <td>
                        @if($item->pelapor)
                            {{ $item->pelapor->nama_lengkap }}
                        @else
                            <em>Anonim</em>
                        @endif
                    </td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                    <td>
                        <span class="badge badge-{{ 
                            $item->status_pengaduan === 'Menunggu Konfirmasi' ? 'menunggu' : 
                            ($item->status_pengaduan === 'Diproses' ? 'diproses' : 
                            ($item->status_pengaduan === 'Selesai' ? 'selesai' : 'ditolak')) 
                        }}">
                            {{ $item->status_pengaduan }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        @if($item->tanggapan)
                            ✓
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="text-align: center; padding: 30px; color: #999;">Tidak ada data pengaduan pada periode ini</p>
        @endif
    </div>

    {{-- FOOTER / TTD --}}
    <div class="footer">
        <div class="signature">
            <div><strong>Mengetahui,</strong></div>
            <div>Kepala Sekolah</div>
            <div class="signature-line">
                <strong>[Nama Kepala Sekolah]</strong>
            </div>
        </div>
        <div class="signature">
            <div><strong>Dibuat oleh,</strong></div>
            <div>Administrator</div>
            <div class="signature-line">
                <strong>{{ auth()->user()->nama_lengkap }}</strong>
            </div>
        </div>
    </div>
</body>
</html>