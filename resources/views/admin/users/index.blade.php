{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Users</h1>
    <a href="{{ route('users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah User
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-users"></i> Daftar Users
        </h6>
    </div>
    <div class="card-body">
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Username</th>
                        <th width="20%">Nama Lengkap</th>
                        <th width="20%">Email</th>
                        <th width="10%" class="text-center">Role</th>
                        <th width="15%" class="text-center">Terdaftar</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td><strong>{{ $user->username }}</strong></td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }}">
                                {{ $user->role->nama_role }}
                            </span>
                        </td>
                        <td class="text-center">
                            <small>{{ $user->created_at->format('d M Y') }}</small>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.show', $user->id_user) }}" 
                               class="btn btn-info btn-sm" 
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id_user) }}" 
                               class="btn btn-warning btn-sm"
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id_user !== auth()->id())
                            <button type="button" 
                                    class="btn btn-danger btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#deleteModal{{ $user->id_user }}"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $user->id_user }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus user <strong>{{ $user->username }}</strong>?
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        Semua data terkait user ini juga akan terpengaruh!
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-users fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada user</h5>
            <p class="text-muted">Silakan tambahkan user baru</p>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Summary Cards -->
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Admin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $users->where('role.nama_role', 'Admin')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total User Biasa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $users->where('role.nama_role', 'User')->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection