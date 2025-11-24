@extends('layouts.admin')

@section('header', 'Dashboard Admin')

@section('content')
<style>
    .hero-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }
    .hero-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }
    .stats-card-custom {
        border-radius: 20px;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .stats-card-custom::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }
    .stats-card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    .stats-number {
        font-size: 2.8rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .product-card, .store-card {
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .product-card:hover, .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    .gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .gradient-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .gradient-info { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .gradient-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .gradient-purple { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .gradient-pink { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .overview-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 25px;
        box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
    }
    .overview-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .overview-item:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.25);
    }
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }
    .bounce-in {
        animation: bounceIn 1s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.3); }
        50% { opacity: 1; transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
    .pulse-glow {
        animation: pulseGlow 3s infinite;
    }
    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.4); }
        50% { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8); }
    }
</style>

<div class="container-fluid fade-in">
    <!-- Hero Welcome Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-card p-5 bounce-in">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3">🎉 Selamat Datang, {{ auth()->user()->name }}!</h1>
                        <p class="lead mb-4 opacity-90">Kelola marketplace sekolah dengan mudah melalui panel admin modern ini.</p>
                        <div class="d-flex gap-3">
                            <span class="badge bg-light text-dark fs-6 px-3 py-2">📊 Dashboard Interaktif</span>
                            <span class="badge bg-light text-dark fs-6 px-3 py-2">⚡ Real-time Updates</span>
                            <span class="badge bg-light text-dark fs-6 px-3 py-2">🎨 UI Modern</span>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="bi bi-speedometer2 display-1 opacity-75 pulse-glow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card-custom bg-primary text-white p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="mb-3 opacity-90">
                            <i class="bi bi-people me-2"></i>Total Users
                        </h5>
                        <div class="stats-number">{{ $totalUsers }}</div>
                        <small class="opacity-75">Pengguna terdaftar aktif</small>
                    </div>
                    <div class="ms-3">
                        <i class="bi bi-people-fill fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card-custom bg-success text-white p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="mb-3 opacity-90">
                            <i class="bi bi-shop me-2"></i>Total Toko
                        </h5>
                        <div class="stats-number">{{ $totalTokos }}</div>
                        <small class="opacity-75">Toko aktif berjualan</small>
                    </div>
                    <div class="ms-3">
                        <i class="bi bi-shop-window fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card-custom bg-info text-white p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="mb-3 opacity-90">
                            <i class="bi bi-box-seam me-2"></i>Total Produk
                        </h5>
                        <div class="stats-number">{{ $totalProduks }}</div>
                        <small class="opacity-75">Produk tersedia</small>
                    </div>
                    <div class="ms-3">
                        <i class="bi bi-box-seam-fill fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card-custom bg-warning text-white p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="mb-3 opacity-90">
                            <i class="bi bi-tags me-2"></i>Total Kategori
                        </h5>
                        <div class="stats-number">{{ \App\Models\Kategori::count() }}</div>
                        <small class="opacity-75">Kategori produk</small>
                    </div>
                    <div class="ms-3">
                        <i class="bi bi-tags-fill fs-1 opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Tables -->
    <div class="row g-4 mb-5">
        <!-- Recent Products -->
        <div class="col-lg-6">
            <div class="product-card bg-white">
                <div class="card-header gradient-primary text-white py-4">
                    <h4 class="card-title mb-0 fw-bold">
                        <i class="bi bi-box-seam-fill me-3"></i>🛍️ Produk Terbaru
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th class="py-3 ps-4">Produk</th>
                                    <th class="py-3">Harga</th>
                                    <th class="py-3 pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks->take(6) as $produk)
                                <tr class="align-middle">
                                    <td class="py-3 ps-4">
                                        <div class="d-flex align-items-center">
                                            @if($produk->gambarProduks->isNotEmpty())
                                                <img src="{{ asset('storage/' . $produk->gambarProduks->first()->nama_file) }}"
                                                     alt="" class="rounded-3 me-3 shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                                    <i class="bi bi-image text-muted fs-4"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark">{{ Str::limit($produk->nama_produk, 30) }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-tag me-1"></i>{{ $produk->kategori->nama_kategori }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge bg-success fs-6 px-3 py-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-3 pe-4">
                                        <a href="{{ route('produks.show', $produk) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-eye me-1"></i>Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-light text-center py-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('produks.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Produk
                            </a>
                            <a href="{{ route('produks.create') }}" class="btn btn-success rounded-pill px-4 py-2 fw-bold">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Stores -->
        <div class="col-lg-6">
            <div class="store-card bg-white">
                <div class="card-header gradient-success text-white py-4">
                    <h4 class="card-title mb-0 fw-bold">
                        <i class="bi bi-shop-fill me-3"></i>🏪 Toko Terbaru
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th class="py-3 ps-4">Toko</th>
                                    <th class="py-3">Pemilik</th>
                                    <th class="py-3 pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tokos->take(6) as $toko)
                                <tr class="align-middle">
                                    <td class="py-3 ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                                <i class="bi bi-shop text-white fs-4"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ Str::limit($toko->nama_toko, 30) }}</div>
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($toko->deskripsi, 35) }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 fw-semibold">{{ $toko->user->name }}</td>
                                    <td class="py-3 pe-4">
                                        <a href="{{ route('tokos.show', $toko) }}" class="btn btn-success btn-sm rounded-pill px-3">
                                            <i class="bi bi-eye me-1"></i>Lihat
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-light text-center py-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.tokos.index') }}" class="btn btn-success rounded-pill px-4 py-2 fw-bold">
                                <i class="bi bi-arrow-right-circle me-2"></i>Lihat Semua Toko
                            </a>
                            <a href="{{ route('tokos.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toko Requests Management -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="store-card bg-white">
                <div class="card-header gradient-purple text-white py-4">
                    <h4 class="card-title mb-0 fw-bold">
                        <i class="bi bi-envelope-fill me-3"></i>📋 Permintaan Toko Baru
                    </h4>
                </div>
                <div class="card-body p-0">
                    @php
                        $pendingRequests = \App\Models\TokoRequest::where('status', 'pending')->with('user')->get();
                        $totalPending = $pendingRequests->count();
                    @endphp

                    @if($totalPending > 0)
                        <div class="alert alert-warning mx-4 mt-4 rounded-pill">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>{{ $totalPending }} permintaan toko baru</strong> menunggu persetujuan Anda!
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-purple">
                                    <tr>
                                        <th class="py-3 ps-4">Nama Toko</th>
                                        <th class="py-3">Pemohon</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3 pe-4">Aksi Cepat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingRequests->take(5) as $request)
                                    <tr class="align-middle">
                                        <td class="py-3 ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-purple rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-shop text-white fs-5"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $request->nama_toko }}</div>
                                                    <small class="text-muted">{{ Str::limit($request->deskripsi, 40) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 fw-semibold">{{ $request->user->name }}</td>
                                        <td class="py-3">{{ $request->created_at->format('d/m/Y') }}</td>
                                        <td class="py-3 pe-4">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('toko_requests.show', $request->id) }}" class="btn btn-info btn-sm rounded-pill px-3" title="Lihat Detail">
                                                    <i class="bi bi-eye me-1"></i>Lihat
                                                </a>
                                                <form action="{{ route('toko_requests.approve', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3" onclick="return confirm('✅ Setujui permintaan toko ini?\n\nToko akan dibuat otomatis dan pemohon akan mendapat notifikasi.')" title="Setujui & Buat Toko">
                                                        <i class="bi bi-check-circle me-1"></i>Setujui
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" onclick="openRejectModal({{ $request->id }})" title="Tolak dengan Alasan">
                                                    <i class="bi bi-x-circle me-1"></i>Tolak
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-light text-center py-3">
                            <a href="{{ route('toko_requests.index') }}" class="btn btn-purple rounded-pill px-4 py-2 fw-bold">
                                <i class="bi bi-arrow-right-circle me-2"></i>Kelola Semua Permintaan ({{ $totalPending }} pending)
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-check-circle-fill text-success fs-1 mb-3"></i>
                            <h5 class="text-success fw-bold">Semua Permintaan Sudah Diproses! 🎉</h5>
                            <p class="text-muted">Tidak ada permintaan toko baru yang perlu ditinjau</p>
                            <a href="{{ route('toko_requests.index') }}" class="btn btn-outline-success rounded-pill px-4 py-2">
                                <i class="bi bi-list-check me-2"></i>Lihat Riwayat Permintaan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Tolak Permintaan Toko</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700">Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentRequestId = null;

        function openRejectModal(requestId) {
            currentRequestId = requestId;
            document.getElementById('rejectModal').style.display = 'block';
            document.getElementById('rejectForm').action = `/toko_requests/${requestId}/reject`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
            document.getElementById('admin_notes').value = '';
            currentRequestId = null;
        }
    </script>

    <!-- System Overview -->
    <div class="row">
        <div class="col-12">
            <div class="overview-section p-5">
                <h3 class="text-center mb-5 fw-bold">
                    <i class="bi bi-bar-chart-line-fill me-3"></i>📊 Ringkasan Sistem Lengkap
                </h3>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="overview-item text-center">
                            <i class="bi bi-graph-up-arrow-fill fs-1 mb-3 text-info"></i>
                            <h2 class="fw-bold mb-2">{{ $totalProduks }}</h2>
                            <p class="mb-0 opacity-90">Total Produk</p>
                            <small class="opacity-75">Barang yang dijual</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="overview-item text-center">
                            <i class="bi bi-shop-fill fs-1 mb-3 text-success"></i>
                            <h2 class="fw-bold mb-2">{{ $totalTokos }}</h2>
                            <p class="mb-0 opacity-90">Total Toko</p>
                            <small class="opacity-75">Penjual aktif</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="overview-item text-center">
                            <i class="bi bi-people-fill fs-1 mb-3 text-primary"></i>
                            <h2 class="fw-bold mb-2">{{ $totalUsers }}</h2>
                            <p class="mb-0 opacity-90">Total Users</p>
                            <small class="opacity-75">Pengguna sistem</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="overview-item text-center">
                            <i class="bi bi-tags-fill fs-1 mb-3 text-warning"></i>
                            <h2 class="fw-bold mb-2">{{ \App\Models\Kategori::count() }}</h2>
                            <p class="mb-0 opacity-90">Kategori</p>
                            <small class="opacity-75">Jenis produk</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

