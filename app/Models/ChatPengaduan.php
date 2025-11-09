<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatPengaduan extends Model
{
    use HasFactory;

    protected $table = 'chat_pengaduan';
    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'id_pengaduan',
        'user_id',
        'pesan',
        'is_admin',
        'is_read',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_read' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function pengirim(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
    public function chats(): HasMany
{
    return $this->hasMany(ChatPengaduan::class, 'id_pengaduan', 'id_pengaduan');
}

public function unreadChatsForAdmin(): int
{
    return $this->chats()
        ->where('is_admin', false)
        ->where('is_read', false)
        ->count();
}

public function unreadChatsForUser(): int
{
    return $this->chats()
        ->where('is_admin', true)
        ->where('is_read', false)
        ->count();
}

}