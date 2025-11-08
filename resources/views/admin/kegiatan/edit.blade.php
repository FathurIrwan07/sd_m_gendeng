{{-- resources/views/admin/kegiatan/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Program Kegiatan</h1>
    <a href="{{ route('kegiatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit Program: {{ $kegiatan->nama_program }}
                </h6>
            </div>
            <div class="card-body">
                {{-- FORM UPDATE KEGIATAN - BUKAN DELETE FOTO --}}
                <form action="{{ route('kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
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
                                    {{ old('id_kategori', $kegiatan->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                               value="{{ old('nama_program', $kegiatan->nama_program) }}"
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
                                  required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto Program -->
                    <div class="form-group">
                        <label for="foto_program" class="font-weight-bold">Foto Program</label>
                        
                        @if($kegiatan->foto_program)
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <img src="{{ asset('storage/' . $kegiatan->foto_program) }}" 
                                     alt="Foto Program" 
                                     class="img-thumbnail mr-3"
                                     style="width: 200px; height: 150px; object-fit: cover;">
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
                                   class="custom-file-input @error('foto_program') is-invalid @enderror" 
                                   id="foto_program" 
                                   name="foto_program"
                                   accept="image/*">
                            <label class="custom-file-label" for="foto_program">
                                {{ $kegiatan->foto_program ? 'Ganti foto...' : 'Pilih foto...' }}
                            </label>
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
                            <i class="fas fa-save"></i> Update Program
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
                    <i class="fas fa-history"></i> Informasi Update
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Kategori Saat Ini:</small><br>
                    <span class="badge badge-primary">{{ $kegiatan->kategori->nama_kategori }}</span>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <strong>{{ $kegiatan->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $kegiatan->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                
                @if($kegiatan->user)
                <div class="mb-3">
                    <small class="text-muted">Diubah Oleh:</small><br>
                    <strong>{{ $kegiatan->user->nama_lengkap  }}</strong>
                </div>
                @endif
                
                <hr>
                
                <div class="alert alert-warning mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong><br>
                        Perubahan akan langsung terlihat di website.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Foto -->
@if($kegiatan->foto_program)
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
                <form action="{{ route('kegiatan.delete-photo', $kegiatan->id_kegiatan) }}" method="POST">
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
            fileLabel.textContent = '{{ $kegiatan->foto_program ? "Ganti foto..." : "Pilih foto..." }}';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection