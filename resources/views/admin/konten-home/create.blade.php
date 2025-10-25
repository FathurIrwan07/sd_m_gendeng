{{-- resources/views/admin/konten-home/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Konten Home</h1>
    <a href="{{ route('konten-home.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus-circle"></i> Form Konten Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('konten-home.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Tipe Konten -->
                    <div class="form-group">
                        <label for="tipe_konten" class="font-weight-bold">
                            Tipe Konten <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('tipe_konten') is-invalid @enderror" 
                                id="tipe_konten" 
                                name="tipe_konten" 
                                required>
                            <option value="">-- Pilih Tipe Konten --</option>
                            <option value="Sambutan" {{ old('tipe_konten') == 'Sambutan' ? 'selected' : '' }}>
                                Sambutan Kepala Sekolah
                            </option>
                            <option value="Visi" {{ old('tipe_konten') == 'Visi' ? 'selected' : '' }}>
                                Visi Sekolah
                            </option>
                            <option value="Misi" {{ old('tipe_konten') == 'Misi' ? 'selected' : '' }}>
                                Misi Sekolah
                            </option>
                        </select>
                        @error('tipe_konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Judul Konten -->
                    <div class="form-group">
                        <label for="judul_konten" class="font-weight-bold">Judul Konten (Opsional)</label>
                        <input type="text" 
                               class="form-control @error('judul_konten') is-invalid @enderror" 
                               id="judul_konten" 
                               name="judul_konten"
                               placeholder="Contoh: Sambutan Kepala Sekolah"
                               maxlength="50"
                               value="{{ old('judul_konten') }}">
                        <small class="form-text text-muted">Maksimal 50 karakter</small>
                        @error('judul_konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Isi Konten -->
                    <div class="form-group">
                        <label for="isi_konten" class="font-weight-bold">
                            Isi Konten <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('isi_konten') is-invalid @enderror" 
                                  id="isi_konten" 
                                  name="isi_konten" 
                                  rows="8" 
                                  placeholder="Tulis isi konten di sini..."
                                  required>{{ old('isi_konten') }}</textarea>
                        @error('isi_konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto Kepala Sekolah (hanya untuk Sambutan) -->
                    <div class="form-group" id="foto-group" style="display: none;">
                        <label for="foto_kepsek" class="font-weight-bold">Foto Kepala Sekolah</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('foto_kepsek') is-invalid @enderror" 
                                   id="foto_kepsek" 
                                   name="foto_kepsek"
                                   accept="image/*">
                            <label class="custom-file-label" for="foto_kepsek">Pilih foto...</label>
                        </div>
                        <small class="form-text text-muted">
                            Format: JPG, PNG, GIF. Maksimal 2MB
                        </small>
                        @error('foto_kepsek')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <!-- Preview Image -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Konten
                        </button>
                        <a href="{{ route('konten-home.index') }}" class="btn btn-secondary">
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
                <h6 class="text-primary"><i class="fas fa-bullhorn"></i> Sambutan</h6>
                <p class="small">Kata sambutan dari Kepala Sekolah. Dapat menyertakan foto Kepala Sekolah.</p>
                
                <h6 class="text-success mt-3"><i class="fas fa-eye"></i> Visi</h6>
                <p class="small">Visi sekolah yang ingin dicapai di masa depan.</p>
                
                <h6 class="text-warning mt-3"><i class="fas fa-tasks"></i> Misi</h6>
                <p class="small">Misi atau langkah-langkah untuk mencapai visi sekolah.</p>
                
                <hr>
                
                <div class="alert alert-info mb-0">
                    <small>
                        <i class="fas fa-lightbulb"></i> <strong>Tips:</strong><br>
                        - Setiap tipe konten hanya bisa dibuat sekali<br>
                        - Pastikan konten mudah dipahami<br>
                        - Gunakan bahasa yang formal
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipeKonten = document.getElementById('tipe_konten');
    const fotoGroup = document.getElementById('foto-group');
    const fotoInput = document.getElementById('foto_kepsek');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileLabel = document.querySelector('.custom-file-label');
    
    // Toggle foto kepala sekolah berdasarkan tipe konten
    tipeKonten.addEventListener('change', function() {
        if (this.value === 'Sambutan') {
            fotoGroup.style.display = 'block';
        } else {
            fotoGroup.style.display = 'none';
            fotoInput.value = '';
            fileLabel.textContent = 'Pilih foto...';
            previewContainer.style.display = 'none';
        }
    });
    
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
    
    // Trigger pada page load jika ada old value
    if (tipeKonten.value === 'Sambutan') {
        fotoGroup.style.display = 'block';
    }
});
</script>
@endpush
@endsection