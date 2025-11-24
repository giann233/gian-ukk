<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $produk->nama_produk }} - Marketplace Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .product-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .product-gallery {
            position: relative;
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 1rem;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        .thumbnail:hover {
            transform: scale(1.1);
            border-color: #667eea;
        }

        .thumbnail.active {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .product-info {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: #198754;
            margin-bottom: 1rem;
        }

        .product-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .meta-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 1.1rem;
            color: #2d3748;
            margin-top: 0.25rem;
        }

        .product-description {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .store-info {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        .store-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .store-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-cart {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-whatsapp:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
            color: white;
            text-decoration: none;
        }

        .related-products {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .related-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .related-card {
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            text-decoration: none;
            color: inherit;
        }

        .related-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .related-content {
            padding: 1rem;
        }

        .related-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .related-price {
            color: #198754;
            font-weight: 700;
        }

        .breadcrumb-custom {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .rating-stars {
            color: #ffc107;
            margin-bottom: 0.5rem;
        }

        .stock-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .stock-high {
            background: #d4edda;
            color: #155724;
        }

        .stock-medium {
            background: #fff3cd;
            color: #856404;
        }

        .stock-low {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .product-title {
                font-size: 2rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .product-meta {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="breadcrumb-custom">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('produks.index') }}" class="text-decoration-none">Produk</a>
                </li>
                <li class="breadcrumb-item active">{{ $produk->nama_produk }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Gallery -->
            <div class="col-lg-6 mb-4">
                <div class="product-gallery">
                    @if($produk->gambarProduks->isNotEmpty())
                        <img id="main-image" src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}"
                             alt="{{ $produk->nama_produk }}" class="main-image">

                        <div class="thumbnail-grid">
                            @foreach($produk->gambarProduks as $index => $gambar)
                                <img src="{{ asset('storage/' . $gambar->nama_file) }}"
                                     alt="{{ $produk->nama_produk }} - {{ $index + 1 }}"
                                     class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                     data-image="{{ asset('storage/' . $gambar->nama_file) }}">
                            @endforeach
                        </div>
                    @else
                        <div class="main-image bg-light d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <i class="bi bi-image text-muted fs-1 mb-3"></i>
                                <p class="text-muted">Tidak ada gambar produk</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="product-title">{{ $produk->nama_produk }}</h1>

                    <div class="rating-stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-muted ms-2">4.5 (120 ulasan)</span>
                    </div>

                    <div class="product-price mb-4">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta">
                        <div class="meta-item">
                            <div class="meta-label">Kategori</div>
                            <div class="meta-value">{{ $produk->kategori->nama_kategori }}</div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Stok</div>
                            <div class="meta-value">
                                {{ $produk->stok }}
                                @if($produk->stok > 50)
                                    <span class="stock-badge stock-high ms-2">Tersedia</span>
                                @elseif($produk->stok > 10)
                                    <span class="stock-badge stock-medium ms-2">Terbatas</span>
                                @else
                                    <span class="stock-badge stock-low ms-2">Hampir Habis</span>
                                @endif
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Tanggal Upload</div>
                            <div class="meta-value">{{ $produk->tanggal_upload->format('d M Y') }}</div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-label">Kondisi</div>
                            <div class="meta-value">Baru</div>
                        </div>
                    </div>

                    <!-- Store Info -->
                    <div class="store-info">
                        <div class="store-header">
                            <div class="store-avatar">
                                {{ strtoupper(substr($produk->toko->nama_toko, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $produk->toko->nama_toko }}</h5>
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $produk->toko->alamat_toko ?? 'Alamat tidak tersedia' }}
                                </small>
                            </div>
                        </div>
                        <p class="mb-0 text-muted small">{{ $produk->toko->deskripsi_toko ?? 'Deskripsi toko tidak tersedia' }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="btn-cart btn-add-to-cart"
                                data-produk-id="{{ $produk->id }}"
                                data-produk-name="{{ $produk->nama_produk }}">
                            <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                        </button>
                        <a href="https://wa.me/{{ $produk->toko->kontak_toko }}?text=Halo, saya tertarik dengan produk *{{ $produk->nama_produk }}*. Apakah masih tersedia? Mohon info harga dan cara pembeliannya. Terima kasih!"
                           target="_blank" class="btn-whatsapp">
                            <i class="fab fa-whatsapp me-2"></i>Hubungi Penjual
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="product-info">
                    <h3 class="mb-3">
                        <i class="bi bi-info-circle me-2"></i>Deskripsi Produk
                    </h3>
                    <div class="product-description">
                        {{ $produk->deskripsi ?? 'Deskripsi produk tidak tersedia.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="related-products">
                    <h3 class="related-title">
                        <i class="bi bi-grid me-2"></i>Produk Terkait
                    </h3>
                    <div class="related-grid">
                        @php
                            $relatedProducts = \App\Models\Produk::where('id_kategori', $produk->id_kategori)
                                ->where('id', '!=', $produk->id)
                                ->with(['gambarProduks', 'toko'])
                                ->take(4)
                                ->get();
                        @endphp

                        @forelse($relatedProducts as $related)
                            <a href="{{ route('produks.show', $related->id) }}" class="related-card">
                                <div>
                                    @if($related->gambarProduks->isNotEmpty())
                                        <img src="{{ asset('storage/' . $related->gambarProduks->first()->nama_file) }}"
                                             alt="{{ $related->nama_produk }}" class="related-image">
                                    @else
                                        <div class="related-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="related-content">
                                    <div class="related-name">{{ Str::limit($related->nama_produk, 30) }}</div>
                                    <div class="related-price">Rp {{ number_format($related->harga, 0, ',', '.') }}</div>
                                    <small class="text-muted">{{ $related->toko->nama_toko }}</small>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-search text-muted fs-1 mb-3"></i>
                                <p class="text-muted">Tidak ada produk terkait</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image gallery functionality
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainImage = document.getElementById('main-image');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Update main image
                    const imageSrc = this.getAttribute('data-image');
                    mainImage.src = imageSrc;

                    // Update active thumbnail
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Add to cart functionality
            document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-produk-id');
                    const productName = this.getAttribute('data-produk-name');

                    // Add loading animation
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...';
                    this.disabled = true;

                    // Add to cart via AJAX
                    fetch('/keranjang', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({
                            id_produk: productId,
                            quantity: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update cart count
                            const cartCountElement = document.getElementById('cart-count');
                            if (cartCountElement) {
                                cartCountElement.textContent = data.cart_count;
                            }

                            // Show success message with animation
                            this.innerHTML = '<i class="fas fa-check-circle me-2"></i>Ditambahkan!';
                            this.classList.remove('btn-cart');
                            this.classList.add('btn-success');

                            // Create success notification
                            showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');

                            setTimeout(() => {
                                this.innerHTML = originalText;
                                this.classList.remove('btn-success');
                                this.classList.add('btn-cart');
                                this.disabled = false;
                            }, 2000);
                        } else {
                            showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
                        this.innerHTML = originalText;
                        this.disabled = false;
                    });
                });
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                notification.innerHTML = `
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Smooth scroll for related products
            document.querySelectorAll('.related-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Add loading animation for main image
            const mainImageElement = document.getElementById('main-image');
            if (mainImageElement) {
                mainImageElement.addEventListener('load', function() {
                    this.style.opacity = '1';
                });

                mainImageElement.style.opacity = '0';
                mainImageElement.style.transition = 'opacity 0.3s ease';
            }
        });
    </script>
</body>
</html>
