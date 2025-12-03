{{-- resources/views/admin/kegiatan/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('kegiatan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Program
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
        <div class="row align-items-center">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Program Kegiatan</h6>
            </div>
            <div class="col-md-6">
                <div class="form-inline float-md-right">
                    <label class="mr-2">Filter Kategori:</label>
                    <select id="filterKategori" class="form-control form-control-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($kegiatan->unique('id_kategori') as $item)
                            <option value="{{ $item->kategori->nama_kategori }}" {{ request('kategori') == $item->kategori->nama_kategori ? 'selected' : '' }}>
                                {{ $item->kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
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
                        <th width="15%">Foto</th>
                        <th width="15%">Kategori</th>
                        <th width="20%">Nama Program</th>
                        <th width="25%">Deskripsi</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
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
                            <div class="bg-gradient-primary d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 100px; height: 80px; background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                                <i class="fas fa-image fa-2x text-white opacity-50"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $item->kategori->nama_kategori === 'Ekstrakurikuler' ? 'primary' : ($item->kategori->nama_kategori === 'Rutin' ? 'success' : 'warning') }} p-2">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                        </td>
                        <td><strong>{{ $item->nama_program }}</strong></td>
                        <td class="text-justify">{{ Str::limit($item->deskripsi, 100) }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('kegiatan.show', $item->id_kegiatan) }}" 
                                   class="btn btn-info btn-sm" 
                                   title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" 
                                   class="btn btn-warning btn-sm" 
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
                            </div>
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
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus program <strong>{{ $item->nama_program }}</strong>?
                                    @if($item->foto_program)
                                    <p class="mb-0 mt-2"><small class="text-muted">* Foto yang terlampir juga akan dihapus</small></p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('kegiatan.destroy', $item->id_kegiatan) }}" method="POST">
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
                        {{-- Previous Page Link --}}
                        @if ($kegiatan->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $kegiatan->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
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

                        {{-- Next Page Link --}}
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

@push('scripts')
<script>
    // Filter by category with pagination support
    document.getElementById('filterKategori').addEventListener('change', function() {
        const selectedKategori = this.value;
        
        // Redirect with kategori parameter to maintain pagination
        if (selectedKategori) {
            window.location.href = '{{ route("kegiatan.index") }}?kategori=' + encodeURIComponent(selectedKategori);
        } else {
            window.location.href = '{{ route("kegiatan.index") }}';
        }
    });
</script>
@endpush
@endsection