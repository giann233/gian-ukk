@extends('layouts.admin')

@section('header', 'Tambah Toko Baru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Tambah Toko Baru') }}</h2>
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

            <form action="{{ route('admin.tokos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_toko" class="form-label">{{ __('Nama Toko') }}</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{ old('nama_toko') }}" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">{{ __('Deskripsi') }}</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">{{ __('Gambar Toko') }}</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="kontak_toko" class="form-label">{{ __('Kontak Toko') }}</label>
                    <input type="text" class="form-control" id="kontak_toko" name="kontak_toko" value="{{ old('kontak_toko') }}">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="id_user" class="form-label">{{ __('Pilih Member') }}</label>
                    <select class="form-select" id="id_user" name="id_user" required>
                        <option value="">Pilih Member</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.tokos.index') }}" class="btn btn-secondary me-2">{{ __('Batal') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
