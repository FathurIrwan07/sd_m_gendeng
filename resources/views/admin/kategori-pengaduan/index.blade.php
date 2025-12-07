{{-- resources/views/admin/kategori-pengaduan/index.blade.php --}}
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

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('kategori-pengaduan.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                <i class="fas fa-plus"></i> Tambah Kategori Pengaduan
    </a>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-list"></i> Daftar Kategori Pengaduan
        </h6>
    </div>
    <div class="card-body">
        @if($kategori->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada kategori pengaduan</h5>
                <p class="text-muted">Silakan tambahkan kategori baru dengan klik tombol "Tambah Kategori"</p>
                <a href="{{ route('kategori-pengaduan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="8%" class="text-center">No</th>
                            <th width="40%">Nama Kategori</th>
                            <th width="17%" class="text-center">Jumlah Pengaduan</th>
                            <th width="15%" class="text-center">Dibuat</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $item->nama_kategori }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="far fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                                </small>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-{{ $item->pengaduan_count > 0 ? 'primary' : 'secondary' }} badge-pill px-3 py-2">
                                    <i class="fas fa-bullhorn"></i> {{ $item->pengaduan_count }} Pengaduan
                                </span>
                            </td>
                            <td class="text-center">
                                <small>
                                    <i class="fas fa-calendar-alt text-primary"></i> 
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('kategori-pengaduan.show', $item->id_kategori) }}" 
                                   class="btn btn-info btn-sm mr-1" 
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kategori-pengaduan.edit', $item->id_kategori) }}" 
                                   class="btn btn-warning btn-sm mr-1"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-danger btn-sm" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal{{ $item->id_kategori }}"
                                        title="Hapus"
                                        @if($item->pengaduan_count > 0) disabled @endif>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $item->id_kategori }}" tabindex="-1" role="dialog">
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
                                        <p>Apakah Anda yakin ingin menghapus kategori:</p>
                                        <div class="text-center my-3">
                                            <h6 class="font-weight-bold">{{ $item->nama_kategori }}</h6>
                                            <p class="text-muted">{{ $item->pengaduan_count }} Pengaduan terkait</p>
                                        </div>
                                        @if($item->pengaduan_count > 0)
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <strong>Perhatian!</strong> Kategori ini memiliki <strong>{{ $item->pengaduan_count }} pengaduan</strong> dan tidak dapat dihapus! 
                                            Silakan hapus atau ubah kategori pengaduan terlebih dahulu.
                                        </div>
                                        @else
                                        <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                            <i class="fas fa-times"></i> Batal
                                        </button>
                                        @if($item->pengaduan_count == 0)
                                        <form action="{{ route('kategori-pengaduan.destroy', $item->id_kategori) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
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
                        <i class="fas fa-tags fa-2x" style="color: #4e73df;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Kategori Pengaduan</h6>
                        <small class="text-muted">Mengelompokkan jenis pengaduan yang masuk</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100" style="border-left: 4px solid #f6c23e; border-radius: 8px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <i class="fas fa-info-circle fa-2x" style="color: #f6c23e;"></i>
                    </div>
                    <div>
                        <h6 class="font-weight-bold mb-1" style="color: #5a5c69;">Informasi</h6>
                        <small class="text-muted">Kategori dengan pengaduan tidak dapat dihapus</small>
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
    
    .btn-sm:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-sm:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 0.85rem;
    }
    
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
</style>
@endpush