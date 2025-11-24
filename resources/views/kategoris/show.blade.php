<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Detail Kategori</h1>
                <a href="{{ route('kategoris.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Kembali</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $kategori->nama_kategori }}</h2>
                    <p class="text-gray-600">Kategori ini memiliki {{ $kategori->produks->count() }} produk terkait.</p>
                </div>

                @if($kategori->produks->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Produk dalam Kategori Ini</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($kategori->produks as $produk)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900">{{ $produk->nama_produk }}</h4>
                            <p class="text-sm text-gray-600">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Stok: {{ $produk->stok }}</p>
                            <p class="text-sm text-gray-600">Toko: {{ $produk->toko->nama_toko }}</p>
                            <a href="{{ route('produks.show', $produk->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail</a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Belum ada produk dalam kategori ini.</p>
                </div>
                @endif

                <div class="flex space-x-2">
                    <a href="{{ route('kategoris.edit', $kategori->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">Edit Kategori</a>
                    <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus Kategori</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
