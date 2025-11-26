@extends('layouts.admin')

@section('header', 'Daftar Kategori')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">{{ __('Daftar Kategori') }}</h2>
        <a href="{{ route('admin.kategoris.create') }}" class="btn btn-primary">
            {{ __('Tambah Kategori') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($kategoris->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted">Belum ada kategori yang dibuat.</p>
                </div>
            @else
                <div class="list-group list-group-flush">
                    @foreach($kategoris as $kategori)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-bold">{{ $kategori->nama_kategori }}</div>
                            <small class="text-muted">{{ $kategori->produks->count() }} produk terkait</small>
                        </div>
                        <div>
                            <a href="{{ route('admin.kategoris.show', $kategori->id) }}" class="btn btn-sm btn-info me-2">Lihat</a>
                            <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                            <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="mt-4">
        {{ $kategoris->links() }}
    </div>
</div>
@endsection
