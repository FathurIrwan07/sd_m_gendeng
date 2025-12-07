{{-- resources/views/admin/kategori-kegiatan/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kategori Kegiatan</h1>
    <div>
        <a href="{{ route('kategori-kegiatan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-tag"></i> {{ $kategoriKegiatan->nama_kategori }}
                </h6>
            </div>
            <div class="card-body">
                <h4 class="text-primary mb-4">{{ $kategoriKegiatan->nama_kategori }}</h4>
                
                <div class="mb-4">
                    <h6 class="font-weight-bold">Informasi Kategori:</h6>
                    <table class="table table-borderless">
                        <tr>
                            <td width="200"><i class="fas fa-calendar text-muted"></i> Dibuat Pada</td>
                            <td>: {{ $kategoriKegiatan->created_at->format('d F Y, H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-clock text-muted"></i> Terakhir Diubah</td>
                            <td>: {{ $kategoriKegiatan->updated_at->format('d F Y, H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-clipboard-list text-muted"></i> Jumlah Program</td>
                            <td>: <span class="badge badge-primary">{{ $kategoriKegiatan->kegiatan->count() }} Program</span></td>
                        </tr>
                    </table>
                </div>

                <hr>

                <h6 class="font-weight-bold mb-3">
                    <i class="fas fa-list"></i> Daftar Program dalam Kategori Ini:
                </h6>
                
                @if($kategoriKegiatan->kegiatan->count() > 0)
                <div class="list-group">
                    @foreach($kategoriKegiatan->kegiatan as $kegiatan)
                    <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $kegiatan->nama_program }}</h6>
                            <small class="text-muted">{{ $kegiatan->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1 text-muted">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                        @if($kegiatan->user)
                        <small class="text-muted">
                            <i class="fas fa-user"></i> {{ $kegiatan->user->name }}
                        </small>
                        @endif
                    </a>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada program dalam kategori ini.
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Statistik -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie"></i> Total Program Kegiatan
                </h6>
            </div>
            <div class="card-body text-center">
                <h2 class="text-primary">{{ $kategoriKegiatan->kegiatan->count() }}</h2>
                <p class="text-muted mb-0">Total Program Kegiatan</p>
            </div>
        </div>
    </div>
</div>

@endsection