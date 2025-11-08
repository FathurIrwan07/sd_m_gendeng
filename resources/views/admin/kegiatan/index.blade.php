{{-- resources/views/admin/kegiatan/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Program Kegiatan</h1>
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

<div class="row">
    @forelse($kegiatan as $item)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow h-100">
            @if($item->foto_program)
            <img src="{{ asset('storage/' . $item->foto_program) }}" 
                 class="card-img-top" 
                 alt="{{ $item->nama_program }}"
                 style="height: 200px; object-fit: cover;">
            @else
            <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                 style="height: 200px; background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <i class="fas fa-image fa-3x text-white opacity-50"></i>
            </div>
            @endif
            
            <div class="card-body d-flex flex-column">
                <div class="mb-2">
                    <span class="badge badge-{{ $item->kategori->nama_kategori === 'Ekstrakurikuler' ? 'primary' : ($item->kategori->nama_kategori === 'Rutin' ? 'success' : 'warning') }}">
                        {{ $item->kategori->nama_kategori }}
                    </span>
                </div>
                
                <h5 class="card-title">{{ $item->nama_program }}</h5>
                <p class="card-text text-justify flex-grow-1">
                    {{ Str::limit($item->deskripsi, 120) }}
                </p>
                
                <div class="mt-auto">
                    @if($item->user)
                    <small class="text-muted d-block mb-2">
                        <i class="fas fa-user-edit"></i> {{ $item->user->nama_lengkap  }}
                    </small>
                    @endif
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                    </small>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('kegiatan.show', $item->id_kegiatan) }}" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-sm" 
                                data-toggle="modal" 
                                data-target="#deleteModal{{ $item->id_kegiatan }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    @empty
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada program kegiatan</h5>
                <p class="text-muted">Silakan tambahkan program baru dengan klik tombol "Tambah Program"</p>
                <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Program
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection