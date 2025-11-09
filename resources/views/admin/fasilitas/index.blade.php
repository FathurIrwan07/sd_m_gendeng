@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Fasilitas Sekolah</h1>
    <a href="{{ route('fasilitas.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Fasilitas
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Card Grid -->
<div class="row">
    @forelse($fasilitas as $item)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow h-100">
            <!-- Card Header with Maroon Background -->
          <div class="card-header py-3" style="background: linear-gradient(180deg, #800000 10%, #4b0000 100%); color: white;">
            <h6 class="m-0 font-weight-bold" style="color: white;">
                <i class="fas fa-building"></i> {{ $item->nama_fasilitas }}
            </h6>
            <small style="color: white;">{{ $item->updated_at->diffForHumans() }}</small>
        </div>

            
            <!-- Card Body -->
            <div class="card-body">
                <!-- Gambar Fasilitas -->
                @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                         alt="{{ $item->nama_fasilitas }}" 
                         class="img-fluid rounded mb-3 shadow-sm" 
                         style="width: 100%; height: 200px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center rounded mb-3 shadow-sm" 
                         style="width: 100%; height: 200px; background: linear-gradient(135deg, #e0e0e0, #f5f5f5);">
                        <i class="fas fa-image fa-4x text-muted"></i>
                    </div>
                @endif
                
                <!-- Deskripsi -->
                <p class="text-muted mb-3" style="min-height: 60px;">
                    {{ Str::limit($item->deskripsi, 120) }}
                </p>
                
                <!-- Info Tambahan -->
                <div class="small text-muted">
                    <i class="fas fa-user-edit"></i> Terakhir diubah oleh: 
                    <strong>{{ $item->user ? $item->user->nama_lengkap : 'N/A' }}</strong>
                </div>
            </div>
            
            <!-- Card Footer with Action Buttons -->
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('fasilitas.show', $item->id_fasilitas) }}" 
                       class="btn btn-info btn-sm flex-fill mr-1">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    <a href="{{ route('fasilitas.edit', $item->id_fasilitas) }}" 
                       class="btn btn-warning btn-sm flex-fill mx-1">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm flex-fill ml-1" 
                            data-toggle="modal" data-target="#deleteModal{{ $item->id_fasilitas }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $item->id_fasilitas }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #800000; color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form action="{{ route('fasilitas.destroy', $item->id_fasilitas) }}" method="POST" style="display:inline;">
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
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle fa-2x mb-2"></i>
            <h5>Belum Ada Data Fasilitas</h5>
            <p>Silakan tambahkan data fasilitas dengan klik tombol "Tambah Fasilitas" di atas.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($fasilitas->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $fasilitas->links() }}
</div>
@endif

<!-- Informasi Section -->
<div class="card shadow mb-4 mt-4" style="border-left: 4px solid #800000;">
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
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    
    .btn-group-action .btn {
        transition: all 0.2s;
    }
    
    .btn-group-action .btn:hover {
        transform: scale(1.05);
    }
</style>
@endpush