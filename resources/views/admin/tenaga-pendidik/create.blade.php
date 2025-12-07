@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-plus-circle"></i> Form Tambah Tenaga Pendidik
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('tenaga-pendidik.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                       id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                       placeholder="Contoh: Dr. Ahmad Fauzi, S.Pd., M.Pd" required>
                @error('nama_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                       id="jabatan" name="jabatan" value="{{ old('jabatan') }}" 
                       placeholder="Contoh: Kepala Sekolah" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="lulusan">Lulusan / Pendidikan</label>
                <input type="text" class="form-control @error('lulusan') is-invalid @enderror" 
                       id="lulusan" name="lulusan" value="{{ old('lulusan') }}" 
                       placeholder="Contoh: S1 Pendidikan Bahasa Indonesia">
                <small class="form-text text-muted">Opsional: Isi jika ingin menampilkan informasi pendidikan terakhir</small>
                @error('lulusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto_tenaga_pendidik">Foto Tenaga Pendidik</label>
                <input type="file" class="form-control-file @error('foto_tenaga_pendidik') is-invalid @enderror" 
                       id="foto_tenaga_pendidik" name="foto_tenaga_pendidik" accept="image/*" onchange="previewImage(event)">
                <small class="form-text text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Disarankan foto formal dengan latar belakang polos.</small>
                @error('foto_tenaga_pendidik')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                
                <!-- Image Preview -->
                <div class="mt-3 text-center" id="imagePreview" style="display: none;">
                    <p class="font-weight-bold">Preview:</p>
                    <img id="preview" src="" alt="Preview" class="img-thumbnail rounded-circle" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('tenaga-pendidik.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Info Card -->
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-info-circle"></i> Panduan Pengisian
        </h6>
    </div>
    <div class="card-body">
        <ul class="mb-0">
            <li><strong>Nama Lengkap:</strong> Tulis nama lengkap beserta gelar akademik (jika ada)</li>
            <li><strong>Jabatan:</strong> Sebutkan jabatan/posisi saat ini (Kepala Sekolah, Guru Kelas, dll)</li>
            <li><strong>Lulusan:</strong> Tuliskan pendidikan terakhir, contoh: "S1 Pendidikan Matematika", "S2 Manajemen Pendidikan"</li>
            <li><strong>Foto:</strong> Gunakan foto formal dengan pakaian rapi dan latar belakang polos</li>
        </ul>
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