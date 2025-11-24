<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'id_user',
        'session_id',
        'id_produk',
        'quantity'
    ];

    protected $casts = [
        'quantity' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    /**
     * Get cart items for authenticated user or guest session
     */
    public static function getCartItems()
    {
        if (auth()->check()) {
            return self::with(['produk.kategori', 'produk.toko', 'produk.gambarProduks'])
                ->where('id_user', auth()->id())
                ->get();
        } else {
            return self::with(['produk.kategori', 'produk.toko', 'produk.gambarProduks'])
                ->where('session_id', session()->getId())
                ->get();
        }
    }

    /**
     * Get total items in cart
     */
    public static function getCartCount()
    {
        if (auth()->check()) {
            return self::where('id_user', auth()->id())->sum('quantity');
        } else {
            return self::where('session_id', session()->getId())->sum('quantity');
        }
    }

    /**
     * Get total price of cart
     */
    public static function getCartTotal()
    {
        $items = self::getCartItems();
        return $items->sum(function ($item) {
            return $item->produk->harga * $item->quantity;
        });
    }

    /**
     * Add product to cart
     */
    public static function addToCart($produkId, $quantity = 1)
    {
        if (auth()->check()) {
            $cartItem = self::where('id_user', auth()->id())
                ->where('id_produk', $produkId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
                return $cartItem;
            } else {
                return self::create([
                    'id_user' => auth()->id(),
                    'id_produk' => $produkId,
                    'quantity' => $quantity
                ]);
            }
        } else {
            $cartItem = self::where('session_id', session()->getId())
                ->where('id_produk', $produkId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
                return $cartItem;
            } else {
                return self::create([
                    'session_id' => session()->getId(),
                    'id_produk' => $produkId,
                    'quantity' => $quantity
                ]);
            }
        }
    }

    /**
     * Transfer guest cart to user cart after login
     */
    public static function transferGuestCartToUser($userId)
    {
        self::where('session_id', session()->getId())
            ->whereNull('id_user')
            ->update(['id_user' => $userId, 'session_id' => null]);
    }
}
