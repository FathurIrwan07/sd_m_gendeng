{{-- resources/views/user/pengaduan/index.blade.php --}}
@extends('user.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if($pengaduan->count() > 0)
        <div class="row mb-4">
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list"></i> Daftar Pengaduan
            </h6>
        </div>
        <div class="card-body">
            @if($pengaduan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="15%">Kategori</th>
                                <th width="30%">Deskripsi</th>
                                <th width="12%">Tanggal</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Tanggapan</th>
                                <th class="text-center" width="8%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengaduan as $key => $item)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $item->kategori->nama_kategori }}</span>
                                </td>
                                <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                                <td>
                                    <small>
                                        <i class="fas fa-calendar"></i> {{ $item->tanggal_pengaduan->format('d M Y') }}<br>
                                        <i class="fas fa-clock"></i> {{ $item->created_at->diffForHumans() }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-{{ 
                                        $item->status_pengaduan === 'Selesai' ? 'success' :
                                        ($item->status_pengaduan === 'Diproses' ? 'warning' :
                                        ($item->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                                    }}">
                                        @if($item->status_pengaduan === 'Selesai')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($item->status_pengaduan === 'Diproses')
                                            <i class="fas fa-spinner"></i>
                                        @elseif($item->status_pengaduan === 'Ditolak')
                                            <i class="fas fa-times-circle"></i>
                                        @else
                                            <i class="fas fa-clock"></i>
                                        @endif
                                        {{ $item->status_pengaduan }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($item->tanggapan)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i> Sudah
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-times"></i> Belum
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.pengaduan.show', $item->id_pengaduan) }}" 
                                       class="btn btn-sm btn-primary" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Anda belum memiliki pengaduan</h5>
                    <p class="text-muted">Silakan buat pengaduan baru jika ada keluhan atau saran</p>
                    <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Buat Pengaduan Baru
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection