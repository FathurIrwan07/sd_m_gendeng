{{-- resources/views/admin/info-ppdb/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Info PPDB</h1>
    <a href="{{ route('info-ppdb.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-edit"></i> Edit Info PPDB
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('info-ppdb.update', $infoPpdb->id_info_ppdb) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Syarat Pendaftaran -->
                    <div class="form-group">
                        <label for="syarat_pendaftaran" class="font-weight-bold">
                            Syarat Pendaftaran <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('syarat_pendaftaran') is-invalid @enderror" 
                                  id="syarat_pendaftaran" 
                                  name="syarat_pendaftaran" 
                                  rows="12" 
                                  placeholder="Tuliskan syarat-syarat pendaftaran PPDB..."
                                  required>{{ old('syarat_pendaftaran', $infoPpdb->syarat_pendaftaran) }}</textarea>
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
                        
                        @if($infoPpdb->gambar_brosur)
                        <div class="mb-3">
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $infoPpdb->gambar_brosur) }}" 
                                     alt="Brosur PPDB" 
                                     class="img-thumbnail mb-2"
                                     style="max-width: 400px; max-height: 300px; object-fit: contain;">
                                <div>
                                    <p class="mb-2"><strong>Brosur saat ini</strong></p>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            data-toggle="modal" 
                                            data-target="#deleteBrosurModal">
                                        <i class="fas fa-trash"></i> Hapus Brosur
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('gambar_brosur') is-invalid @enderror" 
                                   id="gambar_brosur" 
                                   name="gambar_brosur"
                                   accept="image/*">
                            <label class="custom-file-label" for="gambar_brosur">
                                {{ $infoPpdb->gambar_brosur ? 'Ganti brosur...' : 'Pilih brosur...' }}
                            </label>
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
                            <i class="fas fa-save"></i> Update Info PPDB
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
                    <i class="fas fa-history"></i> Informasi Update
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat:</small><br>
                    <strong>{{ $infoPpdb->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $infoPpdb->updated_at->format('d M Y, H:i') }}</strong>
                </div>
                
                @if($infoPpdb->user)
                <div class="mb-3">
                    <small class="text-muted">Diubah Oleh:</small><br>
                    <strong>{{ $infoPpdb->user->nama_lengkap  }}</strong>
                </div>
                @endif
                
                <hr>
                
                <div class="alert alert-warning mb-0">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i> <strong>Perhatian:</strong><br>
                        Perubahan akan langsung terlihat di halaman PPDB website.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Brosur -->
@if($infoPpdb->gambar_brosur)
<div class="modal fade" id="deleteBrosurModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus Brosur</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus brosur ini?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('info-ppdb.delete-brosur', $infoPpdb->id_info_ppdb) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Brosur</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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
            fileLabel.textContent = '{{ $infoPpdb->gambar_brosur ? "Ganti brosur..." : "Pilih brosur..." }}';
            previewContainer.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection