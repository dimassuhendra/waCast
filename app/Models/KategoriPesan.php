<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPesan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pesan';

    protected $fillable = [
        'nama_kategori',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Broadcast yang menggunakan kategori pesan ini.
     */
    public function broadcasts(): HasMany
    {
        return $this->hasMany(Broadcast::class, 'kategori_pesan_id');
    }
}
