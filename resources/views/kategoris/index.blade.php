<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Kategori</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Kategori</h1>
                <a href="{{ route('kategoris.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Tambah Kategori</a>
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

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @forelse($kategoris as $kategori)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center">
                                            <span class="text-white font-medium text-sm">{{ substr($kategori->nama_kategori, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $kategori->nama_kategori }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $kategori->produks->count() }} produk terkait
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('kategoris.show', $kategori->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 text-sm">Lihat</a>
                                    <a href="{{ route('kategoris.edit', $kategori->id) }}" class="bg-yellow-600 text-white px-3 py-1 rounded-md hover:bg-yellow-700 text-sm">Edit</a>
                                    <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li>
                        <div class="px-4 py-4 sm:px-6 text-center text-gray-500">
                            Belum ada kategori yang dibuat.
                        </div>
                    </li>
                    @endforelse
                </ul>
            </div>

            <div class="mt-8">
                {{ $kategoris->links() }}
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
    </style>
</body>
</html>
