{{-- resources/views/admin/info-ppdb/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Info PPDB (Penerimaan Peserta Didik Baru)</h1>
    <a href="{{ route('info-ppdb.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Info PPDB
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

<div class="row">
    @forelse($infoPpdb as $item)
    <div class="col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-school"></i> Info PPDB
                </h6>
            </div>
            <div class="card-body">
                @if($item->gambar_brosur)
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $item->gambar_brosur) }}" 
                         alt="Brosur PPDB" 
                         class="img-fluid rounded shadow"
                         style="max-height: 300px; object-fit: contain;">
                </div>
                @endif

                <h6 class="font-weight-bold mb-3">Syarat Pendaftaran:</h6>
                <div class="content-box bg-light p-3 rounded">
                    <p class="mb-0" style="white-space: pre-line;">{{ Str::limit($item->syarat_pendaftaran, 300) }}</p>
                </div>

                @if($item->user)
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-user-edit"></i> Diubah oleh: <strong>{{ $item->user->nama_lengkap  }}</strong>
                    </small>
                </div>
                @endif

                <div class="mt-2">
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                    </small>
                </div>
            </div>
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('info-ppdb.show', $item->id_info_ppdb) }}" 
                   class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> Lihat Detail
                </a>
                <a href="{{ route('info-ppdb.edit', $item->id_info_ppdb) }}" 
                   class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" 
                        class="btn btn-danger btn-sm" 
                        data-toggle="modal" 
                        data-target="#deleteModal{{ $item->id_info_ppdb }}">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $item->id_info_ppdb }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus info PPDB ini?
                    @if($item->gambar_brosur)
                    <p class="mb-0 mt-2"><small class="text-muted">* Brosur yang terlampir juga akan dihapus</small></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('info-ppdb.destroy', $item->id_info_ppdb) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="fas fa-school fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada info PPDB</h5>
                <p class="text-muted">Silakan tambahkan informasi PPDB untuk calon peserta didik baru</p>
                <a href="{{ route('info-ppdb.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Info PPDB
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($infoPpdb->count() > 0)
<div class="card shadow">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-info-circle"></i> Informasi
        </h6>
    </div>
    <div class="card-body">
        <p class="mb-0">
            <i class="fas fa-exclamation-triangle text-warning"></i> 
            <strong>Info PPDB</strong> akan ditampilkan di halaman website untuk memberikan informasi kepada calon peserta didik baru dan orang tua/wali.
        </p>
    </div>
</div>
@endif
@endsection