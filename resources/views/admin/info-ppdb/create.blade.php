{{-- resources/views/admin/info-ppdb/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Info PPDB</h1>
    <a href="{{ route('info-ppdb.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus-circle"></i> Form Info PPDB Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('info-ppdb.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Syarat Pendaftaran -->
                    <div class="form-group">
                        <label for="syarat_pendaftaran" class="font-weight-bold">
                            Syarat Pendaftaran <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('syarat_pendaftaran') is-invalid @enderror" 
                                  id="syarat_pendaftaran" 
                                  name="syarat_pendaftaran" 
                                  rows="12" 
                                  placeholder="Tuliskan syarat-syarat pendaftaran PPDB...&#10;&#10;Contoh:&#10;1. Fotokopi Akta Kelahiran&#10;2. Fotokopi Kartu Keluarga&#10;3. Pas Foto 3x4 (2 lembar)&#10;4. ..."
                                  required>{{ old('syarat_pendaftaran') }}</textarea>
                        @error('syarat_pendaftaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Tuliskan syarat dengan jelas dan detail untuk memudahkan calon peserta didik
                        </small>
                    </div>

                    <!-- Gambar Brosur -->
                    <div class="form-group">
                        <label for="gambar_brosur" class="font-weight-bold">Brosur PPDB</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('gambar_brosur') is-invalid @enderror" 
                                   id="gambar_brosur" 
                                   name="gambar_brosur"
                                   accept="image/*">
                            <label class="custom-file-label" for="gambar_brosur">Pilih brosur...</label>
                        </div>
                        <small class="form-text text-muted">
                            Upload brosur PPDB. Format: JPG, PNG, GIF. Maksimal 2MB
                        </small>
                        @error('gambar_brosur')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <!-- Preview Image -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <p class="font-weight-bold">Preview:</p>
                            <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 400px;">
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Info PPDB
                        </button>
                        <a href="{{ route('info-ppdb.index') }}" class="btn btn-secondary">
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
                <h6 class="text-primary">Tips Menulis Syarat:</h6>
                <ul class="small">
                    <li>Tulis syarat secara berurutan</li>
                    <li>Gunakan numbering (1, 2, 3...)</li>
                    <li>Jelaskan secara detail dan jelas</li>
                    <li>Sertakan jumlah/ukuran jika perlu</li>
                </ul>
                
                <hr>

                <h6 class="text-success">Contoh Syarat:</h6>
                <div class="small bg-light p-2 rounded">
                    <p class="mb-1">1. Fotokopi Akta Kelahiran (2 lembar)</p>
                    <p class="mb-1">2. Fotokopi Kartu Keluarga (1 lembar)</p>
                    <p class="mb-1">3. Pas Foto 3x4 (2 lembar)</p>
                    <p class="mb-0">4. Formulir pendaftaran</p>
                </div>

                <hr>
                
                <div class="alert alert-info mb-0">
                    <small>
                        <i class="fas fa-school"></i> <strong>Info:</strong><br>
                        Informasi ini akan ditampilkan di halaman PPDB website untuk calon peserta didik baru.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const brosurInput = document.getElementById('gambar_brosur');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileLabel = document.querySelector('.custom-file-label');
    
    brosurInput.addEventListener('change', function() {
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
            fileLabel.textContent = 'Pilih brosur...';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection