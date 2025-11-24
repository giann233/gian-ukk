<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Detail User</h1>
                <a href="{{ route('users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Kembali</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="mb-6">
                    <div class="flex items-center">
                        <div class="h-20 w-20 rounded-full bg-indigo-500 flex items-center justify-center mr-6">
                            <span class="text-white font-medium text-2xl">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akun</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role</label>
                                <p class="mt-1 text-sm text-gray-900">{{ ucfirst($user->role) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bergabung Sejak</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($user->toko)
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Toko</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Toko</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->toko->nama_toko }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->toko->deskripsi }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kontak</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->toko->kontak_toko }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->toko->alamat }}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Status Toko</h3>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-exclamation-triangle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Belum memiliki toko</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>User ini belum membuat toko. Mereka dapat mengajukan permintaan toko melalui dashboard member.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($user->toko && $user->toko->produks->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Produk Toko ({{ $user->toko->produks->count() }} produk)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($user->toko->produks->take(6) as $produk)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900">{{ Str::limit($produk->nama_produk, 25) }}</h4>
                            <p class="text-sm text-gray-600">Kategori: {{ $produk->kategori->nama_kategori }}</p>
                            <p class="text-sm text-gray-600">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Stok: {{ $produk->stok }}</p>
                            <a href="{{ route('produks.show', $produk->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Detail</a>
                        </div>
                        @endforeach
                    </div>
                    @if($user->toko->produks->count() > 6)
                    <div class="mt-4 text-center">
                        <a href="{{ route('tokos.show', $user->toko->id) }}" class="text-blue-600 hover:text-blue-800">Lihat semua produk toko</a>
                    </div>
                    @endif
                </div>
                @endif

                <div class="flex space-x-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700">Edit User</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus User</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
</body>
</html>
