{{-- resources/views/admin/prestasi/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Prestasi</h1>
    <div>
        <a href="{{ route('prestasi.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-trophy"></i> {{ $prestasi->judul_prestasi }}
                </h6>
            </div>
            <div class="card-body">
                @if($prestasi->gambar)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $prestasi->gambar) }}" 
                         alt="{{ $prestasi->judul_prestasi }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 400px; object-fit: cover; width: 100%;">
                </div>
                @endif

                <h3 class="text-primary mb-3">{{ $prestasi->judul_prestasi }}</h3>
                
                <div class="mb-3">
                    <span class="badge {{ $prestasi->tingkat_badge_color }} badge-lg px-3 py-2">
                        <i class="fas fa-medal"></i> {{ $prestasi->tingkat_prestasi }}
                    </span>
                    @if($prestasi->tanggal)
                    <span class="badge badge-info badge-lg px-3 py-2">
                        <i class="fas fa-calendar"></i> {{ $prestasi->tanggal->format('d F Y') }}
                    </span>
                    @endif
                </div>

                <div class="alert alert-light border-left-primary mb-4">
                    <h6 class="font-weight-bold text-primary mb-2">
                        <i class="fas fa-user-graduate"></i> Peraih Prestasi
                    </h6>
                    <h5 class="mb-0">{{ $prestasi->nama_peraih }}</h5>
                </div>

                <hr>

                <h5 class="font-weight-bold mb-3">Deskripsi Prestasi:</h5>
                <div class="content-display">
                    <p class="text-justify" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">{{ $prestasi->deskripsi }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('prestasi.edit', $prestasi->id_prestasi) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Prestasi
                        </a>
                        <button type="button" 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Prestasi
                        </button>
                    </div>
                    <a href="{{ route('prestasi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Lihat Semua Prestasi
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
                    <i class="fas fa-info-circle"></i> Informasi Prestasi
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Nama Peraih:</small><br>
                    <strong>{{ $prestasi->nama_peraih }}</strong>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Tingkat Prestasi:</small><br>
                    <span class="badge {{ $prestasi->tingkat_badge_color }}">
                        {{ $prestasi->tingkat_prestasi }}
                    </span>
                </div>

                @if($prestasi->tanggal)
                <div class="mb-3">
                    <small class="text-muted">Tanggal Prestasi:</small><br>
                    <strong>{{ $prestasi->tanggal->format('d F Y') }}</strong>
                </div>
                @endif

                <div class="mb-3">
                    <small class="text-muted">Dibuat Pada:</small><br>
                    <strong>{{ $prestasi->created_at->format('d F Y') }}</strong><br>
                    <small>{{ $prestasi->created_at->format('H:i') }} WIB</small>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Terakhir Diperbarui:</small><br>
                    <strong>{{ $prestasi->updated_at->format('d F Y') }}</strong><br>
                    <small>{{ $prestasi->updated_at->format('H:i') }} WIB</small><br>
                    <small class="text-info">({{ $prestasi->updated_at->diffForHumans() }})</small>
                </div>

                @if($prestasi->user)
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah Oleh:</small><br>
                    <div class="d-flex align-items-center mt-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" 
                             style="width: 40px; height: 40px;">
                            <strong>{{ substr($prestasi->user->nama_lengkap, 0, 1) }}</strong>
                        </div>
                        <div>
                            <strong>{{ $prestasi->user->name }}</strong><br>
                            <small class="text-muted">{{ $prestasi->user->email }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

                <div class="mb-0">
                    <small class="text-muted">Status Gambar:</small><br>
                    @if($prestasi->gambar)
                    <span class="badge badge-success">
                        <i class="fas fa-check-circle"></i> Ada Gambar
                    </span>
                    @else
                    <span class="badge badge-secondary">
                        <i class="fas fa-times-circle"></i> Tanpa Gambar
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
                <h6>Prestasi Sudah Dipublikasikan</h6>
                <p class="small text-muted mb-0">
                    Prestasi ini akan tampil di halaman website
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
                <p>Apakah Anda yakin ingin menghapus prestasi <strong>{{ $prestasi->judul_prestasi }}</strong>?</p>
                @if($prestasi->gambar)
                <p class="mb-0"><small class="text-muted">* Gambar yang terlampir juga akan dihapus</small></p>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('prestasi.destroy', $prestasi->id_prestasi) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Prestasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection