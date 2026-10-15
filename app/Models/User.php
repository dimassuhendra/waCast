<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password'  => 'hashed',
    ];

    /**
     * Relasi ke akun WA pengirim yang dikelola oleh user ini.
     */
    public function waAccounts(): HasMany
    {
        return $this->hasMany(WaAccount::class, 'user_id');
    }

    /**
     * Relasi ke campaign broadcast yang dibuat oleh user ini.
     */
    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'user_id');
    }
}
