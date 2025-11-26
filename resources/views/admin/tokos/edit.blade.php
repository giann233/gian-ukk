@extends('layouts.admin')

@section('header', 'Edit Toko')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Edit Toko') }}</h2>
        <a href="{{ route('admin.tokos.index') }}" class="btn btn-secondary">
            {{ __('Batal') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tokos.update', $toko->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_toko" class="form-label">{{ __('Nama Toko') }}</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{ old('nama_toko', $toko->nama_toko) }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">{{ __('Deskripsi') }}</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $toko->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">{{ __('Gambar Toko') }}</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                    @if($toko->gambar)
                        <small class="form-text text-muted">Gambar saat ini: <a href="{{ asset('storage/' . $toko->gambar) }}" target="_blank">Lihat</a></small>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="kontak_toko" class="form-label">{{ __('Kontak Toko') }}</label>
                    <input type="text" class="form-control" id="kontak_toko" name="kontak_toko" value="{{ old('kontak_toko', $toko->kontak_toko) }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $toko->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="id_user" class="form-label">{{ __('Pemilik Toko') }}</label>
                    <select class="form-select" id="id_user" name="id_user" required>
                        <option value="">Pilih Pemilik</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}" {{ old('id_user', $toko->id_user) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tokos.index') }}" class="btn btn-secondary me-2">{{ __('Batal') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
