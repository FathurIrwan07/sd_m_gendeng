{{-- resources/views/admin/kegiatan/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Program Kegiatan</h1>
    <a href="{{ route('kegiatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus-circle"></i> Form Program Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="id_kategori" class="font-weight-bold">
                            Kategori Kegiatan <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('id_kategori') is-invalid @enderror" 
                                id="id_kategori" 
                                name="id_kategori" 
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $item)
                            <option value="{{ $item->id_kategori }}" 
                                    {{ old('id_kategori', request('kategori')) == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($kategori->count() == 0)
                        <small class="form-text text-danger">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Belum ada kategori. <a href="{{ route('kategori-kegiatan.create') }}">Buat kategori dulu</a>
                        </small>
                        @endif
                    </div>

                    <!-- Nama Program -->
                    <div class="form-group">
                        <label for="nama_program" class="font-weight-bold">
                            Nama Program <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_program') is-invalid @enderror" 
                               id="nama_program" 
                               name="nama_program"
                               placeholder="Contoh: Pramuka, Tartil Al-Quran, Futsal"
                               maxlength="255"
                               value="{{ old('nama_program') }}"
                               required>
                        @error('nama_program')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi" class="font-weight-bold">
                            Deskripsi Program <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="6" 
                                  placeholder="Jelaskan detail program kegiatan..."
                                  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto Program -->
                    <div class="form-group">
                        <label for="foto_program" class="font-weight-bold">Foto Program</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('foto_program') is-invalid @enderror" 
                                   id="foto_program" 
                                   name="foto_program"
                                   accept="image/*">
                            <label class="custom-file-label" for="foto_program">Pilih foto...</label>
                        </div>
                        <small class="form-text text-muted">
                            Format: JPG, PNG, GIF. Maksimal 2MB
                        </small>
                        @error('foto_program')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <!-- Preview Image -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <p class="font-weight-bold">Preview:</p>
                            <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Program
                        </button>
                        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
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
                    <i class="fas fa-info-circle"></i> Panduan Pengisian
                </h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Tips:</h6>
                <ul class="small">
                    <li>Pilih kategori yang sesuai</li>
                    <li>Gunakan nama yang jelas dan singkat</li>
                    <li>Deskripsi harus informatif</li>
                    <li>Foto akan mempercantik tampilan</li>
                </ul>
                
                <hr>
                
                <h6 class="text-success">Contoh Program:</h6>
                <ul class="small mb-0">
                    <li><strong>Ekstrakurikuler:</strong> Pramuka, Futsal, Tartil</li>
                    <li><strong>Rutin:</strong> Upacara Bendera, Senam Pagi</li>
                    <li><strong>Unggulan:</strong> Tahfidz, English Club</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto_program');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileLabel = document.querySelector('.custom-file-label');
    
    // Preview image
    fotoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            fileLabel.textContent = file.name;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            fileLabel.textContent = 'Pilih foto...';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection