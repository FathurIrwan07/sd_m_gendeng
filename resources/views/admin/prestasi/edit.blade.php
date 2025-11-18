{{-- resources/views/admin/prestasi/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Prestasi</h1>
    <a href="{{ route('prestasi.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit: {{ $prestasi->judul_prestasi }}
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('prestasi.update', $prestasi->id_prestasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Judul Prestasi -->
                    <div class="form-group">
                        <label for="judul_prestasi" class="font-weight-bold">
                            Judul Prestasi <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('judul_prestasi') is-invalid @enderror" 
                               id="judul_prestasi" 
                               name="judul_prestasi"
                               placeholder="Contoh: Juara 1 Olimpiade Matematika Tingkat Provinsi"
                               maxlength="255"
                               value="{{ old('judul_prestasi', $prestasi->judul_prestasi) }}"
                               required>
                        @error('judul_prestasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Peraih -->
                    <div class="form-group">
                        <label for="nama_peraih" class="font-weight-bold">
                            Nama Peraih <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_peraih') is-invalid @enderror" 
                               id="nama_peraih" 
                               name="nama_peraih"
                               placeholder="Contoh: Ahmad Fauzi (Kelas 6A)"
                               maxlength="150"
                               value="{{ old('nama_peraih', $prestasi->nama_peraih) }}"
                               required>
                        @error('nama_peraih')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tingkat Prestasi -->
                    <div class="form-group">
                        <label for="tingkat_prestasi" class="font-weight-bold">
                            Tingkat Prestasi <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('tingkat_prestasi') is-invalid @enderror" 
                                id="tingkat_prestasi" 
                                name="tingkat_prestasi"
                                required>
                            <option value="">-- Pilih Tingkat Prestasi --</option>
                            <option value="Internasional" {{ old('tingkat_prestasi', $prestasi->tingkat_prestasi) == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                            <option value="Nasional" {{ old('tingkat_prestasi', $prestasi->tingkat_prestasi) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="Provinsi" {{ old('tingkat_prestasi', $prestasi->tingkat_prestasi) == 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                            <option value="Kabupaten/Kota" {{ old('tingkat_prestasi', $prestasi->tingkat_prestasi) == 'Kabupaten/Kota' ? 'selected' : '' }}>Kabupaten/Kota</option>
                            <option value="Kecamatan" {{ old('tingkat_prestasi', $prestasi->tingkat_prestasi) == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        </select>
                        @error('tingkat_prestasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="form-group">
                        <label for="tanggal" class="font-weight-bold">Tanggal Prestasi</label>
                        <input type="date" 
                               class="form-control @error('tanggal') is-invalid @enderror" 
                               id="tanggal" 
                               name="tanggal"
                               value="{{ old('tanggal', $prestasi->tanggal ? $prestasi->tanggal->format('Y-m-d') : '') }}">
                        @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi" class="font-weight-bold">
                            Deskripsi Prestasi <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="6" 
                                  placeholder="Jelaskan detail prestasi yang diraih..."
                                  required>{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="form-group">
                        <label for="gambar" class="font-weight-bold">Gambar Prestasi</label>
                        
                        @if($prestasi->gambar)
                        <div class="mb-3">
                            <div class="d-flex align-items-start">
                                <img src="{{ asset('storage/' . $prestasi->gambar) }}" 
                                     alt="Gambar Prestasi" 
                                     class="img-thumbnail mr-3"
                                     style="width: 200px; height: 150px; object-fit: cover;">
                                <div>
                                    <p class="mb-2"><strong>Gambar saat ini</strong></p>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#deleteGambarModal">
                                        <i class="fas fa-trash"></i> Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('gambar') is-invalid @enderror" 
                                   id="gambar" 
                                   name="gambar"
                                   accept="image/*">
                            <label class="custom-file-label" for="gambar">
                                {{ $prestasi->gambar ? 'Ganti gambar...' : 'Pilih gambar...' }}
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Format: JPG, PNG, GIF. Maksimal 2MB
                        </small>
                        @error('gambar')
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
                            <i class="fas fa-save"></i> Update Prestasi
                        </button>
                        <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
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
                    <strong>{{ $prestasi->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $prestasi->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                
                @if($prestasi->user)
                <div class="mb-3">
                    <small class="text-muted">Diubah Oleh:</small><br>
                    <strong>{{ $prestasi->user->nama_lengkap }}</strong>
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

<!-- Modal Delete Gambar -->
@if($prestasi->gambar)
<div class="modal fade" id="deleteGambarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Gambar</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus gambar ini?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('prestasi.delete-photo', $prestasi->id_prestasi) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Gambar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const gambarInput = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const fileLabel = document.querySelector('.custom-file-label');
    
    gambarInput.addEventListener('change', function() {
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
            fileLabel.textContent = '{{ $prestasi->gambar ? "Ganti gambar..." : "Pilih gambar..." }}';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection