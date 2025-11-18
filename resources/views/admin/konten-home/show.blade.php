{{-- resources/views/admin/konten-home/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Konten Home</h1>
    <div>
        <a href="{{ route('konten-home.edit', $kontenHome->home_id) }}" class="btn btn-sm btn-warning shadow-sm mr-2">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('konten-home.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-{{ $kontenHome->tipe_konten === 'Sambutan' ? 'bullhorn' : ($kontenHome->tipe_konten === 'Visi' ? 'eye' : 'tasks') }}"></i>
                    {{ $kontenHome->tipe_konten }}
                </h6>
            </div>
            <div class="card-body">
                @if($kontenHome->foto_kepsek_url && $kontenHome->tipe_konten === 'Sambutan')
                <div class="text-center mb-4">
                    <img src="{{ Storage::url($kontenHome->foto_kepsek_url) }}" 
                         alt="Foto Kepala Sekolah" 
                         class="img-thumbnail rounded-circle"
                         style="width: 200px; height: 200px; object-fit: cover; border: 5px solid #800000;">
                    <p class="mt-2 text-muted"><small>Foto Kepala Sekolah</small></p>
                </div>
                @endif

                @if($kontenHome->judul_konten)
                <h3 class="text-primary mb-4">{{ $kontenHome->judul_konten }}</h3>
                @endif

                <div class="content-display">
                    <p class="text-justify" style="font-size: 1.1rem; line-height: 1.8;">
                        {{ $kontenHome->isi_konten }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('konten-home.edit', $kontenHome->home_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Konten
                        </a>
                        <button type="button" 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Konten
                        </button>
                    </div>
                    <a href="{{ route('konten-home.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Lihat Semua Konten
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
                    <i class="fas fa-info-circle"></i> Informasi Konten
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Tipe Konten:</small><br>
                    <span class="badge badge-{{ $kontenHome->tipe_konten === 'Sambutan' ? 'primary' : ($kontenHome->tipe_konten === 'Visi' ? 'success' : 'warning') }} badge-lg">
                        {{ $kontenHome->tipe_konten }}
                    </span>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Dibuat Pada:</small><br>
                    <strong>{{ $kontenHome->created_at->format('d F Y') }}</strong><br>
                    <small>{{ $kontenHome->created_at->format('H:i') }} WIB</small>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Terakhir Diperbarui:</small><br>
                    <strong>{{ $kontenHome->updated_at->format('d F Y') }}</strong><br>
                    <small>{{ $kontenHome->updated_at->format('H:i') }} WIB</small><br>
                    <small class="text-info">({{ $kontenHome->updated_at->diffForHumans() }})</small>
                </div>

               @if($kontenHome->user)
                <div class="mb-3">
                    <small class="text-muted">Terakhir Diubah Oleh:</small><br>
                    <div class="d-flex align-items-center mt-2">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" 
                            style="width: 40px; height: 40px;">
                            <strong>{{ substr($kontenHome->user->nama_lengkap ?? 'U', 0, 1) }}</strong>
                        </div>
                        <div>
                            <strong>{{ $kontenHome->user->nama_lengkap }}</strong><br>
                            @if($kontenHome->user->role)
                                <small class="badge badge-info">{{ $kontenHome->user->role->nama_role }}</small>
                            @endif
                            <br>
                            <small class="text-muted">{{ $kontenHome->user->email }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

                <div class="mb-0">
                    <small class="text-muted">Jumlah Karakter:</small><br>
                    <strong>{{ strlen($kontenHome->isi_konten) }} karakter</strong>
                </div>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-eye"></i> Status Publikasi
                </h6>
            </div>
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h6>Konten Sudah Dipublikasikan</h6>
                <p class="small text-muted mb-0">
                    Konten ini akan tampil di halaman home website
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
                <p>Apakah Anda yakin ingin menghapus konten <strong>{{ $kontenHome->tipe_konten }}</strong>?</p>
                @if($kontenHome->foto_kepsek_url)
                <p class="mb-0"><small class="text-muted">* Foto yang terlampir juga akan dihapus</small></p>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('konten-home.destroy', $kontenHome->home_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Konten
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection