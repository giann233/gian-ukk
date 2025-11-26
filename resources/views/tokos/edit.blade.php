<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Toko') }}
            </h2>
            @php
                $indexRoute = auth()->user()->role === 'admin' ? 'admin.tokos.index' : 'tokos.index';
                $updateRoute = auth()->user()->role === 'admin' ? 'admin.tokos.update' : 'tokos.update';
            @endphp
            <x-secondary-button href="{{ route($indexRoute) }}">
                {{ __('Batal') }}
            </x-secondary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 mx-6 mt-6">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route($updateRoute, $toko->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="nama_toko" :value="__('Nama Toko')" />
                        <x-text-input id="nama_toko" class="block mt-1 w-full" type="text" name="nama_toko" :value="old('nama_toko', $toko->nama_toko)" required autofocus autocomplete="nama_toko" />
                        <x-input-error :messages="$errors->get('nama_toko')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <textarea id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="deskripsi" rows="4">{{ old('deskripsi', $toko->deskripsi) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="gambar" :value="__('Gambar Toko')" />
                        @if($toko->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $toko->gambar) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-md">
                            </div>
                        @endif
                        <input id="gambar" class="block mt-1 w-full" type="file" name="gambar" accept="image/*" />
                        <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kontak_toko" :value="__('Kontak Toko')" />
                        <x-text-input id="kontak_toko" class="block mt-1 w-full" type="text" name="kontak_toko" :value="old('kontak_toko', $toko->kontak_toko)" autocomplete="kontak_toko" />
                        <x-input-error :messages="$errors->get('kontak_toko')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <textarea id="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="alamat" rows="3">{{ old('alamat', $toko->alamat) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-secondary-button href="{{ route($indexRoute) }}" class="mr-4">
                            {{ __('Batal') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
