<?php
namespace App\Http\Controllers;

use App\Models\ChatPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatPengaduanController extends Controller
{
    /**
     * Display chat untuk pengaduan tertentu (Admin View)
     */
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['pelapor', 'kategori', 'chats.pengirim']);
        
        // Mark admin's unread messages as read
        $pengaduan->chats()
            ->where('is_admin', false)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.chat.show', compact('pengaduan'));
    }

    /**
     * Store chat message (Admin)
     */
    public function store(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'pesan' => 'required|string|max:1000',
        ], [
            'pesan.required' => 'Pesan tidak boleh kosong',
            'pesan.max' => 'Pesan maksimal 1000 karakter',
        ]);

        ChatPengaduan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'user_id' => auth()->id(),
            'pesan' => $validated['pesan'],
            'is_admin' => auth()->user()->isAdmin(),
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    /**
     * Get new messages (AJAX - untuk real-time)
     */
    public function getNewMessages(Pengaduan $pengaduan)
    {
        $lastChatId = request()->input('last_chat_id', 0);
        
        $newChats = $pengaduan->chats()
            ->with('pengirim')
            ->where('id_chat', '>', $lastChatId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        if (auth()->user()->isAdmin()) {
            $pengaduan->chats()
                ->where('id_chat', '>', $lastChatId)
                ->where('is_admin', false)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json([
            'success' => true,
            'chats' => $newChats->map(function($chat) {
                return [
                    'id_chat' => $chat->id_chat,
                    'pesan' => $chat->pesan,
                    'is_admin' => $chat->is_admin,
                    'pengirim_nama' => $chat->pengirim->nama_lengkap,
                    'created_at' => $chat->created_at->format('H:i'),
                    'created_at_full' => $chat->created_at->format('d/m/Y H:i'),
                ];
            }),
            'unread_count' => $pengaduan->unreadChatsForAdmin(),
        ]);
    }

    /**
     * Get all pengaduan with unread chat count (untuk list)
     */
    public function index()
    {
        $pengaduanWithChat = Pengaduan::with(['pelapor', 'kategori'])
            ->has('chats')
            ->withCount([
                'chats as unread_count' => function($query) {
                    $query->where('is_admin', false)
                          ->where('is_read', false);
                }
            ])
            ->orderByDesc('unread_count')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.chat.index', compact('pengaduanWithChat'));
    }

    // ============================================
    // USER SIDE (untuk pelapor)
    // ============================================

    /**
     * User view their chat
     */
    public function userChat(Pengaduan $pengaduan)
    {
        // Pastikan user hanya bisa akses chat pengaduan mereka sendiri
        if ($pengaduan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke chat ini');
        }

        $pengaduan->load(['kategori', 'chats.pengirim']);
        
        // Mark user's unread messages as read
        $pengaduan->chats()
            ->where('is_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('user.chat.show', compact('pengaduan'));
    }

    /**
     * User send message
     */
    public function userStore(Request $request, Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        ChatPengaduan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'user_id' => auth()->id(),
            'pesan' => $validated['pesan'],
            'is_admin' => false,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    /**
     * User get new messages
     */
    public function userGetNewMessages(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $lastChatId = request()->input('last_chat_id', 0);
        
        $newChats = $pengaduan->chats()
            ->with('pengirim')
            ->where('id_chat', '>', $lastChatId)
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        $pengaduan->chats()
            ->where('id_chat', '>', $lastChatId)
            ->where('is_admin', true)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'chats' => $newChats->map(function($chat) {
                return [
                    'id_chat' => $chat->id_chat,
                    'pesan' => $chat->pesan,
                    'is_admin' => $chat->is_admin,
                    'pengirim_nama' => $chat->pengirim->nama_lengkap,
                    'created_at' => $chat->created_at->format('H:i'),
                    'created_at_full' => $chat->created_at->format('d/m/Y H:i'),
                ];
            }),
            'unread_count' => $pengaduan->unreadChatsForUser(),
        ]);
    }
    public function userIndex()
{
    $pengaduanList = Pengaduan::where('user_id', auth()->id())
        ->with(['kategori'])
        ->withCount([
            'chats as unread_count' => function($query) {
                $query->where('is_admin', true)
                      ->where('is_read', false);
            }
        ])
        ->orderByDesc('unread_count')
        ->orderBy('updated_at', 'desc')
        ->get();

    // Tambahkan last_chat untuk setiap pengaduan
    $pengaduanList->each(function($pengaduan) {
        $pengaduan->last_chat = $pengaduan->chats()->latest()->first();
    });

    return view('user.chat.index', compact('pengaduanList'));
}
}