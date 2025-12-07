{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.app')

@section('content')
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

<!-- Search and Add Card -->
<div class="card shadow-sm mb-3" style="border: none; border-radius: 8px;">
    <div class="card-body py-3">
        <div class="row align-items-center">
            <div class="col-md-6 mb-2 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white" style="border-right: none;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari username, nama, atau email..." style="border-left: none;">
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('users.create') }}" class="btn btn-sm shadow-sm" style="background-color: #800000; color: white;">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-users"></i> Daftar Users
        </h6>
    </div>
    <div class="card-body">
        @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="15%">Username</th>
                        <th width="20%">Nama Lengkap</th>
                        <th width="20%">Email</th>
                        <th width="10%" class="text-center">Role</th>
                        <th width="18%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                        <td>
                            <strong>{{ $user->username }}</strong>
                        </td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->email ?? '-' }}</td>
                        <td class="text-center">
                            <span class="badge badge-{{ $user->role->nama_role === 'Admin' ? 'danger' : 'primary' }}">
                                {{ $user->role->nama_role }}
                            </span>
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
                                    <h5 class="modal-title">
                                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                    </h5>
                                    <button class="close" type="button" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus user:</p>
                                    <div class="text-center my-3">
                                        <h6 class="font-weight-bold">{{ $user->username }}</h6>
                                        <p class="text-muted">{{ $user->nama_lengkap }}</p>
                                    </div>
                                    <div class="alert alert-warning mt-3 mb-0">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        <strong>Semua data terkait user ini juga akan terpengaruh!</strong>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="dataTables_info">
                    <small class="text-muted">
                        Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} 
                        dari {{ $users->total() }} data
                    </small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                    <ul class="pagination">
                        @if ($users->onFirstPage())
                            <li class="paginate_button page-item previous disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="paginate_button page-item previous">
                                <a href="{{ $users->previousPageUrl() }}" class="page-link">Previous</a>
                            </li>
                        @endif

                        @foreach(range(1, $users->lastPage()) as $i)
                            @if($i >= $users->currentPage() - 2 && $i <= $users->currentPage() + 2)
                                @if ($i == $users->currentPage())
                                    <li class="paginate_button page-item active">
                                        <span class="page-link">{{ $i }}</span>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a href="{{ $users->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach

                        @if ($users->hasMorePages())
                            <li class="paginate_button page-item next">
                                <a href="{{ $users->nextPageUrl() }}" class="page-link">Next</a>
                            </li>
                        @else
                            <li class="paginate_button page-item next disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
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

@push('styles')
<style>
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    .btn-sm {
        transition: all 0.2s ease;
    }
    
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    #searchInput {
        transition: all 0.2s ease;
    }
    
    #searchInput:focus {
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.15);
        border-color: #800000;
    }
    
    .pagination .page-link {
        color: #800000;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #800000;
        border-color: #800000;
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#dataTable tbody tr');
        
        tableRows.forEach(row => {
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush