<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broadcast extends Model
{
    use HasFactory;

    protected $table = 'broadcasts';

    protected $fillable = [
        'user_id',
        'wa_account_id',
        'kategori_pesan_id',
        'judul_campaign',
        'isi_pesan',
        'waktu_jadwal',
        'delay_detik',
        'status',
    ];

    protected $casts = [
        'waktu_jadwal' => 'datetime',
        'delay_detik'  => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function waAccount(): BelongsTo
    {
        return $this->belongsTo(WaAccount::class, 'wa_account_id');
    }

    public function kategoriPesan(): BelongsTo
    {
        return $this->belongsTo(KategoriPesan::class, 'kategori_pesan_id');
    }

    /**
     * Seluruh item antrean / log pengiriman pesan dalam campaign ini.
     */
    public function logs(): HasMany
    {
        return $this->hasMany(LogPengirimanWa::class, 'broadcast_id');
    }
}
