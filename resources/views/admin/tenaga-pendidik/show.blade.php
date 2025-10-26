@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Tenaga Pendidik</h1>
    <a href="{{ route('tenaga-pendidik.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Foto Tenaga Pendidik</h6>
            </div>
            <div class="card-body text-center">
                @if($tenagaPendidik->foto_tenaga_pendidik)
                    <img src="{{ asset('storage/' . $tenagaPendidik->foto_tenaga_pendidik) }}" 
                         alt="{{ $tenagaPendidik->nama_lengkap }}" 
                         class="img-fluid rounded-circle mb-3" 
                         style="width: 250px; height: 250px; object-fit: cover;">
                @else
                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 250px; height: 250px;">
                        <i class="fas fa-user fa-5x text-white"></i>
                    </div>
                @endif
                <h5 class="font-weight-bold">{{ $tenagaPendidik->nama_lengkap }}</h5>
                <p class="text-muted">{{ $tenagaPendidik->jabatan }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Detail</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Lengkap</th>
                        <td>: {{ $tenagaPendidik->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>: {{ $tenagaPendidik->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td>: {{ $tenagaPendidik->user ? $tenagaPendidik->user->nama_lengkap : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td>: {{ $tenagaPendidik->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>: {{ $tenagaPendidik->updated_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>

                <hr>

                <div class="btn-group">
                    <a href="{{ route('tenaga-pendidik.edit', $tenagaPendidik->id_tenaga_pendidik) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
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
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus tenaga pendidik <strong>{{ $tenagaPendidik->nama_lengkap }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('tenaga-pendidik.destroy', $tenagaPendidik->id_tenaga_pendidik) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection