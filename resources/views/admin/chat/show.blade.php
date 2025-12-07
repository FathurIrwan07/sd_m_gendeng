@extends('admin.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-comments"></i> Chat dengan 
        @if($pengaduan->pelapor)
            {{ $pengaduan->pelapor->nama_lengkap }}
        @else
            Pelapor Anonim
        @endif
    </h1>
    <a href="{{ route('chat.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        {{-- CHAT BOX --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" 
                         style="width: 40px; height: 40px;">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div class="text-white">
                        <h6 class="m-0 text-primary font-weight-bold">
                            @if($pengaduan->pelapor)
                                {{ $pengaduan->pelapor->nama_lengkap }}
                            @else
                                Pelapor Anonim
                            @endif
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body" style="height: 500px; overflow-y: auto; background: #f8f9fc;" id="chatBox">
                @forelse($pengaduan->chats as $chat)
                <div class="mb-3 d-flex {{ $chat->is_admin ? 'justify-content-end' : 'justify-content-start' }}" data-chat-id="{{ $chat->id_chat }}">
                    <div class="chat-message {{ $chat->is_admin ? 'admin' : 'user' }}" style="max-width: 70%;">
                        <div class="p-3 rounded {{ $chat->is_admin ? 'bg-primary text-white' : 'bg-white border' }}">
                            <p class="mb-1">{{ $chat->pesan }}</p>
                            <small class="{{ $chat->is_admin ? 'text-light' : 'text-muted' }}" style="font-size: 0.75rem;">
                                {{ $chat->created_at->format('H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5">
                    <i class="fas fa-comments fa-3x mb-3"></i>
                    <p>Belum ada pesan. Mulai percakapan!</p>
                </div>
                @endforelse
            </div>
            <div class="card-footer">
                <form action="{{ route('chat.store', $pengaduan->id_pengaduan) }}" method="POST" id="chatForm">
                    @csrf
                    <div class="input-group">
                        <input type="text" 
                               name="pesan" 
                               id="pesanInput"
                               class="form-control" 
                               placeholder="Ketik pesan..." 
                               required
                               autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Kirim
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- INFO PENGADUAN --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-info-circle"></i> Info Pengaduan
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Kategori:</small><br>
                    <span class="badge badge-info">{{ $pengaduan->kategori->nama_kategori }}</span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Status:</small><br>
                    <span class="badge badge-{{ 
                        $pengaduan->status_pengaduan === 'Selesai' ? 'success' : 
                        ($pengaduan->status_pengaduan === 'Diproses' ? 'warning' : 'secondary') 
                    }}">
                        {{ $pengaduan->status_pengaduan }}
                    </span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Tanggal:</small><br>
                    <strong>{{ $pengaduan->tanggal_pengaduan->format('d F Y') }}</strong>
                </div>
                <div class="mb-0">
                    <small class="text-muted">Deskripsi:</small><br>
                    <p class="small">{{ Str::limit($pengaduan->deskripsi, 150) }}</p>
                </div>
                <hr>
                <a href="{{ route('pengaduan.show', $pengaduan->id_pengaduan) }}" class="btn btn-info btn-block btn-sm">
                    <i class="fas fa-eye"></i> Lihat Detail Pengaduan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Auto scroll to bottom
function scrollToBottom() {
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
}

// Initial scroll
scrollToBottom();

// Auto-refresh chat setiap 3 detik
let lastChatId = {{ $pengaduan->chats->last()->id_chat ?? 0 }};

setInterval(function() {
    fetch(`{{ route('chat.get-new-messages', $pengaduan->id_pengaduan) }}?last_chat_id=${lastChatId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.chats.length > 0) {
                data.chats.forEach(chat => {
                    appendMessage(chat);
                    lastChatId = chat.id_chat;
                });
                scrollToBottom();
            }
        });
}, 3000);

function appendMessage(chat) {
    const chatBox = document.getElementById('chatBox');
    const messageDiv = document.createElement('div');
    messageDiv.className = `mb-3 d-flex ${chat.is_admin ? 'justify-content-end' : 'justify-content-start'}`;
    messageDiv.setAttribute('data-chat-id', chat.id_chat);
    
    messageDiv.innerHTML = `
        <div class="chat-message ${chat.is_admin ? 'admin' : 'user'}" style="max-width: 70%;">
            <div class="p-3 rounded ${chat.is_admin ? 'bg-primary text-white' : 'bg-white border'}">
                <p class="mb-1">${chat.pesan}</p>
                <small class="${chat.is_admin ? 'text-light' : 'text-muted'}" style="font-size: 0.75rem;">
                    ${chat.created_at}
                </small>
            </div>
        </div>
    `;
    
    chatBox.appendChild(messageDiv);
}

// Submit form dengan AJAX (opsional)
document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const input = document.getElementById('pesanInput');
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        input.value = '';
        // Message akan muncul otomatis via auto-refresh
    })
    .catch(error => {
        console.error('Error:', error);
        this.submit(); // Fallback ke normal submit
    });
});
</script>
@endpush