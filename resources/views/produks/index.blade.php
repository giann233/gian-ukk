<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Produk</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Produk</h1>
                @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'member'))
                    <a href="{{ route('produks.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Tambah Produk</a>
                @endif
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 animate-fade-in">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($produks as $produk)
                <div class="bg-white overflow-hidden shadow rounded-lg product-card">
                    <div class="p-4">
                        @if($produk->gambarProduks->isNotEmpty())
                            <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}" alt="{{ $produk->nama_produk }}" class="w-full h-48 object-cover rounded-md">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <h3 class="mt-2 text-lg font-medium text-gray-900">{{ $produk->nama_produk }}</h3>
                        <p class="text-sm text-gray-500">{{ $produk->kategori->nama_kategori }}</p>
                        <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $produk->toko->nama_toko }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('produks.show', $produk->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 text-sm">Lihat</a>
                            <button class="btn-add-to-cart bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700 text-sm"
                                    data-produk-id="{{ $produk->id }}"
                                    data-produk-name="{{ $produk->nama_produk }}">
                                <i class="fas fa-cart-plus mr-1"></i>Keranjang
                            </button>
                            @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'member' && $produk->toko->id_user === auth()->id())))
                                <a href="{{ route('produks.edit', $produk->id) }}" class="bg-yellow-600 text-white px-3 py-1 rounded-md hover:bg-yellow-700 text-sm">Edit</a>
                            @endif
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <form action="{{ route('produks.destroy', $produk->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 text-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $produks->links() }}
            </div>
        </div>
    </main>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .btn-add-to-cart {
            transition: all 0.3s ease;
        }

        .btn-add-to-cart:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        // Add to cart functionality
        document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-produk-id');
                const productName = this.getAttribute('data-produk-name');

                // Add loading animation
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-cart-plus mr-1"></i>Menambahkan...';
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

                        // Show success message
                        this.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Ditambahkan!';
                        this.classList.remove('bg-green-600');
                        this.classList.add('bg-success');

                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.classList.remove('bg-success');
                            this.classList.add('bg-green-600');
                            this.disabled = false;
                        }, 2000);
                    } else {
                        alert(data.message || 'Gagal menambahkan ke keranjang');
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menambahkan ke keranjang');
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
            });
        });

        // Add notification when product is added
        document.addEventListener('DOMContentLoaded', function() {
            // Show notification if redirected from create
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('created')) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';
                notification.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Produk berhasil ditambahkan dan tersedia untuk siswa!';
                document.body.appendChild(notification);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
</body>
</html>
