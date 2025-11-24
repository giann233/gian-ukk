<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Toko</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Toko</h1>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('tokos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Tambah Toko</a>
                @endif
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tokos as $toko)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-4">
                        @if($toko->gambar)
                            <img src="{{ asset('storage/' . $toko->gambar) }}" alt="{{ $toko->nama_toko }}" class="w-full h-32 object-cover rounded-md">
                        @else
                            <div class="w-full h-32 bg-gray-200 rounded-md flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <h3 class="mt-2 text-lg font-medium text-gray-900">{{ $toko->nama_toko }}</h3>
                        <p class="text-sm text-gray-500">{{ $toko->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ Str::limit($toko->deskripsi, 100) }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('tokos.show', $toko->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-md hover:bg-blue-700 text-sm">Lihat</a>
                            @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'member' && $toko->id_user === auth()->id())))
                                <a href="{{ route('tokos.edit', $toko->id) }}" class="bg-yellow-600 text-white px-3 py-1 rounded-md hover:bg-yellow-700 text-sm">Edit</a>
                            @endif
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <form action="{{ route('tokos.destroy', $toko->id) }}" method="POST" class="inline">
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
                {{ $tokos->links() }}
            </div>
        </div>
    </main>
</body>
</html>
