{{-- resources/views/admin/prestasi/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a href="{{ route('prestasi.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Prestasi
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
    @forelse($prestasi as $item)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow h-100">
            @if($item->gambar)
            <img src="{{ asset('storage/' . $item->gambar) }}" 
                 class="card-img-top" 
                 alt="{{ $item->judul_prestasi }}"
                 style="height: 200px; object-fit: cover;">
            @else
            <div class="card-img-top bg-gradient-warning d-flex align-items-center justify-content-center" 
                 style="height: 200px;">
                <i class="fas fa-trophy fa-3x text-white opacity-50"></i>
            </div>
            @endif
            
            <div class="card-body d-flex flex-column">
                <div class="mb-2">
                    <span class="badge {{ $item->tingkat_badge_color }}">
                        <i class="fas fa-medal"></i> {{ $item->tingkat_prestasi }}
                    </span>
                    @if($item->tanggal)
                    <span class="badge badge-secondary">
                        <i class="fas fa-calendar"></i> {{ $item->tanggal->format('d M Y') }}
                    </span>
                    @endif
                </div>
                
                <h5 class="card-title font-weight-bold">{{ $item->judul_prestasi }}</h5>
                
                <p class="mb-2">
                    <i class="fas fa-user-graduate text-primary"></i> 
                    <strong>{{ $item->nama_peraih }}</strong>
                </p>
                
                <p class="card-text text-justify flex-grow-1">
                    {{ Str::limit($item->deskripsi, 100) }}
                </p>
                
                <div class="mt-auto">
                    <small class="text-muted d-block mb-3">
                        <i class="fas fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                    </small>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('prestasi.show', $item->id_prestasi) }}" 
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('prestasi.edit', $item->id_prestasi) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-sm" 
                                data-toggle="modal" 
                                data-target="#deleteModal{{ $item->id_prestasi }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $item->id_prestasi }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus prestasi <strong>{{ $item->judul_prestasi }}</strong>?
                    @if($item->gambar)
                    <p class="mb-0 mt-2"><small class="text-muted">* Gambar yang terlampir juga akan dihapus</small></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('prestasi.destroy', $item->id_prestasi) }}" method="POST">
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
                <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada prestasi</h5>
                <p class="text-muted">Silakan tambahkan prestasi baru dengan klik tombol "Tambah Prestasi"</p>
                <a href="{{ route('prestasi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Prestasi
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection