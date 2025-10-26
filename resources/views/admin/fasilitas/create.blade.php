@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Fasilitas</h1>
    <a href="{{ route('fasilitas.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Fasilitas</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nama_fasilitas">Nama Fasilitas <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" 
                       id="nama_fasilitas" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" 
                       placeholder="Contoh: Ruang Komputer" required>
                @error('nama_fasilitas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" name="deskripsi" rows="5" 
                          placeholder="Deskripsi lengkap fasilitas..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gambar">Gambar Fasilitas</label>
                <input type="file" class="form-control-file @error('gambar') is-invalid @enderror" 
                       id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB</small>
                @error('gambar')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                <!-- Image Preview -->
                <div class="mt-2" id="imagePreview" style="display: none;">
                    <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        preview.src = reader.result;
        previewDiv.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush