@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Tenaga Pendidik
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
    @forelse($tenagaPendidik as $item)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow h-100">
            <!-- Card Header with Maroon Background -->
            <div class="card-header py-3" style="background: linear-gradient(180deg, #800000 10%, #4b0000 100%); color: white;">
               <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chalkboard-teacher"></i> {{ $item->jabatan }}
                </h6>
                <small>{{ $item->updated_at->diffForHumans() }}</small>
            </div>
            
            <!-- Card Body -->
            <div class="card-body text-center">
                <!-- Foto Tenaga Pendidik -->
                @if($item->foto_tenaga_pendidik)
                    <img src="{{ asset('storage/' . $item->foto_tenaga_pendidik) }}" 
                         alt="{{ $item->nama_lengkap }}" 
                         class="rounded-circle mb-3 shadow" 
                         style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #800000;">
                @else
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" 
                         style="width: 150px; height: 150px; background: linear-gradient(135deg, #800000, #4b0000); border: 4px solid #800000;">
                        <i class="fas fa-user fa-4x text-white"></i>
                    </div>
                @endif
                
                <!-- Nama Lengkap -->
                <h5 class="font-weight-bold mb-2">{{ $item->nama_lengkap }}</h5>
                
                <!-- Jabatan -->
                <p class="text-muted mb-2">
                    <i class="fas fa-id-badge"></i> {{ $item->jabatan }}
                </p>
                
                <!-- Lulusan -->
                @if($item->lulusan)
                <p class="text-primary mb-3">
                    <i class="fas fa-graduation-cap"></i> {{ Str::limit($item->lulusan, 50) }}
                </p>
                @else
                <p class="text-secondary mb-3">
                    <small><i>Belum ada info pendidikan</i></small>
                </p>
                @endif
            </div>
            
            <!-- Card Footer with Action Buttons -->
            <div class="card-footer bg-white border-top-0">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tenaga-pendidik.show', $item->id_tenaga_pendidik) }}" 
                       class="btn btn-info btn-sm flex-fill mr-1">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    <a href="{{ route('tenaga-pendidik.edit', $item->id_tenaga_pendidik) }}" 
                       class="btn btn-warning btn-sm flex-fill mx-1">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger btn-sm flex-fill ml-1" 
                            data-toggle="modal" data-target="#deleteModal{{ $item->id_tenaga_pendidik }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $item->id_tenaga_pendidik }}" tabindex="-1" role="dialog">
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
                    <p>Apakah Anda yakin ingin menghapus tenaga pendidik:</p>
                    <div class="text-center my-3">
                        @if($item->foto_tenaga_pendidik)
                            <img src="{{ asset('storage/' . $item->foto_tenaga_pendidik) }}" 
                                 class="rounded-circle mb-2" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @endif
                        <h6 class="font-weight-bold">{{ $item->nama_lengkap }}</h6>
                        <p class="text-muted">{{ $item->jabatan }}</p>
                        @if($item->lulusan)
                        <p class="text-primary"><small>{{ $item->lulusan }}</small></p>
                        @endif
                    </div>
                    <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form action="{{ route('tenaga-pendidik.destroy', $item->id_tenaga_pendidik) }}" method="POST" style="display:inline;">
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
            <h5>Belum Ada Data Tenaga Pendidik</h5>
            <p>Silakan tambahkan data tenaga pendidik dengan klik tombol "Tambah Tenaga Pendidik" di atas.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($tenagaPendidik->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $tenagaPendidik->links() }}
</div>
@endif

<!-- Informasi Section -->
<div class="card shadow mb-4 mt-4" style="border-left: 4px solid #800000;">
    <div class="card-header py-3" style="background-color: #800000; color: white;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-info-circle"></i> Informasi Tenaga Pendidik
        </h6>
    </div>
    <div class="card-body">
        <p class="mb-2"><i class="fas fa-chalkboard-teacher text-primary"></i> <strong>Tenaga Pendidik:</strong> Guru dan staff pengajar di SD Muhammadiyah Gendeng</p>
        <p class="mb-2"><i class="fas fa-graduation-cap text-success"></i> <strong>Lulusan:</strong> Informasi pendidikan terakhir tenaga pendidik</p>
        <p class="mb-0"><i class="fas fa-camera text-warning"></i> <strong>Foto:</strong> Gunakan foto formal dengan latar belakang polos untuk hasil terbaik</p>
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