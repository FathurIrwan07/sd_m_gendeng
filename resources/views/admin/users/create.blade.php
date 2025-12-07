{{-- resources/views/admin/users/create.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah User Baru</h1>
    <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-plus"></i> Form User Baru
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    
                    <!-- Info Role -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> User baru akan otomatis terdaftar sebagai <strong>User Biasa</strong> (untuk login pengaduan)
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" class="font-weight-bold">
                            Username <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               id="username" 
                               name="username"
                               placeholder="Masukkan username untuk login"
                               maxlength="50"
                               value="{{ old('username') }}"
                               required>
                        <small class="form-text text-muted">Username akan digunakan untuk login</small>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama_lengkap" class="font-weight-bold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nama_lengkap') is-invalid @enderror" 
                               id="nama_lengkap" 
                               name="nama_lengkap"
                               placeholder="Masukkan nama lengkap"
                               maxlength="100"
                               value="{{ old('nama_lengkap') }}"
                               required>
                        @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email (Opsional)</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email"
                               placeholder="contoh@email.com"
                               maxlength="100"
                               value="{{ old('email') }}">
                        <small class="form-text text-muted">Email dapat digunakan untuk reset password</small>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">
                            Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password"
                               placeholder="Minimal 8 karakter"
                               required>
                        <small class="form-text text-muted">Minimal 8 karakter</small>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="font-weight-bold">
                            Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               placeholder="Ulangi password"
                               required>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan User
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Informasi
                </h6>
            </div>
            <div class="card-body">
                <h6 class="text-primary">Tentang User:</h6>
                <ul class="small">
                    <li>User baru otomatis mendapat role <strong>User Biasa</strong></li>
                    <li>User dapat login untuk mengajukan pengaduan</li>
                    <li>Username harus unik dan digunakan untuk login</li>
                    <li>Email bersifat opsional</li>
                </ul>
                
                <hr>

                <h6 class="text-success">Tips Password:</h6>
                <ul class="small mb-0">
                    <li>Minimal 8 karakter</li>
                    <li>Kombinasi huruf & angka lebih aman</li>
                    <li>Hindari password yang mudah ditebak</li>
                </ul>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-warning">
            <div class="card-body">
                <div class="text-warning small">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Perhatian:</strong><br>
                    Pastikan memberitahu username dan password kepada user yang bersangkutan.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection