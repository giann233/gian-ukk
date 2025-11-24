<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TokoRequest extends Model
{
    protected $table = 'toko_requests';

    protected $fillable = [
        'nama_toko',
        'deskripsi',
        'kontak_toko',
        'alamat',
        'id_user',
        'status',
        'admin_notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
