    @extends('layouts.admin')

@section('header', 'Edit Kategori')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Edit Kategori') }}</h2>
        <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
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

            <form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">{{ __('Nama Kategori') }}</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary me-2">{{ __('Batal') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
