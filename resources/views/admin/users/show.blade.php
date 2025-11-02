{{-- resources/views/admin/users/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
    <div>
        <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-sm btn-warning shadow-sm mr-2">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-user"></i> {{ $user->nama_lengkap }}
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-primary">Informasi Akun</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Username:</strong></td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap:</strong></td>
                                <td>{{ $user->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $user->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td>
                                    <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }} badge-lg">
                                        {{ $user->role->nama_role }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h6 class="font-weight-bold text-success">Informasi Waktu</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Terdaftar:</strong></td>
                                <td>{{ $user->created_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Update:</strong></td>
                                <td>{{ $user->updated_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <td><strong>Member Sejak:</strong></td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <h6 class="font-weight-bold text-warning mb-3">
                    <i class="fas fa-chart-line"></i> Aktivitas User
                </h6>

                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h4 class="text-primary">{{ $user->kontenHome->count() }}</h4>
                            <small class="text-muted">Konten Home</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h4 class="text-success">{{ $user->kegiatan->count() }}</h4>
                            <small class="text-muted">Program Kegiatan</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h4 class="text-warning">{{ $user->prestasi->count() }}</h4>
                            <small class="text-muted">Prestasi</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3">
                            <h4 class="text-info">{{ $user->infoPpdb->count() }}</h4>
                            <small class="text-muted">Info PPDB</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                        @if($user->id_user !== auth()->id())
                        <button type="button" 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus User
                        </button>
                        @endif
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Lihat Semua User
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-user-circle"></i> Profil Singkat
                </h6>
            </div>
            <div class="card-body text-center">
                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 100px; height: 100px; font-size: 2.5rem;">
                    <strong>{{ substr($user->nama_lengkap, 0, 1) }}</strong>
                </div>
                <h5 class="font-weight-bold">{{ $user->nama_lengkap }}</h5>
                <p class="text-muted mb-2">{{ '@' . $user->username }}</p>
                <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }} badge-lg px-3 py-2">
                    {{ $user->role->nama_role }}
                </span>
            </div>
        </div>

        <!-- Account Status -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-shield-alt"></i> Status Akun
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Status:</small><br>
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle"></i> Aktif
                    </span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Email Verified:</small><br>
                    @if($user->email_verified_at)
                    <span class="badge badge-success">
                        <i class="fas fa-check"></i> Terverifikasi
                    </span>
                    @else
                    <span class="badge badge-secondary">
                        <i class="fas fa-times"></i> Belum Verifikasi
                    </span>
                    @endif
                </div>
                <div class="mb-0">
                    <small class="text-muted">Akun Dibuat:</small><br>
                    <strong>{{ $user->created_at->diffForHumans() }}</strong>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow mb-4 border-left-warning">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="fas fa-bolt"></i> Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#resetPasswordModal">
                    <i class="fas fa-key"></i> Reset Password
                </button>
                <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-primary btn-block">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Peringatan!</strong> 
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus user <strong>{{ $user->username }}</strong>?</p>
                <p class="mb-0 text-muted small">Semua data terkait user ini akan terpengaruh.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus User
                    </button>
                </form>
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