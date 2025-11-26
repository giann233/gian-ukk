<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Toko') }}
            </h2>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <x-primary-button href="{{ route('tokos.create') }}">
                    {{ __('Tambah Toko Baru') }}
                </x-primary-button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 mx-6 mt-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="p-6">
                    <div class="mb-6">
                        <p class="text-gray-600">Temukan toko favorit Anda dan jelajahi berbagai produk menarik.</p>
                    </div>

                    @if($tokos->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada toko</h3>
                            <p class="mt-1 text-sm text-gray-500">Belum ada toko yang terdaftar di sistem.</p>
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="mt-6">
                                    <x-primary-button href="{{ route('admin.tokos.create') }}">
                                        {{ __('Buat Toko Pertama') }}
                                    </x-primary-button>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($tokos as $toko)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-200 overflow-hidden">
                                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                                    @if($toko->gambar)
                                        <img src="{{ asset('storage/' . $toko->gambar) }}" alt="{{ $toko->nama_toko }}"
                                             class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $toko->nama_toko }}</h3>
                                    <p class="text-sm text-gray-600 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $toko->user->name }}
                                    </p>
                                    <p class="text-gray-700 mb-4">{{ Str::limit($toko->deskripsi, 120) }}</p>

                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            {{ $toko->produks->count() }} produk
                                        </div>
                                        <x-primary-button href="{{ route('tokos.show', $toko->id) }}">
                                            {{ __('Kunjungi Toko') }}
                                        </x-primary-button>
                                    </div>

                                    @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'member' && $toko->id_user === auth()->id())))
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <div class="flex space-x-2">
                                                @php
                                                    $editRoute = auth()->user()->role === 'admin' ? 'admin.tokos.edit' : 'tokos.edit';
                                                    $destroyRoute = auth()->user()->role === 'admin' ? 'admin.tokos.destroy' : 'tokos.destroy';
                                                @endphp
                                                <x-secondary-button href="{{ route($editRoute, $toko->id) }}" class="flex-1">
                                                    {{ __('Edit') }}
                                                </x-secondary-button>
                                                @if(auth()->user()->role === 'admin')
                                                    <form action="{{ route($destroyRoute, $toko->id) }}" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus toko ini?')" class="w-full">
                                                            {{ __('Hapus') }}
                                                        </x-danger-button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $tokos->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
