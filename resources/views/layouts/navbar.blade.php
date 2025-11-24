<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="/">
            <i class="bi bi-shop me-2 fs-4"></i>
            <span class="fs-5">Marketplace Sekolah</span>
        </a>

        <!-- Toggle button (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>


        {{-- <div class="collapse navbar-collapse" id="navbarNav"> --}}

            <!-- List Menu -->
            <ul class="navbar-nav mx-auto fw-semibold">
                <li class="nav-item"><a class="nav-link" href="#makanan">Makanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#alat-tulis">Alat Tulis</a></li>
                <li class="nav-item"><a class="nav-link" href="#buku">Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="#elektronik">Elektronik</a></li>
                <li class="nav-item"><a class="nav-link" href="#tas">Tas Sekolah</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">

                <a href="{{ route('keranjang.index') }}" class="btn btn-outline-success position-relative">
                    <i class="bi bi-cart3 me-1"></i>Keranjang
                    <span class="cart-count badge bg-danger position-absolute top-0 start-100 translate-middle" id="cart-count">
                        {{ \App\Models\Keranjang::getCartCount() }}
                    </span>
                </a>

                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center px-3" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2 fs-5"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('toko_requests.index') }}">Permintaan Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.tokos.index') }}">Kelola Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.produks.index') }}">Kelola Produk</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('toko_requests.index') }}">Permintaan Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('tokos.my') }}">Toko Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('tokos.create') }}">Tambah Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('produks.create') }}">Tambah Produk</a></li>
                                <li><a class="dropdown-item" href="{{ route('tokos.index') }}">Lihat Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('produks.index') }}">Lihat Produk</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

                @else
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle px-4" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('login.siswa') }}">
                                <i class="bi bi-person me-2"></i>Login sebagai Siswa
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('login.member') }}">
                                <i class="bi bi-shop me-2"></i>Login sebagai Member
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.login') }}">
                                <i class="bi bi-shield me-2"></i>Login sebagai Admin
                            </a></li>
                        </ul>
                    </div>
                    <a href="{{ route('register') }}" class="btn btn-primary px-4">
                        <i class="bi bi-person-plus me-1"></i>Daftar Member
                    </a>
                @endauth

            </div>
        </div>

    </div>
</nav>
