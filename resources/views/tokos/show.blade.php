<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $toko->nama_toko }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">{{ $toko->nama_toko }}</h1>
                <a href="{{ route('tokos.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Kembali</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        @if($toko->gambar)
                            <img src="{{ asset('storage/' . $toko->gambar) }}" alt="{{ $toko->nama_toko }}" class="w-full h-64 object-cover rounded-md">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-md flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Informasi Toko</h2>
                        <p class="text-gray-600 mb-2"><strong>Pemilik:</strong> {{ $toko->user->name }}</p>
                        <p class="text-gray-600 mb-2"><strong>Deskripsi:</strong> {{ $toko->deskripsi }}</p>
                        <p class="text-gray-600 mb-2"><strong>Kontak:</strong> {{ $toko->kontak_toko }}</p>
                        <p class="text-gray-600 mb-2"><strong>Alamat:</strong> {{ $toko->alamat }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Produk di Toko Ini</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($toko->produks as $produk)
                        <div class="bg-gray-50 overflow-hidden shadow rounded-lg">
                            <div class="p-4">
                                @if($produk->gambarProduks->isNotEmpty())
                                    <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}" alt="{{ $produk->nama_produk }}" class="w-full h-32 object-cover rounded-md">
                                @else
                                    <div class="w-full h-32 bg-gray-200 rounded-md flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <h4 class="mt-2 text-lg font-medium text-gray-900">{{ $produk->nama_produk }}</h4>
                                <p class="text-sm text-gray-500">{{ $produk->kategori->nama_kategori }}</p>
                                <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <a href="{{ route('produks.show', $produk->id) }}" class="mt-2 inline-block bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700 text-sm">Lihat Detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
