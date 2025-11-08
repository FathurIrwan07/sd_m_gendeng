{{-- resources/views/admin/konten-home/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Konten Home</h1>
    <a href="{{ route('konten-home.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Konten Baru
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
    @forelse($kontenHome as $konten)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 d-flex justify-content-between align-items-center" 
                 style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-{{ $konten->tipe_konten === 'Sambutan' ? 'bullhorn' : ($konten->tipe_konten === 'Visi' ? 'eye' : 'tasks') }}"></i>
                    {{ $konten->tipe_konten }}
                </h6>
                <span class="badge badge-light">{{ $konten->updated_at->diffForHumans() }}</span>
            </div>
            
            <div class="card-body">
                @if($konten->foto_kepsek_url && $konten->tipe_konten === 'Sambutan')
                <div class="text-center mb-3">
                    <img src="{{ Storage::url($konten->foto_kepsek_url) }}" 
                         class="img-thumbnail rounded-circle" 
                         alt="Foto Kepala Sekolah"
                         style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                @endif
                
                @if($konten->judul_konten)
                <h5 class="card-title text-primary">{{ $konten->judul_konten }}</h5>
                @endif
                
                <p class="card-text text-justify" style="font-size: 0.9rem;">
                    {{ Str::limit($konten->isi_konten, 150) }}
                </p>
                
                @if($konten->user)
                <small class="text-muted">
                    <i class="fas fa-user-edit"></i> 
                    Terakhir diubah oleh: <strong>{{ $konten->user->nama_lengkap  }}</strong>
                </small>
                @endif
            </div>
            
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('konten-home.show', $konten->home_id) }}" 
                   class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> Lihat
                </a>
                <a href="{{ route('konten-home.edit', $konten->home_id) }}" 
                   class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" 
                        class="btn btn-danger btn-sm" 
                        data-toggle="modal" 
                        data-target="#deleteModal{{ $konten->home_id }}">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $konten->home_id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus konten <strong>{{ $konten->tipe_konten }}</strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('konten-home.destroy', $konten->home_id) }}" method="POST">
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
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle fa-3x mb-3"></i>
            <h5>Belum ada konten</h5>
            <p>Silakan tambahkan konten baru dengan klik tombol "Tambah Konten Baru"</p>
        </div>
    </div>
    @endforelse
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Informasi Konten
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-bullhorn text-primary"></i> 
                        <strong>Sambutan:</strong> Kata sambutan dari Kepala Sekolah (dapat menyertakan foto)
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-eye text-success"></i> 
                        <strong>Visi:</strong> Visi SD Muhammadiyah Gendeng
                    </li>
                    <li>
                        <i class="fas fa-tasks text-warning"></i> 
                        <strong>Misi:</strong> Misi SD Muhammadiyah Gendeng
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection