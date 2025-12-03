@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('fasilitas.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Fasilitas
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Fasilitas Sekolah</h6>
    </div>
    <div class="card-body">
        @if($fasilitas->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-building fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada data fasilitas</h5>
            <p class="text-muted">Silakan tambahkan fasilitas baru dengan klik tombol "Tambah Fasilitas"</p>
            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Fasilitas
            </a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th width="20%">Nama Fasilitas</th>
                        <th width="40%">Deskripsi</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fasilitas as $index => $item)
                    <tr>
                        <td class="text-center">{{ ($fasilitas->currentPage() - 1) * $fasilitas->perPage() + $index + 1 }}</td>
                        <td class="text-center">
                            @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->nama_fasilitas }}"
                                 class="img-thumbnail"
                                 style="width: 100px; height: 80px; object-fit: cover; cursor: pointer;"
                                 data-toggle="modal" 
                                 data-target="#imageModal{{ $item->id_fasilitas }}">
                            @else
                            <div class="bg-gradient-secondary d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 100px; height: 80px; background: linear-gradient(135deg, #e0e0e0, #f5f5f5);">
                                <i class="fas fa-image fa-2x text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td><strong>{{ $item->nama_fasilitas }}</strong></td>
                        <td class="text-justify">{{ Str::limit($item->deskripsi, 150) }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('fasilitas.show', $item->id_fasilitas) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('fasilitas.edit', $item->id_fasilitas) }}" 
                                   class="btn btn-warning btn-sm" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-danger btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal{{ $item->id_fasilitas }}"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Image Modal -->
                    @if($item->gambar)
                    <div class="modal fade" id="imageModal{{ $item->id_fasilitas }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $item->nama_fasilitas }}</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="{{ $item->nama_fasilitas }}"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_fasilitas }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #800000; color: white;">
                                    <h5 class="modal-title">
                                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                    </h5>
                                    <button class="close text-white" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus fasilitas:</p>
                                    <div class="text-center my-3">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                                 class="img-thumbnail mb-2" 
                                                 style="max-width: 200px;">
                                        @endif
                                        <h6 class="font-weight-bold">{{ $item->nama_fasilitas }}</h6>
                                    </div>
                                    <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <form action="{{ route('fasilitas.destroy', $item->id_fasilitas) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="dataTables_info">
                    <small class="text-muted">
                        Menampilkan {{ $fasilitas->firstItem() ?? 0 }} - {{ $fasilitas->lastItem() ?? 0 }} 
                        dari {{ $fasilitas->total() }} data
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($fasilitas->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $fasilitas->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $fasilitas->lastPage()) as $i)
                            @if($i >= $fasilitas->currentPage() - 2 && $i <= $fasilitas->currentPage() + 2)
                                @if ($i == $fasilitas->currentPage())
                                    <li class="paginate_button page-item active">
                                        <span class="page-link">{{ $i }}</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a href="{{ $fasilitas->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($fasilitas->hasMorePages())
                            <li class="paginate_button page-item next">
                                <a href="{{ $fasilitas->nextPageUrl() }}" class="page-link">Next</a>
                            </li>
                        @else
                            <li class="paginate_button page-item next disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Informasi Section -->
<div class="card shadow mb-4" style="border-left: 4px solid #800000;">
    <div class="card-header py-3" style="background-color: #800000; color: white;">
        <h6 class="m-0 font-weight-bold" style="color: white;">
            <i class="fas fa-info-circle"></i> Informasi Fasilitas
        </h6>
    </div>
    <div class="card-body">
        <p class="mb-2"><i class="fas fa-building text-primary"></i> <strong>Fasilitas:</strong> Sarana dan prasarana yang tersedia di SD Muhammadiyah Gendeng</p>
        <p class="mb-0"><i class="fas fa-camera text-success"></i> <strong>Gambar:</strong> Gunakan foto berkualitas tinggi untuk hasil terbaik</p>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table tbody tr {
        transition: background-color 0.2s;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    .img-thumbnail {
        transition: transform 0.2s;
    }
    
    .img-thumbnail:hover {
        transform: scale(1.05);
    }
</style>
@endpush