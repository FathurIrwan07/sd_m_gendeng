{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.app')

@section('content')

<!-- Statistik Pengaduan -->
<div class="row">
    <!-- Total Pengaduan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pengaduan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalPengaduan ?? 0 }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menunggu Konfirmasi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Menunggu Konfirmasi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $menungguKonfirmasi ?? 0 }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedang Diproses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Sedang Diproses
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $diproses ?? 0 }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cog fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Selesai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $selesai ?? 0 }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pengaduan Terbaru -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pengaduan Terbaru</h6>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-list"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if(isset($pengaduanTerbaru) && $pengaduanTerbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduanTerbaru as $p)
                            <tr>
                                <td>
                                    @if($p->pelapor)
                                        <strong>{{ $p->pelapor->nama_lengkap }}</strong>
                                    @else
                                        <span class="text-muted">Anonim</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $p->kategori->nama_kategori }}</span>
                                </td>
                                <td>
                                    @if($p->status_pengaduan == 'Menunggu Konfirmasi')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($p->status_pengaduan == 'Diproses')
                                        <span class="badge badge-info">Diproses</span>
                                    @elseif($p->status_pengaduan == 'Selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('pengaduan.show', $p->id_pengaduan) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted py-5">
                    <i class="fas fa-inbox fa-3x mb-3"></i>
                    <p class="mb-0">Belum ada pengaduan</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistik Kategori -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kategori Pengaduan</h6>
            </div>
            <div class="card-body">
                @if(isset($kategoriStats) && $kategoriStats->count() > 0)
                @foreach($kategoriStats as $kat)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <small class="font-weight-bold">{{ $kat->nama_kategori }}</small>
                        <small class="text-muted">{{ $kat->pengaduan_count }} pengaduan</small>
                    </div>
                    <div class="progress" style="height: 10px;">
                        <div class="progress-bar bg-primary" 
                             style="width: {{ $totalPengaduan > 0 ? ($kat->pengaduan_count / $totalPengaduan * 100) : 0 }}%">
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center text-muted py-4">
                    <i class="fas fa-chart-bar fa-2x mb-3"></i>
                    <p class="mb-0">Belum ada data</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection