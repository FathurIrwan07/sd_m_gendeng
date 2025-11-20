<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GelombangPpdb extends Model
{
    use HasFactory;

    protected $table = 'gelombang_ppdb';
    protected $primaryKey = 'id_gelombang';

    protected $fillable = [
        'id_info_ppdb',
        'nama_gelombang',
        'nomor_gelombang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relasi ke tabel info_ppdb
     */
    public function infoPpdb()
    {
        return $this->belongsTo(InfoPpdb::class, 'id_info_ppdb', 'id_info_ppdb');
    }

    /**
     * Relasi ke tabel tahapan_ppdb
     */
    public function tahapan()
    {
        return $this->hasMany(TahapanPpdb::class, 'id_gelombang', 'id_gelombang')
                    ->orderBy('urutan');
    }

    /**
     * Accessor untuk format tanggal mulai Indonesia
     */
    public function getTanggalMulaiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_mulai)->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk format tanggal selesai Indonesia
     */
    public function getTanggalSelesaiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_selesai)->isoFormat('D MMMM YYYY');
    }

    /**
     * Accessor untuk rentang tanggal
     */
    public function getRentangTanggalAttribute()
    {
        $mulai = Carbon::parse($this->tanggal_mulai);
        $selesai = Carbon::parse($this->tanggal_selesai);
        
        return $mulai->isoFormat('D MMMM') . ' - ' . $selesai->isoFormat('D MMMM YYYY');
    }

    /**
     * Update status gelombang berdasarkan tanggal
     */
    public function updateStatus()
    {
        $now = Carbon::now();
        
        if ($now->lessThan($this->tanggal_mulai)) {
            $this->status = 'belum_mulai';
        } elseif ($now->between($this->tanggal_mulai, $this->tanggal_selesai)) {
            $this->status = 'berlangsung';
        } else {
            $this->status = 'selesai';
        }
        
        return $this->save();
    }

    /**
     * Check apakah gelombang sedang berlangsung
     */
    public function isBerlangsung()
    {
        $now = Carbon::now();
        return $now->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    /**
     * Check apakah gelombang sudah selesai
     */
    public function isSelesai()
    {
        return Carbon::now()->greaterThan($this->tanggal_selesai);
    }

    /**
     * Check apakah gelombang belum dimulai
     */
    public function isBelumMulai()
    {
        return Carbon::now()->lessThan($this->tanggal_mulai);
    }

    /**
     * Scope untuk filter gelombang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'berlangsung');
    }

    /**
     * Scope untuk filter berdasarkan info PPDB
     */
    public function scopeByInfoPpdb($query, $id)
    {
        return $query->where('id_info_ppdb', $id);
    }
}