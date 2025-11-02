{{-- resources/views/admin/pengaduan/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Pengaduan</h1>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Summary Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengaduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduan->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Menunggu Konfirmasi</div>
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

    <div class="col-xl-3 col-md-6 mb-4">
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

    <div class="col-xl-3 col-md-6 mb-4">
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
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-list"></i> Daftar Pengaduan
        </h6>
    </div>
    <div class="card-body">
        @if($pengaduan->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Pelapor</th>
                        <th width="15%">Kategori</th>
                        <th width="30%">Deskripsi</th>
                        <th width="10%" class="text-center">Tanggal</th>
                        <th width="10%" class="text-center">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            @if($item->pelapor)
                            <strong>{{ $item->pelapor->nama_lengkap }}</strong><br>
                            <small class="text-muted">{{ $item->pelapor->username }}</small>
                            @else
                            <span class="badge badge-secondary">Anonim</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $item->kategori->nama_kategori }}</span>
                        </td>
                        <td>{{ Str::limit($item->deskripsi, 80) }}</td>
                        <td class="text-center">
                            <small>{{ $item->tanggal_pengaduan->format('d/m/Y') }}</small>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ 
                                $item->status_pengaduan === 'Selesai' ? 'success' : 
                                ($item->status_pengaduan === 'Diproses' ? 'warning' : 
                                ($item->status_pengaduan === 'Ditolak' ? 'danger' : 'secondary')) 
                            }}">
                                {{ $item->status_pengaduan }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(!$item->tanggapan)
                            <a href="{{ route('tanggapan.create') }}?pengaduan_id={{ $item->id_pengaduan }}" 
                               class="btn btn-success btn-sm"
                               title="Beri Tanggapan">
                                <i class="fas fa-reply"></i>
                            </a>
                            @endif
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $item->id_pengaduan }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_pengaduan }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus pengaduan ini?
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada pengaduan</h5>
            <p class="text-muted">Pengaduan dari masyarakat akan muncul di sini</p>
        </div>
        @endif
    </div>
</div>
@endsection