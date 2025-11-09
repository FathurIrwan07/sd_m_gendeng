@extends('user.app') {{-- Sesuaikan dengan layout user Anda --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header" style="background: linear-gradient(135deg, #800000 0%, #4b0000 100%);">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-headset text-primary"></i>
                        </div>
                        <div class="text-white">
                            <h6 class="m-0 font-weight-bold">Chat dengan Admin</h6>
                            <small>{{ $pengaduan->kategori->nama_kategori }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 450px; overflow-y: auto; background: #f8f9fc;" id="chatBox">
                    @forelse($pengaduan->chats as $chat)
                    <div class="mb-3 d-flex {{ $chat->is_admin ? 'justify-content-start' : 'justify-content-end' }}" data-chat-id="{{ $chat->id_chat }}">
                        <div class="chat-message" style="max-width: 70%;">
                            <div class="p-3 rounded {{ $chat->is_admin ? 'bg-light border' : 'bg-primary text-white' }}">
                                <small class="font-weight-bold {{ $chat->is_admin ? 'text-primary' : 'text-light' }}">
                                    {{ $chat->is_admin ? 'Admin' : 'Anda' }}
                                </small>
                                <p class="mb-1">{{ $chat->pesan }}</p>
                                <small class="{{ $chat->is_admin ? 'text-muted' : 'text-light' }}" style="font-size: 0.75rem;">
                                    {{ $chat->created_at->format('H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-comments fa-3x mb-3"></i>
                        <p>Belum ada pesan. Mulai percakapan dengan admin!</p>
                    </div>
                    @endforelse
                </div>
                <div class="card-footer">
                    <form action="{{ route('user.chat.store', $pengaduan->id_pengaduan) }}" method="POST" id="chatForm">
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

            <div class="mt-3">
                <a href="{{ route('user.pengaduan.show', $pengaduan->id_pengaduan) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Pengaduan
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Same auto-refresh script as admin
function scrollToBottom() {
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
}

scrollToBottom();

let lastChatId = {{ $pengaduan->chats->last()->id_chat ?? 0 }};

setInterval(function() {
    fetch(`{{ route('user.chat.get-new-messages', $pengaduan->id_pengaduan) }}?last_chat_id=${lastChatId}`)
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
    messageDiv.className = `mb-3 d-flex ${chat.is_admin ? 'justify-content-start' : 'justify-content-end'}`;
    messageDiv.setAttribute('data-chat-id', chat.id_chat);
    
    messageDiv.innerHTML = `
        <div class="chat-message" style="max-width: 70%;">
            <div class="p-3 rounded ${chat.is_admin ? 'bg-light border' : 'bg-primary text-white'}">
                <small class="font-weight-bold ${chat.is_admin ? 'text-primary' : 'text-light'}">
                    ${chat.is_admin ? 'Admin' : 'Anda'}
                </small>
                <p class="mb-1">${chat.pesan}</p>
                <small class="${chat.is_admin ? 'text-muted' : 'text-light'}" style="font-size: 0.75rem;">
                    ${chat.created_at}
                </small>
            </div>
        </div>
    `;
    
    chatBox.appendChild(messageDiv);
}
</script>
@endsection