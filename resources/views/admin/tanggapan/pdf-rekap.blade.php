<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tanggapan Pengaduan</title>
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
        .stat-box { display: table-cell; width: 33.33%; text-align: center; padding: 20px; border: 1px solid #ddd; }
        .stat-number { font-size: 28px; font-weight: bold; color: #800000; }
        .stat-label { font-size: 11px; color: #666; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #f8f9fa; color: #333; padding: 10px 8px; text-align: left; font-size: 11px; border: 1px solid #ddd; }
        td { padding: 8px; border: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .footer { margin-top: 50px; display: table; width: 100%; }
        .signature { display: table-cell; width: 50%; text-align: center; padding: 20px; }
        .signature-line { margin-top: 60px; border-top: 1px solid #333; width: 200px; margin-left: auto; margin-right: auto; padding-top: 5px; }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <div class="header">
        <h1>SD MUHAMMADIYAH GENDENG</h1>
        <h2>LAPORAN TANGGAPAN PENGADUAN</h2>
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
                <div class="stat-number">{{ $total }}</div>
                <div class="stat-label">Total Tanggapan</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $perPenanggap->count() }}</div>
                <div class="stat-label">Total Penanggap</div>
            </div>
            <div class="stat-box">
                <div class="stat-number">{{ $perPenanggap->count() > 0 ? round($total / $perPenanggap->count(), 1) : 0 }}</div>
                <div class="stat-label">Rata-rata per Penanggap</div>
            </div>
        </div>

        @if($perPenanggap->count() > 0)
        <table style="margin-top: 20px;">
            <tr>
                <th colspan="2" style="text-align: center; background: #800000; color: white;">Tanggapan per Penanggap</th>
            </tr>
            <tr>
                <th>Nama Penanggap</th>
                <th style="text-align: center; width: 150px;">Jumlah Tanggapan</th>
            </tr>
            @foreach($perPenanggap as $nama => $jumlah)
            <tr>
                <td>{{ $nama }}</td>
                <td style="text-align: center;"><strong>{{ $jumlah }}</strong></td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>

    {{-- DAFTAR TANGGAPAN --}}
    <div class="section">
        <div class="section-title">📋 DAFTAR TANGGAPAN</div>
        
        @if($tanggapan->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 15%;">Pelapor</th>
                    <th style="width: 12%;">Kategori</th>
                    <th style="width: 35%;">Tanggapan</th>
                    <th style="width: 13%;">Penanggap</th>
                    <th style="width: 10%;">Status Pengaduan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tanggapan as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_tanggapan->format('d/m/Y') }}</td>
                    <td>
                        @if($item->pengaduan->pelapor)
                            {{ $item->pengaduan->pelapor->nama_lengkap }}
                        @else
                            <em>Anonim</em>
                        @endif
                    </td>
                    <td>{{ $item->pengaduan->kategori->nama_kategori }}</td>
                    <td>{{ Str::limit($item->isi_tanggapan, 80) }}</td>
                    <td>{{ $item->penanggap->nama_lengkap }}</td>
                    <td>{{ $item->pengaduan->status_pengaduan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p style="text-align: center; padding: 30px; color: #999;">Tidak ada data tanggapan pada periode ini</p>
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