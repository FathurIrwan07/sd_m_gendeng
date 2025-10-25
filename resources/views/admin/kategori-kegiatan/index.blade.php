{{-- resources/views/admin/kategori-kegiatan/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kategori Kegiatan</h1>
    <a href="{{ route('kategori-kegiatan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
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

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-list"></i> Daftar Kategori Kegiatan
        </h6>
    </div>
    <div class="card-body">
        @if($kategori->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="40%">Nama Kategori</th>
                        <th width="15%" class="text-center">Jumlah Program</th>
                        <th width="20%" class="text-center">Dibuat</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->nama_kategori }}</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-primary badge-pill">
                                {{ $item->kegiatan_count }} Program
                            </span>
                        </td>
                        <td class="text-center">
                            <small>{{ $item->created_at->format('d M Y') }}</small>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kategori-kegiatan.show', $item->id_kategori) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('kategori-kegiatan.edit', $item->id_kategori) }}" 
                               class="btn btn-warning btn-sm"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $item->id_kategori }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_kategori }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus kategori <strong>{{ $item->nama_kategori }}</strong>?
                                    @if($item->kegiatan_count > 0)
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        Kategori ini memiliki <strong>{{ $item->kegiatan_count }} program</strong> dan tidak dapat dihapus!
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    @if($item->kegiatan_count == 0)
                                    <form action="{{ route('kategori-kegiatan.destroy', $item->id_kategori) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                    @endif
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
            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada kategori kegiatan</h5>
            <p class="text-muted">Silakan tambahkan kategori baru</p>
            <a href="{{ route('kategori-kegiatan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        @endif
    </div>
</div>
@endsection