{{-- resources/views/admin/info-ppdb/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Info PPDB</h1>
    <div>
        <a href="{{ route('info-ppdb.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-school"></i> Informasi PPDB
                </h6>
            </div>
            <div class="card-body">
                @if($infoPpdb->gambar_brosur)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $infoPpdb->gambar_brosur) }}" 
                         alt="Brosur PPDB" 
                         class="img-fluid rounded shadow"
                         style="max-height: 500px; object-fit: contain;">
                    <p class="mt-2 text-muted"><small>Brosur PPDB</small></p>
                </div>
                @endif

                <h4 class="text-primary mb-4">
                    <i class="fas fa-clipboard-check"></i> Syarat Pendaftaran PPDB
                </h4>

                <div class="content-display bg-light p-4 rounded">
                    <p class="text-justify mb-0" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">{{ $infoPpdb->syarat_pendaftaran }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('info-ppdb.edit', $infoPpdb->id_info_ppdb) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Info PPDB
                        </a>
                        <button type="button" 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Info PPDB
                        </button>
                    </div>
                    <a href="{{ route('info-ppdb.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Lihat Semua Info
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Informasi
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Dibuat Pada:</small><br>
                    <strong>{{ $infoPpdb->created_at->format('d F Y') }}</strong><br>
                    <small>{{ $infoPpdb->created_at->format('H:i') }} WIB</small>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Terakhir Diperbarui:</small><br>
                    <strong>{{ $infoPpdb->updated_at->format('d F Y') }}</strong><br>
                    <small>{{ $infoPpdb->updated_at->format('H:i') }} WIB</small><br>
                    <small class="text-info">({{ $infoPpdb->updated_at->diffForHumans() }})</small>
                </div>

                @if($infoPpdb->user)
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah Oleh:</small><br>
                    <div class="d-flex align-items-center mt-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" 
                             style="width: 40px; height: 40px;">
                            <strong>{{ substr($infoPpdb->user->username, 0, 1) }}</strong>
                        </div>
                        <div>
                            <strong>{{ $infoPpdb->user->name }}</strong><br>
                            <small class="text-muted">{{ $infoPpdb->user->email }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

                <div class="mb-0">
                    <small class="text-muted">Status Brosur:</small><br>
                    @if($infoPpdb->gambar_brosur)
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle"></i> Ada Brosur
                    </span>
                    @else
                    <span class="badge badge-secondary">
                        <i class="fas fa-times-circle"></i> Tanpa Brosur
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-eye"></i> Status Publikasi
                </h6>
            </div>
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h6>Info PPDB Sudah Dipublikasikan</h6>
                <p class="small text-muted mb-0">
                    Informasi ini akan tampil di halaman PPDB website
                </p>
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
                <p>Apakah Anda yakin ingin menghapus info PPDB ini?</p>
                @if($infoPpdb->gambar_brosur)
                <p class="mb-0"><small class="text-muted">* Brosur yang terlampir juga akan dihapus</small></p>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('info-ppdb.destroy', $infoPpdb->id_info_ppdb) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Info PPDB
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection