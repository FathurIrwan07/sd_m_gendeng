{{-- resources/views/admin/prestasi/index.blade.php --}}
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
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari judul, nama peraih, atau tingkat prestasi..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('prestasi.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                    <i class="fas fa-plus"></i> Tambah Prestasi
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list"></i> Daftar Prestasi Sekolah</h6>
    </div>
    <div class="card-body">
        @if($prestasi->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada prestasi</h5>
            <p class="text-muted">Silakan tambahkan prestasi baru dengan klik tombol "Tambah Prestasi"</p>
            <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Prestasi
            </a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Gambar</th>
                        <th width="20%">Judul Prestasi</th>
                        <th width="15%">Nama Peraih</th>
                        <th width="12%">Tingkat</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestasi as $index => $item)
                    <tr>
                        <td class="text-center">{{ ($prestasi->currentPage() - 1) * $prestasi->perPage() + $index + 1 }}</td>
                        <td class="text-center">
                            @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->judul_prestasi }}"
                                 class="img-thumbnail"
                                 style="width: 100px; height: 80px; object-fit: cover; cursor: pointer;"
                                 data-toggle="modal" 
                                 data-target="#imageModal{{ $item->id_prestasi }}">
                            @else
                            <div class="bg-gradient-secondary d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 100px; height: 80px; background: linear-gradient(135deg, #e0e0e0, #f5f5f5);">
                                <i class="fas fa-trophy fa-2x text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->judul_prestasi }}</strong>
                            <br>
                            <small class="text-muted">
                                <i class="far fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                            </small>
                        </td>
                        <td>
                            <i class="fas fa-user-graduate text-primary"></i> {{ $item->nama_peraih }}
                        </td>
                        <td>
                            <span class="badge badge-{{ $item->tingkat_prestasi === 'Internasional' ? 'danger' : ($item->tingkat_prestasi === 'Nasional' ? 'primary' : ($item->tingkat_prestasi === 'Provinsi' ? 'success' : 'warning')) }} px-2 py-1">
                                <i class="fas fa-medal"></i> {{ $item->tingkat_prestasi }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('prestasi.show', $item->id_prestasi) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('prestasi.edit', $item->id_prestasi) }}" 
                               class="btn btn-warning btn-sm" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $item->id_prestasi }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Image Modal -->
                    @if($item->gambar)
                    <div class="modal fade" id="imageModal{{ $item->id_prestasi }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $item->judul_prestasi }}</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="{{ $item->judul_prestasi }}"
                                         class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $item->id_prestasi }}" tabindex="-1" role="dialog">
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
                                    <p>Apakah Anda yakin ingin menghapus prestasi:</p>
                                    <div class="text-center my-3">
                                        @if($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                                 class="img-thumbnail mb-2" 
                                                 style="max-width: 200px;">
                                        @endif
                                        <h6 class="font-weight-bold">{{ $item->judul_prestasi }}</h6>
                                        <p class="text-muted">
                                            Peraih: {{ $item->nama_peraih }}<br>
                                            Tingkat: {{ $item->tingkat_prestasi }}
                                        </p>
                                    </div>
                                    <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <form action="{{ route('prestasi.destroy', $item->id_prestasi) }}" method="POST" style="display: inline;">
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
                        Menampilkan {{ $prestasi->firstItem() ?? 0 }} - {{ $prestasi->lastItem() ?? 0 }} 
                        dari {{ $prestasi->total() }} data
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($prestasi->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $prestasi->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $prestasi->lastPage()) as $i)
                            @if($i >= $prestasi->currentPage() - 2 && $i <= $prestasi->currentPage() + 2)
                                @if ($i == $prestasi->currentPage())
                                    <li class="paginate_button page-item active">
                                        <span class="page-link">{{ $i }}</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a href="{{ $prestasi->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($prestasi->hasMorePages())
                            <li class="paginate_button page-item next">
                                <a href="{{ $prestasi->nextPageUrl() }}" class="page-link">Next</a>
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
        <div class="card shadow-sm h-100" style="border-left: 4px solid #e74a3b; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-trophy fa-2x" style="color: #e74a3b;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Prestasi Sekolah</h6>
                        <small class="text-muted">Capaian dan penghargaan yang diraih siswa</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #4e73df; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-medal fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Tingkat Prestasi</h6>
                        <small class="text-muted">Internasional, Nasional, Provinsi, dan lainnya</small>
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
                        <i class="fas fa-camera fa-2x" style="color: #1cc88a;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Dokumentasi</h6>
                        <small class="text-muted">Foto bukti prestasi dan penghargaan</small>
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
    
    #searchInput {
        transition: all 0.2s ease;
    }
    
    #searchInput:focus {
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        border-color: #800000;
    }
    
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
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
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const text = row.textContent.toLowerCase();
            if (text.includes(searchValue)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush