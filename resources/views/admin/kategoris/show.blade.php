@extends('layouts.admin')

@section('header', 'Detail Kategori')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Detail Kategori') }}</h2>
        <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">
            {{ __('Kembali') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $kategori->nama_kategori }}</h3>
            <p class="text-muted">Dibuat pada: {{ $kategori->created_at->format('d M Y H:i') }}</p>

            @if($kategori->produks->isNotEmpty())
                <h4 class="mt-4 mb-3">Produk dalam Kategori Ini</h4>
                <div class="row">
                    @foreach($kategori->produks as $produk)
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
                                <p class="fw-bold text-primary">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <p class="text-muted">{{ $produk->toko->nama_toko }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">Belum ada produk dalam kategori ini.</p>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="btn btn-warning">Edit Kategori</a>
            </div>
        </div>
    </div>
</div>
@endsection
