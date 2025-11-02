{{-- resources/views/user/pengaduan/index.blade.php --}}
@extends('user.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengaduan Saya</h1>
    <a href="{{ route('user.pengaduan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pengaduan Baru
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    @forelse($pengaduan as $item)
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3" 
                 style="background-color: 
                    {{ $item->status_pengaduan === 'Selesai' ? '#28a745' : 
                       ($item->status_pengaduan === 'Diproses' ? '#ffc107' : 
                       ($item->status_pengaduan === 'Ditolak' ? '#dc3545' : '#6c757d')) }};">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-alt"></i> {{ $item->kategori->nama_kategori }}
                    </h6>
                    <span class="badge badge-light">{{ $item->tanggal_pengaduan->format('d M Y') }}</span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="mb-3">
                    <span class="badge badge-{{ 
                        $item->status_pengaduan === 'Selesai' ? 'success' : 
                        ($item->status_pengaduan === 'Diproses' ? 'warning' : 
                        ($item->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                    }} badge-lg px-3 py-2">
                        {{ $item->status_pengaduan }}
                    </span>
                </div>
                
                <p class="card-text text-justify">
                    {{ Str::limit($item->deskripsi, 150) }}
                </p>
                
                @if($item->tanggapan)
                <div class="alert alert-info mb-3">
                    <small>
                        <i class="fas fa-reply"></i> <strong>Sudah Ditanggapi</strong><br>
                        {{ $item->tanggapan->tanggal_tanggapan->format('d M Y') }}
                    </small>
                </div>
                @else
                <div class="alert alert-secondary mb-3">
                    <small>
                        <i class="fas fa-clock"></i> Belum ada tanggapan
                    </small>
                </div>
                @endif
                
                <a href="{{ route('user.pengaduan.show', $item->id_pengaduan) }}" class="btn btn-primary btn-block">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
            </div>
            
            <div class="card-footer bg-light text-muted small">
                <i class="fas fa-clock"></i> Dibuat {{ $item->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Anda belum memiliki pengaduan</h5>
                <p class="text-muted">Silakan buat pengaduan baru jika ada keluhan atau saran</p>
                <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($pengaduan->count() > 0)
<div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduan->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pengaduan->where('status_pengaduan', 'Diproses')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pengaduan->where('status_pengaduan', 'Selesai')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menunggu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pengaduan->where('status_pengaduan', 'Menunggu Konfirmasi')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection