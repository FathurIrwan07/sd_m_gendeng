{{-- resources/views/user/dashboard.blade.php --}}
@extends('user.app')

@section('content')
    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-tachometer-alt"></i> Dashboard Pengaduan
            </h1>
            <a href="{{ route('user.pengaduan.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Buat Pengaduan Baru
            </a>
        </div>

        <!-- Welcome Card -->
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="font-weight-bold text-primary mb-1">
                            Halo, {{ Auth::user()->nama_lengkap }} 👋
                        </h5>
                        <p class="text-muted mb-0">
                            Selamat datang di Dashboard Pengaduan. Kelola dan pantau semua pengaduan Anda di sini.
                        </p>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-4">
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
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Sedang Diproses
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $diprosesCount ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $selesaiCount ?? 0 }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Menunggu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $menungguCount ?? 0 }}
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

        <!-- Quick Actions & Recent Activities -->
        <div class="row">
            <!-- Quick Actions -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-bolt"></i> Aksi Cepat
                        </h6>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary btn-block mb-3">
                            <i class="fas fa-plus-circle"></i> Buat Pengaduan Baru
                        </a>
                        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-outline-secondary btn-block mb-3">
                            <i class="fas fa-list"></i> Lihat Semua Pengaduan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-history"></i> Pengaduan Terbaru
                        </h6>
                        <a href="{{ route('user.pengaduan.index') }}" class="btn btn-sm btn-outline-primary">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if($pengaduanTerbaru->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($pengaduanTerbaru as $pengaduan)

                                                <div class="list-group-item px-0">
                                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">
                                                                <span class="badge badge-info">{{ $pengaduan->kategori->nama_kategori }}</span>
                                                            </h6>
                                                            <p class="mb-1 text-dark">{{ Str::limit($pengaduan->deskripsi, 80) }}</p>
                                                            <small class="text-muted">
                                                                <i class="fas fa-calendar"></i>
                                                                {{ $pengaduan->tanggal_pengaduan->format('d M Y') }}
                                                                <span class="mx-1">•</span>
                                                                <i class="fas fa-clock"></i> {{ $pengaduan->created_at->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                        <div class="ml-3 text-right">
                                                            <span
                                                                class="badge badge-{{ 
                                                                                                                                                                            $pengaduan->status_pengaduan === 'Selesai' ? 'success' :
                                    ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' :
                                        ($pengaduan->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                                                                                                                                                                        }}">
                                                                @if($pengaduan->status_pengaduan === 'Selesai')
                                                                    <i class="fas fa-check-circle"></i>
                                                                @elseif($pengaduan->status_pengaduan === 'Diproses')
                                                                    <i class="fas fa-spinner"></i>
                                                                @elseif($pengaduan->status_pengaduan === 'Ditolak')
                                                                    <i class="fas fa-times-circle"></i>
                                                                @else
                                                                    <i class="fas fa-clock"></i>
                                                                @endif
                                                                {{ $pengaduan->status_pengaduan }}
                                                            </span>
                                                            <div class="mt-2">
                                                                <a href="{{ route('user.pengaduan.show', $pengaduan->id_pengaduan) }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i> Detail
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-3">Belum ada pengaduan</p>
                                <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Buat Pengaduan Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 bg-info">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-info-circle"></i> Informasi Pengaduan
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Menunggu Konfirmasi:</strong> Pengaduan sedang ditinjau oleh admin
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-warning"></i>
                                <strong>Diproses:</strong> Pengaduan sedang ditangani oleh petugas terkait
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success"></i>
                                <strong>Selesai:</strong> Pengaduan telah diselesaikan
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check text-danger"></i>
                                <strong>Ditolak:</strong> Pengaduan tidak dapat diproses
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 bg-warning">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-lightbulb"></i> Tips Pengaduan
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-arrow-right text-primary"></i>
                                Jelaskan masalah dengan detail dan jelas
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-arrow-right text-primary"></i>
                                Sertakan foto atau dokumen pendukung jika ada
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-arrow-right text-primary"></i>
                                Pilih kategori yang sesuai dengan pengaduan Anda
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-arrow-right text-primary"></i>
                                Pantau status pengaduan secara berkala
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto dismiss alerts after 5 seconds
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
@endpush