<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['nama_produk', 'id_kategori', 'harga', 'stok', 'deskripsi', 'tanggal_upload', 'id_toko'];

    protected $casts = [
        'harga' => 'decimal:2',
        'tanggal_upload' => 'date',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class, 'id_toko');
    }

    public function gambarProduks(): HasMany
    {
        return $this->hasMany(GambarProduk::class, 'id_produk');
    }
}
