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
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Informasi Fasilitas</h6>
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
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-image"></i> Gambar Fasilitas</h6>
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
@endsection