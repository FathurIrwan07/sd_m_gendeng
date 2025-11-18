{{-- resources/views/admin/tanggapan/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Tanggapan</h1>
    <div>
        <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary btn-icon-split mr-2">
            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
            <span class="text">Kembali</span>
        </a>
        <a href="{{ route('tanggapan.edit', $tanggapan->id_tanggapan) }}" class="btn btn-warning btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-edit"></i></span>
            <span class="text">Edit</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pengaduan</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Pelapor</th>
                        <td>
                            @if($tanggapan->pengaduan->pelapor)
                                <strong>{{ $tanggapan->pengaduan->pelapor->nama_lengkap }}</strong><br>
                            @else
                                <span class="text-muted">Anonim</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><span class="badge badge-secondary">{{ $tanggapan->pengaduan->kategori->nama_kategori }}</span></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pengaduan</th>
                        <td>{{ \Carbon\Carbon::parse($tanggapan->pengaduan->tanggal_pengaduan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($tanggapan->pengaduan->status_pengaduan == 'Diproses')
                                <span class="badge badge-info">Diproses</span>
                            @elseif($tanggapan->pengaduan->status_pengaduan == 'Selesai')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-secondary">{{ $tanggapan->pengaduan->status_pengaduan }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>
                            <div class="p-2 bg-light rounded">
                                <small>{{ $tanggapan->pengaduan->deskripsi }}</small>
                            </div>
                        </td>
                    </tr>
                </table>
                <a href="{{ route('pengaduan.show', $tanggapan->pengaduan->id_pengaduan) }}" 
                   class="btn btn-info btn-sm btn-block">
                    <i class="fas fa-eye"></i> Lihat Detail Pengaduan
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Informasi Tanggapan</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Tanggal Tanggapan</th>
                        <td>{{ \Carbon\Carbon::parse($tanggapan->tanggal_tanggapan)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Isi Tanggapan</th>
                        <td>
                            <div class="p-3 bg-light rounded">
                                {{ $tanggapan->isi_tanggapan }}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Timeline</h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item mb-3">
                        <i class="fas fa-circle text-primary"></i>
                        <div class="ml-3">
                            <small class="text-muted">Tanggapan Dibuat</small>
                            <p class="mb-0">{{ $tanggapan->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    @if($tanggapan->updated_at != $tanggapan->created_at)
                    <div class="timeline-item">
                        <i class="fas fa-circle text-info"></i>
                        <div class="ml-3">
                            <small class="text-muted">Terakhir Diupdate</small>
                            <p class="mb-0">{{ $tanggapan->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
}
.timeline:before {
    content: '';
    position: absolute;
    left: 5px;
    top: 10px;
    bottom: 10px;
    width: 2px;
    background: #e3e6f0;
}
.timeline-item {
    position: relative;
    padding-left: 25px;
}
.timeline-item i {
    position: absolute;
    left: 0;
    top: 3px;
    font-size: 10px;
}
</style>
@endpush