@extends('admin.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #800000;">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-list"></i> Daftar Pengaduan dengan Chat
                </h6>
            </div>
            <div class="card-body">
                @if($pengaduanWithChat->count() > 0)
                <div class="list-group">
                    @foreach($pengaduanWithChat as $item)
                    <a href="{{ route('chat.show', $item->id_pengaduan) }}" 
                       class="list-group-item list-group-item-action {{ $item->unread_count > 0 ? 'border-left-primary' : '' }}">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 45px; height: 45px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">
                                            @if($item->pelapor)
                                                {{ $item->pelapor->nama_lengkap }}
                                            @else
                                                <span class="badge badge-secondary">Anonim</span>
                                            @endif
                                        </h6>
                                        <p class="mb-1 text-muted">
                                            <span class="badge badge-info">{{ $item->kategori->nama_kategori }}</span>
                                            {{ Str::limit($item->deskripsi, 60) }}
                                        </p>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i> {{ $item->updated_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right ml-3">
                                @if($item->unread_count > 0)
                                <span class="badge badge-danger badge-pill" style="font-size: 14px;">
                                    {{ $item->unread_count }} pesan baru
                                </span>
                                @else
                                <i class="fas fa-chevron-right text-muted"></i>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada chat</h5>
                    <p class="text-muted">Chat akan muncul ketika ada komunikasi dengan pelapor</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection