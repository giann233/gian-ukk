@extends('layouts.admin')

@section('header', 'Detail Toko')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Detail Toko') }}</h2>
        <a href="{{ route('admin.tokos.index') }}" class="btn btn-secondary">
            {{ __('Kembali') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    @if($toko->gambar)
                        <img src="{{ asset('storage/' . $toko->gambar) }}" alt="{{ $toko->nama_toko }}" class="img-fluid rounded">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3 class="card-title">{{ $toko->nama_toko }}</h3>
                    <p class="text-muted">
                        <i class="bi bi-person me-1"></i>{{ $toko->user->name }}
                    </p>
                    <p class="card-text">{{ $toko->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                    <p><strong>Kontak:</strong> {{ $toko->kontak_toko ?: 'Tidak ada kontak' }}</p>
                    <p><strong>Alamat:</strong> {{ $toko->alamat ?: 'Tidak ada alamat' }}</p>
                    <p><strong>Bergabung sejak:</strong> {{ $toko->created_at->format('d M Y') }}</p>
                </div>
            </div>

            @if($toko->produks->isNotEmpty())
                <h4 class="mb-3">Produk di Toko Ini</h4>
                <div class="row">
                    @foreach($toko->produks as $produk)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                @if($produk->gambarProduks->isNotEmpty())
                                    <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}" alt="{{ $produk->nama_produk }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                        <i class="bi bi-image text-muted fs-1"></i>
                                    </div>
                                @endif
                                <h5 class="card-title mt-2">{{ $produk->nama_produk }}</h5>
                                <p class="card-text">{{ Str::limit($produk->deskripsi, 100) }}</p>
                                <p class="text-muted">{{ $produk->kategori->nama_kategori }}</p>
                                <p class="fw-bold text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

            @if(auth()->check() && (auth()->user()->role === 'admin' || (auth()->user()->role === 'member' && $toko->id_user === auth()->id())))
                <div class="mt-4">
                    <a href="{{ route('admin.tokos.edit', $toko->id) }}" class="btn btn-warning">Edit Toko</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
