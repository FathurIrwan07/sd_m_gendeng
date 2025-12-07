{{-- resources/views/admin/kategori-pengaduan/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Kategori Pengaduan</h1>
    <div>
        <a href="{{ route('kategori-pengaduan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-tag"></i> {{ $kategoriPengaduan->nama_kategori }}
                </h6>
            </div>
            <div class="card-body">
                <h6 class="font-weight-bold mb-3">
                    <i class="fas fa-list"></i> Daftar Pengaduan dalam Kategori Ini:
                </h6>
                
                @if($kategoriPengaduan->pengaduan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Pelapor</th>
                                <th width="40%">Deskripsi</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoriPengaduan->pengaduan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($item->pelapor)
                                    {{ $item->pelapor->nama_lengkap }}
                                    @else
                                    <span class="badge badge-secondary">Anonim</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($item->deskripsi, 80) }}</td>
                                <td>{{ $item->tanggal_pengaduan->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-{{ 
                                        $item->status_pengaduan === 'Selesai' ? 'success' : 
                                        ($item->status_pengaduan === 'Diproses' ? 'warning' : 'secondary') 
                                    }}">
                                        {{ $item->status_pengaduan }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada pengaduan dalam kategori ini.
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-chart-pie"></i> Statistik
                </h6>
            </div>
            <div class="card-body text-center">
                <h2 class="text-primary">{{ $kategoriPengaduan->pengaduan->count() }}</h2>
                <p class="text-muted mb-0">Total Pengaduan</p>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Status Kategori
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Status:</small><br>
                    <span class="badge badge-success">Aktif</span>
                </div>
                <div class="mb-0">
                    <small class="text-muted">Dapat Dihapus:</small><br>
                    @if($kategoriPengaduan->pengaduan->count() == 0)
                    <span class="badge badge-success">Ya</span>
                    @else
                    <span class="badge badge-danger">Tidak</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection