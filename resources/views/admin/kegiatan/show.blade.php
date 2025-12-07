{{-- resources/views/admin/kegiatan/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Program Kegiatan</h1>
    <div>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clipboard-list"></i> {{ $kegiatan->nama_program }}
                    </h6>
                    <span class="badge badge-light">{{ $kegiatan->kategori->nama_kategori }}</span>
                </div>
            </div>
            <div class="card-body">
                @if($kegiatan->foto_program)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $kegiatan->foto_program) }}" 
                         alt="{{ $kegiatan->nama_program }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 400px; object-fit: cover; width: 100%;">
                </div>
                @endif

                <h3 class="text-primary mb-3">{{ $kegiatan->nama_program }}</h3>
                
                <div class="mb-3">
                    <span class="badge badge-{{ $kegiatan->kategori->nama_kategori === 'Ekstrakurikuler' ? 'primary' : ($kegiatan->kategori->nama_kategori === 'Rutin' ? 'success' : 'warning') }} badge-lg px-3 py-2">
                        <i class="fas fa-tag"></i> {{ $kegiatan->kategori->nama_kategori }}
                    </span>
                </div>

                <hr>

                <h5 class="font-weight-bold mb-3">Deskripsi Program:</h5>
                <div class="content-display">
                    <p class="text-justify" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">{{ $kegiatan->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Informasi Program Kegiatan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Kategori:</small><br>
                    <span class="badge badge-primary badge-lg">{{ $kegiatan->kategori->nama_kategori }}</span>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Dibuat Pada:</small><br>
                    <strong>{{ $kegiatan->created_at->format('d F Y') }}</strong><br>
                    <small>{{ $kegiatan->created_at->format('H:i') }} WIB</small>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Terakhir Diperbarui:</small><br>
                    <strong>{{ $kegiatan->updated_at->format('d F Y') }}</strong><br>
                    <small>{{ $kegiatan->updated_at->format('H:i') }} WIB</small><br>
                    <small class="text-info">({{ $kegiatan->updated_at->diffForHumans() }})</small>
                </div>

                @if($kegiatan->user)
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah Oleh:</small><br>
                    <div class="d-flex align-items-center mt-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" 
                             style="width: 40px; height: 40px;">
                            <strong>{{ substr($kegiatan->user->nama_lengkap, 0, 1) }}</strong>
                        </div>
                        <div>
                            <strong>{{ $kegiatan->user->name }}</strong><br>
                            <small class="text-muted">{{ $kegiatan->user->email }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

                <div class="mb-0">
                    <small class="text-muted">Status Foto:</small><br>
                    @if($kegiatan->foto_program)
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle"></i> Ada Foto
                    </span>
                    @else
                    <span class="badge badge-secondary">
                        <i class="fas fa-times-circle"></i> Tanpa Foto
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection