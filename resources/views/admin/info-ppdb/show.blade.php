{{-- resources/views/admin/info-ppdb/show.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Info PPDB</h1>
    <div>
        <a href="{{ route('info-ppdb.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Info Dasar -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Informasi Dasar PPDB
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item mb-3">
                            <small class="text-muted d-block">Tahun Ajaran</small>
                            <h5 class="mb-0 text-primary">{{ $infoPpdb->tahun_ajaran }}</h5>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item mb-3">
                            <small class="text-muted d-block">Biaya Pendaftaran</small>
                            <h5 class="mb-0">{{ $infoPpdb->biaya_pendaftaran }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item mb-3">
                            <small class="text-muted d-block">Keterangan Biaya</small>
                            <p class="mb-0">{{ $infoPpdb->keterangan_biaya ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                @if($infoPpdb->gambar_brosur)
                <div class="mb-4">
                    <h6 class="font-weight-bold mb-3">
                        <i class="fas fa-image"></i> Brosur PPDB
                    </h6>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $infoPpdb->gambar_brosur) }}" 
                             alt="Brosur PPDB" 
                             class="img-fluid rounded shadow"
                             style="max-height: 500px; object-fit: contain; cursor: pointer;"
                             data-toggle="modal"
                             data-target="#brosurModal">
                        <p class="mt-2 text-muted"><small><i class="fas fa-info-circle"></i> Klik untuk memperbesar</small></p>
                    </div>
                </div>
                @endif

                <hr>

                <h6 class="font-weight-bold mb-3">
                    <i class="fas fa-clipboard-check"></i> Syarat Pendaftaran
                </h6>
                <div class="bg-light p-4 rounded">
                    <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $infoPpdb->syarat_pendaftaran }}</p>
                </div>
            </div>
        </div>

        <!-- Kontak & Lokasi -->
        @if($infoPpdb->telepon || $infoPpdb->email || $infoPpdb->alamat || $infoPpdb->lokasi_kantor || $infoPpdb->link_pendaftaran)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-phone"></i> Kontak & Lokasi
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($infoPpdb->telepon)
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-primary text-white mr-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Telepon</small>
                                <strong>{{ $infoPpdb->telepon }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($infoPpdb->email)
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success text-white mr-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <strong>{{ $infoPpdb->email }}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($infoPpdb->alamat)
                <div class="mb-3">
                    <div class="d-flex">
                        <div class="icon-circle bg-info text-white mr-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Alamat</small>
                            <p class="mb-0">{{ $infoPpdb->alamat }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if($infoPpdb->lokasi_kantor)
                <div class="mb-3">
                    <a href="{{ $infoPpdb->lokasi_kantor }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-map"></i> Lihat di Google Maps
                    </a>
                </div>
                @endif

                @if($infoPpdb->link_pendaftaran)
                <div>
                    <a href="{{ $infoPpdb->link_pendaftaran }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt"></i> Link Pendaftaran Online
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Gelombang & Tahapan -->
        @if($infoPpdb->gelombang->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-wave-square"></i> Gelombang & Tahapan Pendaftaran
                </h6>
            </div>
            <div class="card-body">
                @foreach($infoPpdb->gelombang as $gelombang)
                <div class="gelombang-item mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <span class="badge badge-primary">{{ $gelombang->nomor_gelombang }}</span>
                            {{ $gelombang->nama_gelombang }}
                        </h5>
                        @if($gelombang->status == 'berlangsung')
                            <span class="badge badge-success">Berlangsung</span>
                        @elseif($gelombang->status == 'selesai')
                            <span class="badge badge-secondary">Selesai</span>
                        @else
                            <span class="badge badge-info">Belum Mulai</span>
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Tanggal Mulai</small>
                            <p class="mb-0"><strong>{{ $gelombang->tanggal_mulai_formatted }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tanggal Selesai</small>
                            <p class="mb-0"><strong>{{ $gelombang->tanggal_selesai_formatted }}</strong></p>
                        </div>
                    </div>

                    @if($gelombang->keterangan)
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle"></i> {{ $gelombang->keterangan }}
                    </div>
                    @endif

                    @if($gelombang->tahapan->count() > 0)
                    <h6 class="font-weight-bold mb-3">Tahapan:</h6>
                    <div class="timeline">
                        @foreach($gelombang->tahapan as $index => $tahapan)
                        <div class="timeline-item">
                            <div class="timeline-marker 
                                @if($tahapan->status_tahapan == 'berlangsung') bg-success
                                @elseif($tahapan->status_tahapan == 'selesai') bg-secondary
                                @else bg-info
                                @endif">
                                @if($tahapan->icon)
                                    <i class="fas {{ $tahapan->icon }}"></i>
                                @else
                                    {{ $tahapan->urutan }}
                                @endif
                            </div>
                            <div class="timeline-content">
                                <h6 class="mb-1">{{ $tahapan->nama_tahapan }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> 
                                    {{ $tahapan->rentang_tanggal }}
                                </small>
                                @if($tahapan->deskripsi)
                                <p class="mb-0 mt-2">{{ $tahapan->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @if(!$loop->last)
                <hr>
                @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
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
                            <strong>{{ substr($infoPpdb->user->nama_lengkap ?? $infoPpdb->user->username, 0, 1) }}</strong>
                        </div>
                        <div>
                            <strong>{{ $infoPpdb->user->nama_lengkap ?? $infoPpdb->user->username }}</strong><br>
                            <small class="text-muted">{{ $infoPpdb->user->email }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <hr>

                <div class="mb-3">
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

                <div>
                    <small class="text-muted">Total Gelombang:</small><br>
                    <span class="badge badge-primary badge-lg">
                        {{ $infoPpdb->gelombang->count() }} Gelombang
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
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

<!-- Modal Brosur -->
@if($infoPpdb->gambar_brosur)
<div class="modal fade" id="brosurModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Brosur PPDB {{ $infoPpdb->tahun_ajaran }}</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $infoPpdb->gambar_brosur) }}" 
                     alt="Brosur PPDB" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endif

@push('styles')
<style>
.icon-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.timeline {
    position: relative;
    padding-left: 40px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 10px;
    bottom: 10px;
    width: 2px;
    background: #e0e0e0;
}

.timeline-item {
    position: relative;
    padding-bottom: 30px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -40px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #007bff;
}

.badge-lg {
    font-size: 0.95rem;
    padding: 0.5rem 0.75rem;
}

.gelombang-item {
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
    background: #f8f9fa;
}
</style>
@endpush
@endsection