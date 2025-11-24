<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class KeranjangController extends Controller
{
    /**
     * Display cart contents
     */
    public function index(): View
    {
        $cartItems = Keranjang::getCartItems();
        $cartCount = Keranjang::getCartCount();
        $cartTotal = Keranjang::getCartTotal();

        return view('keranjang.index', compact('cartItems', 'cartCount', 'cartTotal'));
    }

    /**
     * Add product to cart
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $produk = Produk::findOrFail($request->id_produk);

        // Check stock availability
        if ($produk->stok < ($request->quantity ?? 1)) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ], 400);
        }

        $cartItem = Keranjang::addToCart($request->id_produk, $request->quantity ?? 1);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => Keranjang::getCartCount()
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Keranjang::findOrFail($id);

        // Check if user owns this cart item
        if (auth()->check()) {
            if ($cartItem->id_user !== auth()->id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        } else {
            if ($cartItem->session_id !== session()->getId()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        }

        // Check stock availability
        if ($cartItem->produk->stok < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi'
            ], 400);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Jumlah berhasil diperbarui',
            'cart_total' => Keranjang::getCartTotal(),
            'item_total' => $cartItem->produk->harga * $cartItem->quantity
        ]);
    }

    /**
     * Remove item from cart
     */
    public function destroy($id): JsonResponse
    {
        $cartItem = Keranjang::findOrFail($id);

        // Check if user owns this cart item
        if (auth()->check()) {
            if ($cartItem->id_user !== auth()->id()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        } else {
            if ($cartItem->session_id !== session()->getId()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang',
            'cart_count' => Keranjang::getCartCount(),
            'cart_total' => Keranjang::getCartTotal()
        ]);
    }

    /**
     * Get cart count (for AJAX)
     */
    public function count(): JsonResponse
    {
        return response()->json([
            'count' => Keranjang::getCartCount()
        ]);
    }

    /**
     * Clear cart
     */
    public function clear(): JsonResponse
    {
        if (auth()->check()) {
            Keranjang::where('id_user', auth()->id())->delete();
        } else {
            Keranjang::where('session_id', session()->getId())->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }
}
