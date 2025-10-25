{{-- resources/views/admin/konten-home/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Konten Home</h1>
    <a href="{{ route('konten-home.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit Konten: {{ $kontenHome->tipe_konten }}
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('konten-home.update', $kontenHome->home_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
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
                            <option value="Sambutan" {{ old('tipe_konten', $kontenHome->tipe_konten) == 'Sambutan' ? 'selected' : '' }}>
                                Sambutan Kepala Sekolah
                            </option>
                            <option value="Visi" {{ old('tipe_konten', $kontenHome->tipe_konten) == 'Visi' ? 'selected' : '' }}>
                                Visi Sekolah
                            </option>
                            <option value="Misi" {{ old('tipe_konten', $kontenHome->tipe_konten) == 'Misi' ? 'selected' : '' }}>
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
                               value="{{ old('judul_konten', $kontenHome->judul_konten) }}">
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
                                  required>{{ old('isi_konten', $kontenHome->isi_konten) }}</textarea>
                        @error('isi_konten')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto Kepala Sekolah -->
                    <div class="form-group" id="foto-group" style="display: {{ $kontenHome->tipe_konten === 'Sambutan' ? 'block' : 'none' }};">
                        <label for="foto_kepsek" class="font-weight-bold">Foto Kepala Sekolah</label>
                        
                        @if($kontenHome->foto_kepsek_url)
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <img src="{{ Storage::url($kontenHome->foto_kepsek_url) }}" 
                                     alt="Foto Kepala Sekolah" 
                                     class="img-thumbnail mr-3"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                <div>
                                    <p class="mb-2"><strong>Foto saat ini</strong></p>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#deleteFotoModal">
                                        <i class="fas fa-trash"></i> Hapus Foto
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('foto_kepsek') is-invalid @enderror" 
                                   id="foto_kepsek" 
                                   name="foto_kepsek"
                                   accept="image/*">
                            <label class="custom-file-label" for="foto_kepsek">
                                {{ $kontenHome->foto_kepsek_url ? 'Ganti foto...' : 'Pilih foto...' }}
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Format: JPG, PNG, GIF. Maksimal 2MB
                        </small>
                        @error('foto_kepsek')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        
                        <!-- Preview Image -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <p class="font-weight-bold">Preview:</p>
                            <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Konten
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
                    <i class="fas fa-history"></i> Informasi Update
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <strong>{{ $kontenHome->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $kontenHome->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                
                @if($kontenHome->user)
                <div class="mb-3">
                    <small class="text-muted">Diubah Oleh:</small><br>
                    <strong>{{ $kontenHome->user->name }}</strong>
                </div>
                @endif
                
                <hr>
                
                <div class="alert alert-warning mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong><br>
                        Perubahan akan langsung terlihat di halaman home setelah disimpan.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Foto -->
@if($kontenHome->foto_kepsek_url)
<div class="modal fade" id="deleteFotoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Foto</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus foto ini?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('konten-home.delete-photo', $kontenHome->home_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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
            fileLabel.textContent = '{{ $kontenHome->foto_kepsek_url ? "Ganti foto..." : "Pilih foto..." }}';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection