<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KategoriKontak extends Model
{
    use HasFactory;

    protected $table = 'kategori_kontak';

    protected $fillable = [
        'nama_kategori',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi Many-to-Many ke tabel Kontak via pivot `kontak_has_kategori`.
     */
    public function kontaks(): BelongsToMany
    {
        return $this->belongsToMany(
            Kontak::class,
            'kontak_has_kategori',
            'kategori_kontak_id',
            'kontak_id'
        );
    }
}
