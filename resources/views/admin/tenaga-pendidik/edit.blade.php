@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-edit"></i> Form Edit Tenaga Pendidik
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('tenaga-pendidik.update', $tenagaPendidik->id_tenaga_pendidik) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                       id="nama_lengkap" name="nama_lengkap" 
                       value="{{ old('nama_lengkap', $tenagaPendidik->nama_lengkap) }}" required>
                @error('nama_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                       id="jabatan" name="jabatan" 
                       value="{{ old('jabatan', $tenagaPendidik->jabatan) }}" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lulusan">Lulusan / Pendidikan</label>
                <input type="text" class="form-control @error('lulusan') is-invalid @enderror" 
                       id="lulusan" name="lulusan" 
                       value="{{ old('lulusan', $tenagaPendidik->lulusan) }}" 
                       placeholder="Contoh: S1 Pendidikan Bahasa Indonesia">
                <small class="form-text text-muted">Opsional: Isi jika ingin menampilkan informasi pendidikan terakhir</small>
                @error('lulusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto_tenaga_pendidik">Foto Tenaga Pendidik</label>
                
                @if($tenagaPendidik->foto_tenaga_pendidik)
                    <div class="mb-3 text-center">
                        <p class="mb-2"><strong>Foto Saat Ini:</strong></p>
                        <img src="{{ asset('storage/' . $tenagaPendidik->foto_tenaga_pendidik) }}" 
                             alt="{{ $tenagaPendidik->nama_lengkap }}" 
                             class="img-thumbnail rounded-circle" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                @endif
                
                <input type="file" class="form-control-file @error('foto_tenaga_pendidik') is-invalid @enderror" 
                       id="foto_tenaga_pendidik" name="foto_tenaga_pendidik" accept="image/*" onchange="previewImage(event)">
                <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengganti foto.</small>
                @error('foto_tenaga_pendidik')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                <!-- Image Preview -->
                <div class="mt-3 text-center" id="imagePreview" style="display: none;">
                    <p class="mb-2"><strong>Preview Foto Baru:</strong></p>
                    <img id="preview" src="" alt="Preview" class="img-thumbnail rounded-circle" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('tenaga-pendidik.index') }}" class="btn btn-secondary">
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