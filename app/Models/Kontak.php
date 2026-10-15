<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kontak extends Model
{
    use HasFactory;

    protected $table = 'kontak';

    protected $fillable = [
        'nama_kontak',
        'no_wa',
        'instansi',
        'sumber_data',
        'meta_data',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'meta_data' => 'array', // Otomatis serialize/deserialize JSON dari GMaps
    ];

    /**
     * Relasi Many-to-Many ke KategoriKontak.
     */
    public function kategoris(): BelongsToMany
    {
        return $this->belongsToMany(
            KategoriKontak::class,
            'kontak_has_kategori',
            'kontak_id',
            'kategori_kontak_id'
        );
    }

    /**
     * History/log pengiriman pesan yang dialamatkan ke kontak ini.
     */
    public function logPengirimans(): HasMany
    {
        return $this->hasMany(LogPengirimanWa::class, 'kontak_id');
    }
}
