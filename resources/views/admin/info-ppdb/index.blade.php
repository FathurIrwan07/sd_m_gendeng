{{-- resources/views/admin/info-ppdb/index.blade.php --}}
@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-school"></i> Info PPDB (Penerimaan Peserta Didik Baru)
    </h1>
    <a href="{{ route('info-ppdb.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Info PPDB
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle"></i> <strong>Error!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    @forelse($infoPpdb as $item)
    <div class="col-lg-12 mb-4">
        <div class="card shadow-lg h-100 border-0">
            <!-- Header Card -->
            <div class="card-header py-3" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-graduation-cap"></i> PPDB {{ $item->tahun_ajaran }}
                        </h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left Side - Brosur -->
                    <div class="col-lg-4">
                        @if($item->gambar_brosur)
                        <div class="brosur-container text-center mb-3">
                            <img src="{{ asset('storage/' . $item->gambar_brosur) }}" 
                                 alt="Brosur PPDB" 
                                 class="img-fluid rounded shadow hover-zoom"
                                 style="max-height: 350px; object-fit: cover; width: 100%; cursor: pointer;"
                                 data-toggle="modal"
                                 data-target="#brosurModal{{ $item->id_info_ppdb }}">
                            <p class="mt-2 text-muted mb-0"><small><i class="fas fa-search-plus"></i> Klik untuk memperbesar</small></p>
                        </div>
                        @else
                        <div class="text-center p-5 bg-light rounded">
                            <i class="fas fa-image fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada brosur</p>
                        </div>
                        @endif

                        <!-- Quick Info -->
                        <div class="quick-info mt-3">
                            <div class="info-box bg-primary text-white p-3 rounded mb-2">
                                <i class="fas fa-money-bill-wave"></i>
                                <div class="ml-2">
                                    <small>Biaya Pendaftaran</small>
                                    <h6 class="mb-0 text-white font-weight-bold">{{ $item->biaya_pendaftaran }}</h6>
                                </div>
                            </div>

                            @if($item->gelombang->count() > 0)
                            <div class="info-box bg-success text-white p-3 rounded mb-2">
                                <i class="fas fa-wave-square"></i>
                                <div class="ml-2">
                                    <small>Total Gelombang</small>
                                    <h6 class="mb-0 text-white font-weight-bold">{{ $item->gelombang->count() }} Gelombang</h6>
                                </div>
                            </div>
                            @endif

                            @if($item->telepon)
                            <div class="info-box bg-info text-white p-3 rounded">
                                <i class="fas fa-phone"></i>
                                <div class="ml-2">
                                    <small>Kontak</small>
                                    <h6 class="mb-0 text-white font-weight-bold">{{ $item->telepon }}</h6>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Side - Content -->
                    <div class="col-lg-8">
                        <!-- Syarat Pendaftaran -->
                        <div class="mb-4">
                            <h6 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-clipboard-check"></i> Syarat Pendaftaran
                            </h6>
                            <div class="content-box bg-light p-3 rounded" style="max-height: 200px; overflow-y: auto;">
                                <p class="mb-0" style="white-space: pre-line; line-height: 1.6;">{{ Str::limit($item->syarat_pendaftaran, 400) }}</p>
                            </div>
                        </div>

                        <!-- Gelombang Preview -->
                        @if($item->gelombang->count() > 0)
                        <div class="mb-3">
                            <h6 class="font-weight-bold text-primary mb-3">
                                <i class="fas fa-wave-square"></i> Gelombang Pendaftaran
                            </h6>
                            <div class="row">
                                @foreach($item->gelombang->take(3) as $gelombang)
                                <div class="col-md-4 mb-2">
                                    <div class="card border-left-primary shadow-sm h-100">
                                        <div class="card-body py-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                {{ $gelombang->nama_gelombang }}
                                            </div>
                                            <div class="text-sm mb-0">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i> 
                                                    {{ $gelombang->tanggal_mulai->format('d/m') }} - {{ $gelombang->tanggal_selesai->format('d/m/Y') }}
                                                </small>
                                            </div>
                                            @if($gelombang->status == 'berlangsung')
                                                <span class="badge badge-success badge-sm mt-1">Berlangsung</span>
                                            @elseif($gelombang->status == 'selesai')
                                                <span class="badge badge-secondary badge-sm mt-1">Selesai</span>
                                            @else
                                                <span class="badge badge-info badge-sm mt-1">Belum Mulai</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @if($item->gelombang->count() > 3)
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> +{{ $item->gelombang->count() - 3 }} gelombang lainnya
                            </small>
                            @endif
                        </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="row mt-3">
                            @if($item->email)
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block"><i class="fas fa-envelope"></i> Email</small>
                                <span class="text-dark">{{ $item->email }}</span>
                            </div>
                            @endif

                            @if($item->alamat)
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block"><i class="fas fa-map-marker-alt"></i> Alamat</small>
                                <span class="text-dark">{{ Str::limit($item->alamat, 50) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('info-ppdb.show', $item->id_info_ppdb) }}" 
                       class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Detail
                    </a>
                    <a href="{{ route('info-ppdb.edit', $item->id_info_ppdb) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" 
                            class="btn btn-danger btn-sm" 
                            data-toggle="modal" 
                            data-target="#deleteModal{{ $item->id_info_ppdb }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                
                @if($item->link_pendaftaran)
                <div>
                    <a href="{{ $item->link_pendaftaran }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fas fa-external-link-alt"></i> Link Pendaftaran
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal{{ $item->id_info_ppdb }}" tabindex="-1" role="dialog">
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
                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <p>Apakah Anda yakin ingin menghapus info PPDB <strong>{{ $item->tahun_ajaran }}</strong>?</p>
                    @if($item->gambar_brosur)
                    <p class="mb-0"><small class="text-muted">* Brosur yang terlampir juga akan dihapus</small></p>
                    @endif
                    @if($item->gelombang->count() > 0)
                    <p class="mb-0"><small class="text-muted">* {{ $item->gelombang->count() }} gelombang dan tahapannya akan dihapus</small></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('info-ppdb.destroy', $item->id_info_ppdb) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Brosur -->
    @if($item->gambar_brosur)
    <div class="modal fade" id="brosurModal{{ $item->id_info_ppdb }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Brosur PPDB {{ $item->tahun_ajaran }}</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="{{ asset('storage/' . $item->gambar_brosur) }}" 
                         alt="Brosur PPDB" 
                         class="img-fluid"
                         style="max-height: 80vh;">
                </div>
            </div>
        </div>
    </div>
    @endif

    @empty
    <div class="col-12">
        <div class="card shadow border-0">
            <div class="card-body text-center py-5">
                <i class="fas fa-school fa-5x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">Belum Ada Info PPDB</h4>
                <p class="text-muted mb-4">Silakan tambahkan informasi PPDB untuk calon peserta didik baru</p>
                <a href="{{ route('info-ppdb.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Tambah Info PPDB
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($infoPpdb->count() > 0)
<div class="card shadow border-0">
    <div class="card-header py-3" style="background-color: #800000;">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-info-circle"></i> Informasi
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <p class="mb-0">
                    <i class="fas fa-exclamation-triangle text-warning"></i> 
                    <strong>Info PPDB</strong> akan ditampilkan di halaman website untuk memberikan informasi kepada calon peserta didik baru dan orang tua/wali.
                </p>
            </div>
        </div>
    </div>
</div>
@endif

@push('styles')
<style>
.badge-lg {
    font-size: 0.9rem;
    padding: 0.4rem 0.8rem;
}

.hover-zoom {
    transition: transform 0.3s ease;
}

.hover-zoom:hover {
    transform: scale(1.05);
}

.info-box {
    display: flex;
    align-items: center;
}

.info-box i {
    font-size: 1.5rem;
    min-width: 30px;
}

.content-box {
    font-size: 0.95rem;
}

.content-box::-webkit-scrollbar {
    width: 8px;
}

.content-box::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.content-box::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.content-box::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.brosur-container img {
    border: 3px solid #e3e6f0;
}
</style>
@endpush
@endsection