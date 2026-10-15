<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogPengirimanWa extends Model
{
    use HasFactory;

    protected $table = 'log_pengiriman_wa';

    protected $fillable = [
        'broadcast_id',
        'kontak_id',
        'no_wa_tujuan',
        'pesan_rendered',
        'status',
        'response_api',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function broadcast(): BelongsTo
    {
        return $this->belongsTo(Broadcast::class, 'broadcast_id');
    }

    public function kontak(): BelongsTo
    {
        return $this->belongsTo(Kontak::class, 'kontak_id');
    }
}