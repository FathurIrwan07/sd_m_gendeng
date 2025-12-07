{{-- resources/views/admin/kegiatan/index.blade.php --}}
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

<!-- Search, Filter and Add Card -->
<div class="card shadow-sm mb-3" style="border: none; border-radius: 8px;">
    <div class="card-body py-3">
        <div class="row align-items-center">
            <div class="col-md-4 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white" style="border-right: none;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari nama program atau deskripsi..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-4 mb-2 mb-md-0">
                <select id="filterKategori" class="form-control">
                    <option value="">Semua Kategori</option>
                    @foreach($kegiatan->unique('id_kategori') as $item)
                        <option value="{{ $item->kategori->nama_kategori }}" {{ request('kategori') == $item->kategori->nama_kategori ? 'selected' : '' }}>
                            {{ $item->kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="{{ route('kegiatan.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                    <i class="fas fa-plus"></i> Tambah Program
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list"></i> Daftar Program Kegiatan</h6>
    </div>
    <div class="card-body">
        @if($kegiatan->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada program kegiatan</h5>
            <p class="text-muted">Silakan tambahkan program baru dengan klik tombol "Tambah Program"</p>
            <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Program
            </a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Foto</th>
                        <th width="13%">Kategori</th>
                        <th width="20%">Nama Program</th>
                        <th width="30%">Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan as $index => $item)
                    <tr data-kategori="{{ $item->kategori->nama_kategori }}">
                        <td class="text-center">{{ ($kegiatan->currentPage() - 1) * $kegiatan->perPage() + $index + 1 }}</td>
                        <td class="text-center">
                            @if($item->foto_program)
                            <img src="{{ asset('storage/' . $item->foto_program) }}" 
                                 alt="{{ $item->nama_program }}"
                                 class="img-thumbnail"
                                 style="width: 100px; height: 80px; object-fit: cover; cursor: pointer;"
                                 data-toggle="modal" 
                                 data-target="#imageModal{{ $item->id_kegiatan }}">
                            @else
                            <div class="bg-gradient-secondary d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 100px; height: 80px; background: linear-gradient(135deg, #e0e0e0, #f5f5f5);">
                                <i class="fas fa-image fa-2x text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $item->kategori->nama_kategori === 'Ekstrakurikuler' ? 'primary' : ($item->kategori->nama_kategori === 'Rutin' ? 'success' : 'warning') }} px-2 py-1">
                                <i class="fas fa-tag"></i> {{ $item->kategori->nama_kategori }}
                            </span>
                        </td>
                        <td>
                            <strong>{{ $item->nama_program }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                            </small>
                        </td>
                        <td>
                            @if($item->deskripsi)
                                {{ Str::limit($item->deskripsi, 100) }}
                            @else
                                <small class="text-muted"><i>Belum ada deskripsi</i></small>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kegiatan.show', $item->id_kegiatan) }}" 
                               class="btn btn-info btn-sm mr-1" 
                               title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" 
                               class="btn btn-warning btn-sm mr-1" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $item->id_kegiatan }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Image Modal -->
                    @if($item->foto_program)
                    <div class="modal fade" id="imageModal{{ $item->id_kegiatan }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $item->nama_program }}</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $item->foto_program) }}" 
                                         alt="{{ $item->nama_program }}"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_kegiatan }}" tabindex="-1" role="dialog">
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
                                    <p>Apakah Anda yakin ingin menghapus program kegiatan:</p>
                                    <div class="text-center my-3">
                                        @if($item->foto_program)
                                            <img src="{{ asset('storage/' . $item->foto_program) }}" 
                                                 class="img-thumbnail mb-2" 
                                                 style="max-width: 200px;">
                                        @endif
                                        <h6 class="font-weight-bold">{{ $item->nama_program }}</h6>
                                        <p class="text-muted">Kategori: {{ $item->kategori->nama_kategori }}</p>
                                    </div>
                                    <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <form action="{{ route('kegiatan.destroy', $item->id_kegiatan) }}" method="POST" style="display: inline;">
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
                        Menampilkan {{ $kegiatan->firstItem() ?? 0 }} - {{ $kegiatan->lastItem() ?? 0 }} 
                        dari {{ $kegiatan->total() }} data
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                    <ul class="pagination">
                        @if ($kegiatan->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $kegiatan->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

                        @foreach(range(1, $kegiatan->lastPage()) as $i)
                            @if($i >= $kegiatan->currentPage() - 2 && $i <= $kegiatan->currentPage() + 2)
                                @if ($i == $kegiatan->currentPage())
                                    <li class="paginate_button page-item active">
                                        <span class="page-link">{{ $i }}</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a href="{{ $kegiatan->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach

                        @if ($kegiatan->hasMorePages())
                            <li class="paginate_button page-item next">
                                <a href="{{ $kegiatan->nextPageUrl() }}" class="page-link">Next</a>
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
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #4e73df; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-clipboard-list fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Program Kegiatan</h6>
                        <small class="text-muted">Berbagai program dan kegiatan sekolah</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #1cc88a; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-tags fa-2x" style="color: #1cc88a;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Kategori</h6>
                        <small class="text-muted">Ekstrakurikuler, Rutin, dan lainnya</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #f6c23e; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-camera fa-2x" style="color: #f6c23e;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Dokumentasi</h6>
                        <small class="text-muted">Foto kegiatan dengan resolusi baik</small>
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
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    
    #searchInput, #filterKategori {
        transition: all 0.2s ease;
    }
    
    #searchInput:focus, #filterKategori:focus {
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
    // Search functionality
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

    // Filter by category - Redirect to maintain pagination
    document.getElementById('filterKategori').addEventListener('change', function() {
        const selectedKategori = this.value;
        
        if (selectedKategori) {
            window.location.href = '{{ route("kegiatan.index") }}?kategori=' + encodeURIComponent(selectedKategori);
        } else {
            window.location.href = '{{ route("kegiatan.index") }}';
        }
    });
</script>
@endpush