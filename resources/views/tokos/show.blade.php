<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Toko') }}
            </h2>
            @php
                $indexRoute = auth()->user()->role === 'admin' ? 'admin.tokos.index' : 'tokos.index';
            @endphp
            <x-secondary-button href="{{ route($indexRoute) }}">
                {{ __('Kembali') }}
            </x-secondary-button>
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
                    <div class="flex items-center mb-6">
                        @if($toko->gambar)
                            <img src="{{ asset('storage/' . $toko->gambar) }}" alt="{{ $toko->nama_toko }}" class="w-32 h-32 object-cover rounded-lg mr-6">
                        @else
                            <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg flex items-center justify-center mr-6">
                                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $toko->nama_toko }}</h3>
                            <p class="text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $toko->user->name }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Informasi Toko</h4>
                            <div class="space-y-2">
                                <p><strong>Deskripsi:</strong> {{ $toko->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                                <p><strong>Kontak:</strong> {{ $toko->kontak_toko ?: 'Tidak ada kontak' }}</p>
                                <p><strong>Alamat:</strong> {{ $toko->alamat ?: 'Tidak ada alamat' }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Statistik</h4>
                            <div class="space-y-2">
                                <p><strong>Jumlah Produk:</strong> {{ $toko->produks->count() }}</p>
                                <p><strong>Bergabung sejak:</strong> {{ $toko->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($toko->produks->isNotEmpty())
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Produk di Toko Ini</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($toko->produks as $produk)
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        @if($produk->gambarProduks->isNotEmpty())
                                            <img src="{{ asset('storage/' . $produk->gambarProduks->first()->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-16 h-16 object-cover rounded mr-3">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center mr-3">
                                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h5 class="font-medium text-gray-900">{{ $produk->nama_produk }}</h5>
                                            <p class="text-sm text-gray-600">{{ $produk->kategori->nama_kategori }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700 mb-2">{{ Str::limit($produk->deskripsi, 100) }}</p>
                                    <p class="font-semibold text-indigo-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'member' && $toko->id_user === auth()->id())))
                        <div class="flex space-x-2 pt-6 border-t border-gray-200">
                            @php
                                $editRoute = auth()->user()->role === 'admin' ? 'admin.tokos.edit' : 'tokos.edit';
                            @endphp
                            <x-secondary-button href="{{ route($editRoute, $toko->id) }}">
                                {{ __('Edit Toko') }}
                            </x-secondary-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
