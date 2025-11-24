<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Toko extends Model
{
    protected $table = 'toko';

    protected $fillable = ['nama_toko', 'deskripsi', 'gambar', 'kontak_toko', 'alamat', 'id_user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_toko');
    }
}
