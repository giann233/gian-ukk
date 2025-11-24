<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Produk</h1>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('produks.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('id_kategori', $produk->id_kategori) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="0" step="0.01" required>
                    </div>

                    <div class="mb-4">
                        <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" min="0" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="id_toko" class="block text-sm font-medium text-gray-700">Toko</label>
                        <select name="id_toko" id="id_toko" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Pilih Toko</option>
                            @foreach($tokos as $toko)
                                <option value="{{ $toko->id }}" {{ old('id_toko', $produk->id_toko) == $toko->id ? 'selected' : '' }}>{{ $toko->nama_toko }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        @if($produk->gambarProduks->isNotEmpty())
                            <div class="mb-2 grid grid-cols-3 gap-2">
                                @foreach($produk->gambarProduks as $gambar)
                                    <img src="{{ asset('storage/' . $gambar->nama_file) }}" alt="Current Image" class="w-full h-24 object-cover rounded-md">
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gambar[]" id="gambar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" multiple>
                        <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin menambah gambar baru.</p>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('produks.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 mr-2">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
