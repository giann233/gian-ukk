<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Marketplace Sekolah</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .cart-item {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .quantity-input {
            width: 80px;
            text-align: center;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 8px;
        }

        .quantity-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .cart-summary {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            position: sticky;
            top: 20px;
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-cart i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn-cart-action {
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-cart-action:hover {
            transform: translateY(-1px);
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #198754;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">
                    <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
                    <span class="badge bg-primary ms-2">{{ $cartCount }} item</span>
                </h2>

                @if($cartItems->count() > 0)
                    <div id="cart-items">
                        @foreach($cartItems as $item)
                        <div class="cart-item p-4" data-cart-id="{{ $item->id }}">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    @if($item->produk->gambarProduks->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->produk->gambarProduks->first()->nama_file) }}"
                                             alt="{{ $item->produk->nama_produk }}"
                                             class="product-image">
                                    @else
                                        <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-1">{{ $item->produk->nama_produk }}</h5>
                                    <p class="text-muted mb-1">{{ $item->produk->toko->nama_toko }}</p>
                                    <small class="text-muted">{{ $item->produk->kategori->nama_kategori }}</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="decrease">-</button>
                                        <input type="number" class="form-control quantity-input" value="{{ $item->quantity }}" min="1" max="{{ $item->produk->stok }}">
                                        <button class="btn btn-outline-secondary btn-sm quantity-btn" data-action="increase">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-end">
                                        <div class="fw-bold text-primary item-total">
                                            Rp {{ number_format($item->produk->harga * $item->quantity, 0, ',', '.') }}
                                        </div>
                                        <small class="text-muted">Rp {{ number_format($item->produk->harga, 0, ',', '.') }} / item</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-danger btn-sm btn-cart-action remove-item" data-cart-id="{{ $item->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button class="btn btn-outline-secondary btn-cart-action" id="clear-cart">
                            <i class="bi bi-trash me-1"></i>Kosongkan Keranjang
                        </button>
                    </div>
                @else
                    <div class="empty-cart">
                        <i class="bi bi-cart-x"></i>
                        <h4>Keranjang Kosong</h4>
                        <p>Belum ada produk di keranjang Anda</p>
                        <a href="{{ route('produks.index') }}" class="btn btn-primary">
                            <i class="bi bi-shop me-1"></i>Belanja Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="cart-summary p-4">
                    <h4 class="mb-4">
                        <i class="bi bi-receipt me-2"></i>Ringkasan Belanja
                    </h4>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Item:</span>
                        <span class="fw-bold">{{ $cartCount }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Harga:</span>
                        <span class="total-price">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                    </div>

                    <hr>

                    @if($cartItems->count() > 0)
                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-credit-card me-2"></i>Checkout
                            </a>
                            <a href="{{ route('produks.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-1"></i>Lanjut Belanja
                            </a>
                        </div>
                    @endif

                    <div class="mt-4 p-3 bg-light rounded">
                        <h6 class="mb-2">
                            <i class="bi bi-info-circle me-1"></i>Informasi
                        </h6>
                        <ul class="list-unstyled small mb-0">
                            <li>• Produk akan dihubungi via WhatsApp</li>
                            <li>• Pastikan nomor WhatsApp aktif</li>
                            <li>• Pembayaran dilakukan langsung ke penjual</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update quantity
            document.querySelectorAll('.quantity-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cartItem = this.closest('.cart-item');
                    const cartId = cartItem.dataset.cartId;
                    const input = cartItem.querySelector('.quantity-input');
                    let quantity = parseInt(input.value);

                    if (this.dataset.action === 'increase') {
                        quantity++;
                    } else if (this.dataset.action === 'decrease' && quantity > 1) {
                        quantity--;
                    }

                    updateCartItem(cartId, quantity);
                });
            });

            // Update quantity on input change
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const cartItem = this.closest('.cart-item');
                    const cartId = cartItem.dataset.cartId;
                    const quantity = parseInt(this.value);

                    if (quantity > 0) {
                        updateCartItem(cartId, quantity);
                    }
                });
            });

            // Remove item
            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    const cartId = this.dataset.cartId;
                    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                        removeCartItem(cartId);
                    }
                });
            });

            // Clear cart
            document.getElementById('clear-cart')?.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                    clearCart();
                }
            });

        });

        function updateCartItem(cartId, quantity) {
            fetch(`/keranjang/${cartId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update item total
                    const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
                    cartItem.querySelector('.item-total').textContent = 'Rp ' + data.item_total.toLocaleString('id-ID');

                    // Update total price
                    document.querySelector('.total-price').textContent = 'Rp ' + data.cart_total.toLocaleString('id-ID');

                    // Update cart count in navbar
                    updateCartCount();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui keranjang');
            });
        }

        function removeCartItem(cartId) {
            fetch(`/keranjang/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item from DOM
                    document.querySelector(`[data-cart-id="${cartId}"]`).remove();

                    // Update total price
                    document.querySelector('.total-price').textContent = 'Rp ' + data.cart_total.toLocaleString('id-ID');

                    // Update cart count
                    updateCartCount();

                    // Check if cart is empty
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        location.reload();
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus item');
            });
        }

        function clearCart() {
            fetch('/keranjang/clear', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengosongkan keranjang');
            });
        }

        function updateCartCount() {
            fetch('/keranjang/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count;
            })
            .catch(error => console.error('Error updating cart count:', error));
        }
    </script>
</body>
</html>
