{{-- resources/views/admin/kategori-kegiatan/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Kategori Kegiatan</h1>
    <a href="{{ route('kategori-kegiatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus-circle"></i> Form Kategori Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori-kegiatan.store') }}" method="POST">
                    @csrf
                    
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
                               value="{{ old('nama_kategori') }}"
                               required>
                        <small class="form-text text-muted">Maksimal 50 karakter</small>
                        @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Kategori
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
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Informasi
                </h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Contoh Kategori:</h6>
                <ul class="mb-3">
                    <li>Ekstrakurikuler</li>
                    <li>Rutin</li>
                    <li>Unggulan</li>
                    <li>Keagamaan</li>
                    <li>Olahraga</li>
                </ul>
                
                <div class="alert alert-info mb-0">
                    <small>
                        <i class="fas fa-lightbulb"></i> <strong>Tips:</strong><br>
                        Kategori digunakan untuk mengelompokkan program kegiatan sekolah
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection