{{-- resources/views/admin/users/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
    <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
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
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
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
            <div class="card-header py-3" >
                <h6 class="m-0 font-weight-bold text-primary">
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
    </div>
</div>
@endsection