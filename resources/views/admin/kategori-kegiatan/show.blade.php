{{-- resources/views/admin/kategori-kegiatan/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kategori Kegiatan</h1>
    <div>
        <a href="{{ route('kategori-kegiatan.edit', $kategoriKegiatan->id_kategori) }}" class="btn btn-sm btn-warning shadow-sm mr-2">
            <i class="fas fa-edit fa-sm text-white-50"></i> Edit
        </a>
        <a href="{{ route('kategori-kegiatan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-tag"></i> {{ $kategoriKegiatan->nama_kategori }}
                </h6>
            </div>
            <div class="card-body">
                <h4 class="text-primary mb-4">{{ $kategoriKegiatan->nama_kategori }}</h4>
                
                <div class="mb-4">
                    <h6 class="font-weight-bold">Informasi Kategori:</h6>
                    <table class="table table-borderless">
                        <tr>
                            <td width="200"><i class="fas fa-calendar text-muted"></i> Dibuat Pada</td>
                            <td>: {{ $kategoriKegiatan->created_at->format('d F Y, H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-clock text-muted"></i> Terakhir Diubah</td>
                            <td>: {{ $kategoriKegiatan->updated_at->format('d F Y, H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-clipboard-list text-muted"></i> Jumlah Program</td>
                            <td>: <span class="badge badge-primary">{{ $kategoriKegiatan->kegiatan->count() }} Program</span></td>
                        </tr>
                    </table>
                </div>

                <hr>

                <h6 class="font-weight-bold mb-3">
                    <i class="fas fa-list"></i> Daftar Program dalam Kategori Ini:
                </h6>
                
                @if($kategoriKegiatan->kegiatan->count() > 0)
                <div class="list-group">
                    @foreach($kategoriKegiatan->kegiatan as $kegiatan)
                    <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{ $kegiatan->nama_program }}</h6>
                            <small class="text-muted">{{ $kegiatan->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1 text-muted">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                        @if($kegiatan->user)
                        <small class="text-muted">
                            <i class="fas fa-user"></i> {{ $kegiatan->user->name }}
                        </small>
                        @endif
                    </a>
                    @endforeach
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada program dalam kategori ini.
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('kategori-kegiatan.edit', $kategoriKegiatan->id_kategori) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Kategori
                        </a>
                        <button type="button" 
                                class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#deleteModal"
                                {{ $kategoriKegiatan->kegiatan->count() > 0 ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i> Hapus Kategori
                        </button>
                    </div>
                    <a href="{{ route('kegiatan.create') }}?kategori={{ $kategoriKegiatan->id_kategori }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Program Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Statistik -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-chart-pie"></i> Statistik
                </h6>
            </div>
            <div class="card-body text-center">
                <h2 class="text-primary">{{ $kategoriKegiatan->kegiatan->count() }}</h2>
                <p class="text-muted mb-0">Total Program Kegiatan</p>
            </div>
        </div>

        <!-- Status -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #4b0000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-info-circle"></i> Status Kategori
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Status:</small><br>
                    <span class="badge badge-success">Aktif</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Dapat Dihapus:</small><br>
                    @if($kategoriKegiatan->kegiatan->count() == 0)
                    <span class="badge badge-success">Ya</span>
                    @else
                    <span class="badge badge-danger">Tidak ({{ $kategoriKegiatan->kegiatan->count() }} program aktif)</span>
                    @endif
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
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($kategoriKegiatan->kegiatan->count() > 0)
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Tidak Dapat Dihapus!</strong>
                </div>
                <p>Kategori ini memiliki <strong>{{ $kategoriKegiatan->kegiatan->count() }} program</strong> dan tidak dapat dihapus.</p>
                <p class="mb-0">Silakan hapus atau pindahkan semua program terlebih dahulu.</p>
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <strong>Peringatan!</strong> 
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus kategori <strong>{{ $kategoriKegiatan->nama_kategori }}</strong>?</p>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    {{ $kategoriKegiatan->kegiatan->count() > 0 ? 'Tutup' : 'Batal' }}
                </button>
                @if($kategoriKegiatan->kegiatan->count() == 0)
                <form action="{{ route('kategori-kegiatan.destroy', $kategoriKegiatan->id_kategori) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Kategori
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection