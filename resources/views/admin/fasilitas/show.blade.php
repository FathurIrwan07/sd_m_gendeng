@extends('admin.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Fasilitas</h1>
    <a href="{{ route('fasilitas.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Fasilitas</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Nama Fasilitas</th>
                        <td>: {{ $fasilita->nama_fasilitas }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>: {{ $fasilita->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td>: {{ $fasilita->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>: {{ $fasilita->updated_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>

                <hr>

                <div class="btn-group">
                    <a href="{{ route('fasilitas.edit', $fasilita->id_fasilitas) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Gambar Fasilitas</h6>
            </div>
            <div class="card-body text-center">
                @if($fasilita->gambar)
                    <img src="{{ asset('storage/' . $fasilita->gambar) }}" 
                         alt="{{ $fasilita->nama_fasilitas }}" 
                         class="img-fluid rounded">
                @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada gambar
                    </div>
                @endif
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
                Apakah Anda yakin ingin menghapus fasilitas <strong>{{ $fasilita->nama_fasilitas }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('fasilitas.destroy', $fasilita->id_fasilitas) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection