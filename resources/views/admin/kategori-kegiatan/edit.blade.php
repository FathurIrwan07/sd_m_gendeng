{{-- resources/views/admin/kategori-kegiatan/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Kategori Kegiatan</h1>
    <a href="{{ route('kategori-kegiatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                     <i class="fas fa-edit"></i> Form Edit Kategori Kegiatan
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori-kegiatan.update', $kategoriKegiatan->id_kategori) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nama_kategori" class="font-weight-bold">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_kategori') is-invalid @enderror" 
                               id="nama_kategori" 
                               name="nama_kategori"
                               placeholder="Contoh: Ekstrakurikuler, Rutin, Unggulan"
                               maxlength="50"
                               value="{{ old('nama_kategori', $kategoriKegiatan->nama_kategori) }}"
                               required>
                        <small class="form-text text-muted">Maksimal 50 karakter</small>
                        @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Kategori
                        </button>
                        <a href="{{ route('kategori-kegiatan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-history"></i> Informasi Update
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <strong>{{ $kategoriKegiatan->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $kategoriKegiatan->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Jumlah Program:</small><br>
                    <span class="badge badge-primary badge-pill">
                        {{ $kategoriKegiatan->kegiatan->count() }} Program
                    </span>
                </div>
                
                <hr>
                
                <div class="alert alert-warning mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong><br>
                        Perubahan akan mempengaruhi semua program dalam kategori ini.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection