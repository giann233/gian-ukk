<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Marketplace Sekolah</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .checkout-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .store-section {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .store-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            margin: -20px -20px 20px -20px;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .product-info {
            flex-grow: 1;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-price {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .quantity-badge {
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-right: 10px;
        }

        .item-total {
            font-weight: 600;
            color: #198754;
        }

        .store-total {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .store-total .total-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: #198754;
        }

        .checkout-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section h4 {
            color: #495057;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-checkout {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .whatsapp-preview {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .whatsapp-header {
            background: #25d366;
            color: white;
            padding: 10px 15px;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
        }

        .whatsapp-content {
            background: white;
            padding: 15px;
            border-radius: 0 0 10px 10px;
            white-space: pre-line;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.4;
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

        .back-btn {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
        }

        .back-btn:hover {
            color: #495057;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('keranjang.index') }}" class="back-btn me-3">
                        <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
                    </a>
                    <h2 class="mb-0">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </h2>
                </div>

                @if($cartItems->count() > 0)
                    <!-- Order Summary by Store -->
                    <div class="checkout-card p-4">
                        <h4 class="mb-4">
                            <i class="bi bi-receipt me-2"></i>Ringkasan Pesanan
                        </h4>

                        @foreach($itemsByStore as $storeName => $items)
                        <div class="store-section">
                            <div class="store-header">
                                <h5 class="mb-0">
                                    <i class="bi bi-shop me-2"></i>{{ $storeName }}
                                </h5>
                                <small>Kontak: {{ $items->first()->produk->toko->kontak_toko }}</small>
                            </div>

                            @foreach($items as $item)
                            <div class="product-item">
                                <div>
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
                                <div class="product-info">
                                    <div class="product-name">{{ $item->produk->nama_produk }}</div>
                                    <div class="product-price">Rp {{ number_format($item->produk->harga, 0, ',', '.') }} / item</div>
                                </div>
                                <div class="text-end">
                                    <span class="quantity-badge">{{ $item->quantity }}x</span>
                                    <div class="item-total">Rp {{ number_format($item->produk->harga * $item->quantity, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            @endforeach

                            <div class="store-total">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">Subtotal {{ $storeName }}:</span>
                                    <span class="total-amount">
                                        Rp {{ number_format($items->sum(function($item) { return $item->produk->harga * $item->quantity; }), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-4 p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Total Pembayaran:</h5>
                                <h4 class="mb-0 text-success fw-bold">Rp {{ number_format($cartTotal, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="empty-cart">
                        <i class="bi bi-cart-x"></i>
                        <h4>Keranjang Kosong</h4>
                        <p>Tidak ada produk untuk di-checkout</p>
                        <a href="{{ route('produks.index') }}" class="btn btn-primary">
                            <i class="bi bi-shop me-1"></i>Belanja Sekarang
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                @if($cartItems->count() > 0)
                <div class="checkout-form">
                    <h4>
                        <i class="bi bi-person me-2"></i>Informasi Pembeli
                    </h4>

                    <form id="checkout-form">
                        @csrf
                        <div class="form-section">
                            <div class="mb-3">
                                <label for="nama_pembeli" class="form-label fw-bold">Nama Lengkap *</label>
                                <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli"
                                       value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_telepon" class="form-label fw-bold">Nomor Telepon *</label>
                                <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                            </div>

                            <div class="mb-3">
                                <label for="alamat_pengiriman" class="form-label fw-bold">Alamat Pengiriman *</label>
                                <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman"
                                          rows="3" required placeholder="Masukkan alamat lengkap untuk pengiriman"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label fw-bold">Catatan Tambahan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="2"
                                          placeholder="Catatan khusus untuk penjual (opsional)"></textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-checkout" id="submit-checkout">
                                <i class="bi bi-whatsapp me-2"></i>Checkout via WhatsApp
                            </button>
                            <a href="{{ route('keranjang.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang
                            </a>
                        </div>
                    </form>

                    <!-- WhatsApp Preview (hidden by default) -->
                    <div id="whatsapp-preview" class="whatsapp-preview" style="display: none;">
                        <div class="whatsapp-header">
                            <i class="bi bi-whatsapp me-2"></i>Preview Pesan WhatsApp
                        </div>
                        <div class="whatsapp-content" id="whatsapp-content">
                            <!-- WhatsApp message will be populated here -->
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-check-circle me-2"></i>Checkout Berhasil!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                    <h5>Pesanan Anda telah dikirim!</h5>
                    <p class="mb-3">Pesan WhatsApp telah dibuat. Silakan kirim pesan ke penjual untuk melanjutkan proses pembelian.</p>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Penjual akan menghubungi Anda untuk konfirmasi pembayaran dan pengiriman.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-house me-1"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutForm = document.getElementById('checkout-form');
            const whatsappPreview = document.getElementById('whatsapp-preview');
            const whatsappContent = document.getElementById('whatsapp-content');
            const submitBtn = document.getElementById('submit-checkout');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));

            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mempersiapkan pesanan...';

                // Get form data
                const formData = new FormData(this);

                // Process checkout
                fetch('/checkout/process', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show WhatsApp message preview
                        whatsappContent.textContent = data.whatsapp_message;
                        whatsappPreview.style.display = 'block';

                        // Scroll to preview
                        whatsappPreview.scrollIntoView({ behavior: 'smooth' });

                        // Create WhatsApp URL for each store
                        let whatsappUrls = [];
                        data.checkout_data.forEach(store => {
                            const phoneNumber = store.kontak_toko.replace(/\D/g, ''); // Remove non-digits
                            const message = encodeURIComponent(data.whatsapp_message);
                            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
                            whatsappUrls.push({
                                store: store.toko,
                                url: whatsappUrl,
                                phone: store.kontak_toko
                            });
                        });

                        // Show success modal with WhatsApp links
                        setTimeout(() => {
                            successModal.show();

                            // Reset form and hide preview after modal closes
                            document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                                checkoutForm.reset();
                                whatsappPreview.style.display = 'none';
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Checkout via WhatsApp';
                            });
                        }, 2000);

                    } else {
                        alert(data.message || 'Terjadi kesalahan saat checkout');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Checkout via WhatsApp';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memproses checkout');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Checkout via WhatsApp';
                });
            });
        });
    </script>
</body>
</html>
