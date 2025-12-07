@extends('admin.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Search and Add Card -->
<div class="card shadow-sm mb-3" style="border: none; border-radius: 8px;">
    <div class="card-body py-3">
        <div class="row align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white" style="border-right: none;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari nama fasilitas atau deskripsi..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('fasilitas.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                    <i class="fas fa-plus"></i> Tambah Fasilitas
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list"></i> Daftar Fasilitas Sekolah</h6>
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
                        <th width="20%">Aksi</th>
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
                        <td>
                            <strong>{{ $item->nama_fasilitas }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                            </small>
                        </td>
                        <td>
                            @if($item->deskripsi)
                                {{ Str::limit($item->deskripsi, 150) }}
                            @else
                                <small class="text-muted"><i>Belum ada deskripsi</i></small>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('fasilitas.show', $item->id_fasilitas) }}" 
                               class="btn btn-info btn-sm mr-1" 
                               title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('fasilitas.edit', $item->id_fasilitas) }}" 
                               class="btn btn-warning btn-sm mr-1" 
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
                                <div class="modal-header">
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
                                    <form action="{{ route('fasilitas.destroy', $item->id_fasilitas) }}" method="POST" style="display: inline;">
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
                        @if ($fasilitas->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $fasilitas->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

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
<div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #4e73df; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-building fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Fasilitas Sekolah</h6>
                        <small class="text-muted">Sarana dan prasarana yang tersedia di SD Muhammadiyah Gendeng</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #1cc88a; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-camera fa-2x" style="color: #1cc88a;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Dokumentasi</h6>
                        <small class="text-muted">Gunakan foto berkualitas tinggi untuk hasil terbaik</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    .btn-sm {
        transition: all 0.2s ease;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    #searchInput {
        transition: all 0.2s ease;
    }
    
    #searchInput:focus {
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        border-color: #800000;
    }
    
    img[data-toggle="modal"] {
        transition: transform 0.2s ease;
    }
    
    img[data-toggle="modal"]:hover {
        transform: scale(1.05);
    }
    
    .pagination .page-link {
        color: #800000;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #800000;
        border-color: #800000;
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#dataTable tbody tr');
        
        tableRows.forEach(row => {
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush