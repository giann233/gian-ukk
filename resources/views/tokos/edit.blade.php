<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Toko</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Toko</h1>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg p-6">
                <form action="{{ route('tokos.update', $toko->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama_toko" class="block text-sm font-medium text-gray-700">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko" value="{{ old('nama_toko', $toko->nama_toko) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $toko->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Toko</label>
                        @if($toko->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                        <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>

                    <div class="mb-4">
                        <label for="kontak_toko" class="block text-sm font-medium text-gray-700">Kontak Toko</label>
                        <input type="text" name="kontak_toko" id="kontak_toko" value="{{ old('kontak_toko', $toko->kontak_toko) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('alamat', $toko->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('tokos.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 mr-2">Batal</a>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
