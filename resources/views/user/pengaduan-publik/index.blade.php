{{-- resources/views/user/pengaduan-publik/index.blade.php --}}
@extends('user.app')

@section('content')

<!-- Statistics Cards -->
@if($pengaduan->total() > 0)
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Publik</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduan->total() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-globe fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Anonim</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $pengaduan->total() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-secret fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Table Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-globe"></i> Daftar Pengaduan Publik
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
                            <th width="25%">Deskripsi</th>
                            <th class="text-center" width="10%">Status</th>
                            <th width="20%">Tanggapan</th>
                            <th class="text-center" width="8%">Pelapor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduan as $key => $item)
                        <tr>
                            <td class="text-center">{{ $pengaduan->firstItem() + $key }}</td>
                            <td>
                                <span class="badge badge-info">
                                    <i class="fas fa-tag"></i>
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                            <td class="text-center">
                                @if($item->status_pengaduan === 'Selesai')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </span>
                                @elseif($item->status_pengaduan === 'Diproses')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-spinner"></i> Diproses
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-clock"></i> {{ $item->status_pengaduan }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($item->tanggapan)
                                    <div title="{{ $item->tanggapan->isi_tanggapan }}">
                                        <i class="fas fa-reply text-success"></i>
                                        {{ Str::limit($item->tanggapan->isi_tanggapan, 80) }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-user-shield"></i> 
                                        {{ $item->tanggapan->penanggap ? $item->tanggapan->penanggap->name : 'Admin' }}
                                    </small>
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-times"></i> Belum Ada
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge badge-secondary">
                                    <i class="fas fa-user"></i>
                                    {{ $item->pelapor ? $item->pelapor->name : 'Anonim' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $pengaduan->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum Ada Pengaduan Publik</h5>
                <p class="text-muted">Pengaduan anonim yang telah diproses atau diselesaikan akan ditampilkan di halaman ini</p>
            </div>
        @endif
    </div>
</div>

@endsection