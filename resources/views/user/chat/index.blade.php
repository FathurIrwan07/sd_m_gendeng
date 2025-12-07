@extends('user.app')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center border-right">
                            <h4 class="text-primary mb-0">{{ $pengaduanList->count() }}</h4>
                            <small class="text-muted">Total Pengaduan</small>
                        </div>
                        <div class="col-md-4 text-center border-right">
                            <h4 class="text-warning mb-0">{{ $pengaduanList->where('status_pengaduan', 'Diproses')->count() }}</h4>
                            <small class="text-muted">Sedang Diproses</small>
                        </div>
                        <div class="col-md-4 text-center">
                            <h4 class="text-danger mb-0">
                                {{ $pengaduanList->sum('unread_count') }}
                            </h4>
                            <small class="text-muted">Pesan Belum Dibaca</small>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-list"></i> Daftar Pengaduan Anda
                    </h6>
                </div>
                <div class="card-body">
                    @if($pengaduanList->count() > 0)
                    <div class="list-group">
                        @foreach($pengaduanList as $item)
                        <a href="{{ route('user.chat.show', $item->id_pengaduan) }}" 
                           class="list-group-item list-group-item-action {{ $item->unread_count > 0 ? 'border-left-primary' : '' }}">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                                                <i class="fas fa-file-alt fa-lg text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">
                                                <span class="badge badge-info mr-2">{{ $item->kategori->nama_kategori }}</span>
                                                @if($item->status_pengaduan === 'Selesai')
                                                    <span class="badge badge-success">Selesai</span>
                                                @elseif($item->status_pengaduan === 'Diproses')
                                                    <span class="badge badge-warning">Diproses</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $item->status_pengaduan }}</span>
                                                @endif
                                            </h6>
                                            <p class="mb-1 text-muted">
                                                {{ Str::limit($item->deskripsi, 80) }}
                                            </p>
                                            <small class="text-muted">
                                                <i class="far fa-clock"></i> Dibuat: {{ $item->tanggal_pengaduan->format('d M Y') }}
                                            </small>
                                            @if($item->last_chat)
                                            <br>
                                            <small class="text-info">
                                                <i class="fas fa-comment"></i> Chat terakhir: {{ $item->last_chat->created_at->diffForHumans() }}
                                            </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right ml-3">
                                    @if($item->unread_count > 0)
                                    <span class="badge badge-danger badge-pill" style="font-size: 14px; padding: 8px 12px;">
                                        {{ $item->unread_count }} pesan baru
                                    </span>
                                    @else
                                    <div class="text-muted">
                                        <i class="fas fa-chevron-right"></i>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada pengaduan</h5>
                        <p class="text-muted mb-4">Anda belum memiliki pengaduan. Buat pengaduan terlebih dahulu untuk dapat menggunakan fitur chat.</p>
                        <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Buat Pengaduan Baru
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.list-group-item-action:hover {
    background-color: #f8f9fc;
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.badge-pill {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
}
</style>
@endsection