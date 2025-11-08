<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Pengaduan #{{ $pengaduan->id_pengaduan }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; color: #333; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 3px solid #800000; }
        .header h1 { color: #800000; font-size: 18px; margin: 10px 0; }
        .section { margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .section-title { background: #800000; color: white; padding: 8px 10px; font-size: 13px; font-weight: bold; margin: -15px -15px 15px -15px; }
        .info-row { margin-bottom: 10px; }
        .info-label { font-weight: bold; color: #666; display: inline-block; width: 180px; }
        .badge { display: inline-block; padding: 5px 10px; border-radius: 3px; font-size: 11px; font-weight: bold; }
        .badge-menunggu { background: #ffc107; color: #000; }
        .badge-diproses { background: #17a2b8; color: white; }
        .badge-selesai { background: #28a745; color: white; }
        .badge-ditolak { background: #dc3545; color: white; }
        .timeline { margin-top: 15px; }
        .timeline-item { margin-bottom: 10px; padding-left: 20px; border-left: 3px solid #800000; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DETAIL PENGADUAN #{{ str_pad($pengaduan->id_pengaduan, 4, '0', STR_PAD_LEFT) }}</h1>
        <p>SD Muhammadiyah Gendeng</p>
    </div>

    {{-- INFORMASI PELAPOR --}}
    <div class="section">
        <div class="section-title">👤 INFORMASI PELAPOR</div>
        <div class="info-row">
            <span class="info-label">Nama Pelapor:</span>
            @if($pengaduan->pelapor)
                {{ $pengaduan->pelapor->nama_lengkap }}
            @else
                <em>Anonim / Tidak Terdaftar</em>
            @endif
        </div>
        @if($pengaduan->pelapor)
        <div class="info-row">
            <span class="info-label">Username:</span>
            {{ $pengaduan->pelapor->username }}
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            {{ $pengaduan->pelapor->email }}
        </div>
        @endif
        <div class="info-row">
            <span class="info-label">Tanggal Pengaduan:</span>
            {{ $pengaduan->tanggal_pengaduan->format('d F Y, H:i') }} WIB
        </div>
    </div>

    {{-- DETAIL PENGADUAN --}}
    <div class="section">
        <div class="section-title">📝 DETAIL PENGADUAN</div>
        <div class="info-row">
            <span class="info-label">Kategori:</span>
            <strong>{{ $pengaduan->kategori->nama_kategori }}</strong>
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="badge badge-{{ 
                $pengaduan->status_pengaduan === 'Menunggu Konfirmasi' ? 'menunggu' : 
                ($pengaduan->status_pengaduan === 'Diproses' ? 'diproses' : 
                ($pengaduan->status_pengaduan === 'Selesai' ? 'selesai' : 'ditolak')) 
            }}">
                {{ $pengaduan->status_pengaduan }}
            </span>
        </div>
        <div class="info-row">
            <span class="info-label">Deskripsi:</span>
        </div>
        <div style="margin-top: 10px; padding: 15px; background: #f8f9fa; border-radius: 5px; text-align: justify;">
            {{ $pengaduan->deskripsi }}
        </div>
    </div>

    {{-- TANGGAPAN --}}
    @if($pengaduan->tanggapan)
    <div class="section">
        <div class="section-title">💬 TANGGAPAN</div>
        <div class="info-row">
            <span class="info-label">Ditanggapi oleh:</span>
            {{ $pengaduan->tanggapan->penanggap->nama_lengkap }}
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Tanggapan:</span>
            {{ $pengaduan->tanggapan->tanggal_tanggapan->format('d F Y, H:i') }} WIB
        </div>
        <div class="info-row">
            <span class="info-label">Isi Tanggapan:</span>
        </div>
        <div style="margin-top: 10px; padding: 15px; background: #e8f5e9; border-radius: 5px; text-align: justify;">
            {{ $pengaduan->tanggapan->isi_tanggapan }}
        </div>
    </div>
    @else
    <div class="section" style="text-align: center; color: #999;">
        <div class="section-title">💬 TANGGAPAN</div>
        <p>Belum ada tanggapan untuk pengaduan ini</p>
    </div>
    @endif

    {{-- TIMELINE --}}
    <div class="section">
        <div class="section-title">⏱️ TIMELINE PENYELESAIAN</div>
        <div class="timeline">
            <div class="timeline-item">
                <strong>Diajukan:</strong> {{ $pengaduan->tanggal_pengaduan->format('d M Y, H:i') }}
            </div>
            @if($pengaduan->tanggapan)
            <div class="timeline-item">
                <strong>Ditanggapi:</strong> {{ $pengaduan->tanggapan->tanggal_tanggapan->format('d M Y, H:i') }}
            </div>
            @endif
            @if($pengaduan->status_pengaduan === 'Selesai' && $pengaduan->tanggapan)
            <div class="timeline-item">
                <strong>Selesai:</strong> {{ $pengaduan->tanggapan->tanggal_tanggapan->format('d M Y, H:i') }}
            </div>
            <div style="margin-top: 15px; padding: 10px; background: #d4edda; border-radius: 5px; text-align: center;">
                <strong>⏱️ Waktu Penyelesaian: {{ $durasi }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- FOOTER --}}
    <div style="margin-top: 50px; text-align: right; font-size: 10px; color: #666;">
        <p>Dicetak pada: {{ $tanggal_cetak }}</p>
        <p>Oleh: {{ auth()->user()->nama_lengkap }}</p>
    </div>
</body>
</html>