<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index(): View
    {
        $cartItems = Keranjang::getCartItems();
        $cartCount = Keranjang::getCartCount();
        $cartTotal = Keranjang::getCartTotal();

        // Group items by store for checkout
        $itemsByStore = $cartItems->groupBy(function ($item) {
            return $item->produk->toko->nama_toko;
        });

        return view('checkout.index', compact('cartItems', 'cartCount', 'cartTotal', 'itemsByStore'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request): JsonResponse
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat_pengiriman' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'catatan' => 'nullable|string'
        ]);

        $cartItems = Keranjang::getCartItems();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ], 400);
        }

        // Group items by store
        $itemsByStore = $cartItems->groupBy(function ($item) {
            return $item->produk->toko->nama_toko;
        });

        $checkoutData = [];
        $totalAmount = 0;

        foreach ($itemsByStore as $storeName => $items) {
            $storeTotal = 0;
            $storeItems = [];

            foreach ($items as $item) {
                $itemTotal = $item->produk->harga * $item->quantity;
                $storeTotal += $itemTotal;

                $storeItems[] = [
                    'produk' => $item->produk->nama_produk,
                    'quantity' => $item->quantity,
                    'harga' => $item->produk->harga,
                    'total' => $itemTotal
                ];
            }

            $checkoutData[] = [
                'toko' => $storeName,
                'kontak_toko' => $items->first()->produk->toko->kontak_toko,
                'items' => $storeItems,
                'total' => $storeTotal
            ];

            $totalAmount += $storeTotal;
        }

        // Generate WhatsApp message
        $message = $this->generateWhatsAppMessage($request, $checkoutData, $totalAmount);

        // Clear cart after successful checkout
        if (auth()->check()) {
            Keranjang::where('id_user', auth()->id())->delete();
        } else {
            Keranjang::where('session_id', session()->getId())->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Checkout berhasil! Pesanan akan diproses oleh penjual.',
            'whatsapp_message' => $message,
            'checkout_data' => $checkoutData
        ]);
    }

    /**
     * Generate WhatsApp message for checkout
     */
    private function generateWhatsAppMessage(Request $request, array $checkoutData, float $totalAmount): string
    {
        $message = "🛒 *PESANAN BARU*\n\n";
        $message .= "👤 *Data Pembeli:*\n";
        $message .= "Nama: {$request->nama_pembeli}\n";
        $message .= "Alamat: {$request->alamat_pengiriman}\n";
        $message .= "No. HP: {$request->nomor_telepon}\n";

        if ($request->catatan) {
            $message .= "Catatan: {$request->catatan}\n";
        }

        $message .= "\n📦 *Detail Pesanan:*\n";

        foreach ($checkoutData as $storeData) {
            $message .= "\n🏪 *{$storeData['toko']}*\n";
            foreach ($storeData['items'] as $item) {
                $message .= "• {$item['produk']} ({$item['quantity']}x) = Rp " . number_format($item['total'], 0, ',', '.') . "\n";
            }
            $message .= "💰 *Subtotal: Rp " . number_format($storeData['total'], 0, ',', '.') . "*\n";
        }

        $message .= "\n💵 *TOTAL PEMBAYARAN: Rp " . number_format($totalAmount, 0, ',', '.') . "*\n\n";
        $message .= "📱 Silakan konfirmasi ketersediaan stok dan metode pembayaran.\n";
        $message .= "🙏 Terima kasih atas pesanannya!";

        return $message;
    }

    /**
     * Get checkout summary
     */
    public function summary(): JsonResponse
    {
        $cartItems = Keranjang::getCartItems();
        $cartTotal = Keranjang::getCartTotal();

        $itemsByStore = $cartItems->groupBy(function ($item) {
            return $item->produk->toko->nama_toko;
        });

        return response()->json([
            'items_by_store' => $itemsByStore,
            'total' => $cartTotal,
            'count' => $cartItems->count()
        ]);
    }
}
