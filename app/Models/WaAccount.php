<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WaAccount extends Model
{
    use HasFactory;

    protected $table = 'wa_accounts';

    protected $fillable = [
        'user_id',
        'nama_akun',
        'no_wa_pengirim',
        'provider',
        'api_key',
        'phone_number_id',
        'account_status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * User pemilik akun WA (bisa NULL jika bersifat public/global).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Campaign broadcast yang dikirim menggunakan nomor WA ini.
     */
    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'wa_account_id');
    }
}