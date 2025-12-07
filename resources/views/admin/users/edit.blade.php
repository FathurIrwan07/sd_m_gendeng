{{-- resources/views/admin/users/edit.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Users</h1>
    <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-edit"></i> Form Edit Users
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Role Display (Read Only) -->
                    <div class="alert alert-secondary">
                        <strong>Role:</strong> 
                        <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }}">
                            {{ $user->role->nama_role }}
                        </span>
                        <small class="d-block mt-1">Role tidak dapat diubah</small>
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
                               value="{{ old('username', $user->username) }}"
                               required>
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
                               value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
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
                               value="{{ old('email', $user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <h6 class="font-weight-bold mb-3">Ganti Password (Opsional)</h6>
                    <p class="text-muted small">Kosongkan jika tidak ingin mengubah password</p>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password Baru</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password"
                               placeholder="Minimal 8 karakter">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="font-weight-bold">Konfirmasi Password Baru</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               placeholder="Ulangi password baru">
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update User
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
                    <i class="fas fa-history"></i> Informasi User
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Terdaftar:</small><br>
                    <strong>{{ $user->created_at->format('d M Y, H:i') }}</strong>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah:</small><br>
                    <strong>{{ $user->updated_at->format('d M Y, H:i') }}</strong>
                </div>

                <div class="mb-0">
                    <small class="text-muted">Role:</small><br>
                    <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }} badge-lg">
                        {{ $user->role->nama_role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Reset Password Button -->
        <div class="card shadow mb-4 border-left-warning">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="fas fa-key"></i> Reset Password
                </h6>
            </div>
            <div class="card-body">
                <p class="small mb-3">Reset password user ke password baru secara paksa</p>
                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#resetPasswordModal">
                    <i class="fas fa-redo"></i> Reset Password
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('users.reset-password', $user->id_user) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Password user akan direset ke password baru yang Anda tentukan
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" 
                               class="form-control" 
                               id="new_password" 
                               name="new_password"
                               placeholder="Minimal 8 karakter"
                               required>
                    </div>
                    
                    <div class="form-group mb-0">
                        <label for="new_password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               class="form-control" 
                               id="new_password_confirmation" 
                               name="new_password_confirmation"
                               placeholder="Ulangi password"
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection