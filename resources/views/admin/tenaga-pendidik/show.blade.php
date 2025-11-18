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
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-user"></i> Foto Tenaga Pendidik
                </h6>
            </div>
            <div class="card-body text-center">
                @if($tenagaPendidik->foto_tenaga_pendidik)
                    <img src="{{ asset('storage/' . $tenagaPendidik->foto_tenaga_pendidik) }}" 
                         alt="{{ $tenagaPendidik->nama_lengkap }}" 
                         class="img-fluid rounded-circle mb-3 shadow" 
                         style="width: 250px; height: 250px; object-fit: cover; border: 4px solid #800000;">
                @else
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" 
                         style="width: 250px; height: 250px; background: linear-gradient(135deg, #800000, #4b0000); border: 4px solid #800000;">
                        <i class="fas fa-user fa-5x text-white"></i>
                    </div>
                @endif
                <h5 class="font-weight-bold">{{ $tenagaPendidik->nama_lengkap }}</h5>
                <p class="text-muted mb-2">{{ $tenagaPendidik->jabatan }}</p>
                @if($tenagaPendidik->lulusan)
                <p class="text-primary">
                    <i class="fas fa-graduation-cap"></i> {{ $tenagaPendidik->lulusan }}
                </p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Informasi Detail
                </h6>
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
                        <th>Lulusan</th>
                        <td>: {{ $tenagaPendidik->lulusan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Foto</th>
                        <td>: 
                            @if($tenagaPendidik->foto_tenaga_pendidik)
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle"></i> Ada Foto
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    <i class="fas fa-times-circle"></i> Tanpa Foto
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Oleh</th>
                        <td>: {{ $tenagaPendidik->user ? $tenagaPendidik->user->nama_lengkap : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Dibuat</th>
                        <td>: {{ $tenagaPendidik->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>: {{ $tenagaPendidik->updated_at->format('d F Y, H:i') }} WIB
                            <small class="text-muted">({{ $tenagaPendidik->updated_at->diffForHumans() }})</small>
                        </td>
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

        <!-- Additional Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-graduation-cap"></i> Informasi Pendidikan
                </h6>
            </div>
            <div class="card-body">
                @if($tenagaPendidik->lulusan)
                    <div class="alert alert-info mb-0">
                        <h6 class="font-weight-bold mb-2">Pendidikan Terakhir:</h6>
                        <p class="mb-0"><i class="fas fa-check-circle"></i> {{ $tenagaPendidik->lulusan }}</p>
                    </div>
                @else
                    <div class="alert alert-secondary mb-0 text-center">
                        <i class="fas fa-info-circle"></i> Informasi pendidikan belum ditambahkan
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
            <div class="modal-header" style="background-color: #800000; color: white;">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus tenaga pendidik:</p>
                <div class="text-center my-3">
                    @if($tenagaPendidik->foto_tenaga_pendidik)
                        <img src="{{ asset('storage/' . $tenagaPendidik->foto_tenaga_pendidik) }}" 
                             class="rounded-circle mb-2" 
                             style="width: 80px; height: 80px; object-fit: cover;">
                    @endif
                    <h6 class="font-weight-bold">{{ $tenagaPendidik->nama_lengkap }}</h6>
                    <p class="text-muted">{{ $tenagaPendidik->jabatan }}</p>
                    @if($tenagaPendidik->lulusan)
                    <p class="text-primary"><small>{{ $tenagaPendidik->lulusan }}</small></p>
                    @endif
                </div>
                <p class="text-danger"><strong>Data yang dihapus tidak dapat dikembalikan!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form action="{{ route('tenaga-pendidik.destroy', $tenagaPendidik->id_tenaga_pendidik) }}" method="POST" style="display:inline;">
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
@endsection