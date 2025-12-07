@extends('user.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan Saya</h1>
    <a href="{{ route('user.pengaduan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-file-alt"></i> {{ $pengaduan->kategori->nama_kategori }}
                    </h6>
                    <span class="badge badge-light">
                        {{ $pengaduan->tanggal_pengaduan->format('d F Y') }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="font-weight-bold">Status Pengaduan:</h6>
                    <span class="badge badge-{{ 
                        $pengaduan->status_pengaduan === 'Selesai' ? 'success' : 
                        ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' : 
                        ($pengaduan->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                    }} badge-lg px-4 py-2">
                        {{ $pengaduan->status_pengaduan }}
                    </span>
                </div>

                <hr>

                <h6 class="font-weight-bold mb-3"><i class="fas fa-file-alt"></i> Deskripsi Pengaduan:</h6>
                <div class="bg-light p-3 rounded">
                    <p class="mb-0" style="white-space: pre-line;">{{ $pengaduan->deskripsi }}</p>
                </div>

                @if($pengaduan->tanggapan)
                <hr>
                <h6 class="font-weight-bold mb-3 text-success"><i class="fas fa-reply"></i> Tanggapan dari Admin:</h6>
                <div class="card border-left-success shadow-sm">
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Ditanggapi oleh:</strong> {{ $pengaduan->tanggapan->penanggap->nama_lengkap }}<br>
                            <strong>Tanggal Tanggapan:</strong> {{ $pengaduan->tanggapan->tanggal_tanggapan->format('d F Y') }}
                        </div>
                        <hr>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0" style="white-space: pre-line;">{{ $pengaduan->tanggapan->isi_tanggapan }}</p>
                        </div>
                    </div>
                </div>
                @else
                <hr>
                <div class="alert alert-info">
                    <i class="fas fa-clock"></i> <strong>Pengaduan Anda sedang diproses</strong><br>
                    <small>Tim kami akan segera memberikan tanggapan. Mohon bersabar.</small>
                </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Pengaduan Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-history"></i> Riwayat Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="10%" class="text-center">No</th>
                                <th width="30%">Status</th>
                                <th width="60%">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <span class="badge badge-primary">
                                        <i class="fas fa-paper-plane"></i> Pengaduan Dibuat
                                    </span>
                                </td>
                                <td>{{ $pengaduan->created_at->format('d F Y, H:i') }} WIB</td>
                            </tr>

                            @if($pengaduan->tanggapan)
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-reply"></i> Mendapat Tanggapan
                                    </span>
                                </td>
                                <td>{{ $pengaduan->tanggapan->created_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            @endif

                            @if($pengaduan->status_pengaduan === 'Selesai')
                            <tr>
                                <td class="text-center">{{ $pengaduan->tanggapan ? '3' : '2' }}</td>
                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Pengaduan Selesai
                                    </span>
                                </td>
                                <td>{{ $pengaduan->updated_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            @endif

                            @if($pengaduan->status_pengaduan === 'Ditolak')
                            <tr>
                                <td class="text-center">{{ $pengaduan->tanggapan ? '3' : '2' }}</td>
                                <td>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Pengaduan Ditolak
                                    </span>
                                </td>
                                <td>{{ $pengaduan->updated_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Informasi Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">ID Pengaduan:</small><br>
                    <strong>#{{ str_pad($pengaduan->id_pengaduan, 5, '0', STR_PAD_LEFT) }}</strong>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Kategori:</small><br>
                    <span class="badge badge-info">{{ $pengaduan->kategori->nama_kategori }}</span>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Tanggal Dibuat:</small><br>
                    <strong>{{ $pengaduan->tanggal_pengaduan->format('d F Y') }}</strong>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Status:</small><br>
                    <span class="badge badge-{{ 
                        $pengaduan->status_pengaduan === 'Selesai' ? 'success' : 
                        ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' : 
                        ($pengaduan->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                    }}">
                        {{ $pengaduan->status_pengaduan }}
                    </span>
                </div>

                <div class="mb-0">
                    <small class="text-muted">Sudah Ditanggapi:</small><br>
                    @if($pengaduan->tanggapan)
                    <span class="badge badge-success"><i class="fas fa-check"></i> Ya</span>
                    @else
                    <span class="badge badge-secondary"><i class="fas fa-times"></i> Belum</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-info">
            <div class="card-body">
                <h6 class="text-info font-weight-bold mb-3">
                    <i class="fas fa-question-circle"></i> Bantuan
                </h6>
                <p class="small mb-2">Jika pengaduan Anda memerlukan tindak lanjut lebih lanjut, Anda bisa menghubungi:</p>
                <p class="small mb-0">
                    <i class="fas fa-phone"></i> <strong>Telepon:</strong> (0274) 123456<br>
                    <i class="fas fa-envelope"></i> <strong>Email:</strong> sdmgendeng@gmail.com
                </p>
            </div>
        </div>
    </div>
</div>
@endsection