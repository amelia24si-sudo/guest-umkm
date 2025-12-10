<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="/">
                <span>
                    BinaDesa
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('layanan') ? 'active' : '' }}"
                            href="{{ route('layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}"
                            href="{{ route('kontak') }}">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('umkm') ? 'active' : '' }}"
                            href="{{ route('umkm') }}">UMKM</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tambahUmkmDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            <i></i>Tambah Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tambahUmkmDropdown">
                            <!-- Header Section -->
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="fa fa-box text-primary me-2"></i>Produk
                                </h6>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('produk.index') }}">
                                    <i class="fa fa-plus me-2"></i>Tambah Produk
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- UMKM Section -->
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="fa fa-store text-warning me-2"></i>UMKM
                                </h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('binadesa.index') }}">
                                    <i class="fa fa-plus me-2"></i>Tambah UMKM
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Pesanan Section -->
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="fa fa-shopping-cart text-success me-2"></i>Pesanan
                                </h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('pesanan.index') }}">
                                    <i class="fa fa-plus me-2"></i>Tambah Pesanan
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- User Management Section -->
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="fa fa-users text-info me-2"></i>Pengguna
                                </h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('users.index') }}">
                                    <i class="fa fa-user-cog me-2"></i>Kelola User
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('warga.index') }}">
                                    <i class="fa fa-user-friends me-2"></i>Kelola Warga
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="user_option">
                    <!-- Dropdown Akun -->
                    <div class="nav-item dropdown user_dropdown">
                        <button class="btn btn-dropdown dropdown-toggle user_dropdown_toggle" type="button"
                            id="akunDropdown" data-toggle="dropdown" aria-expanded="false">
                            Daftar UMKM
                            <i class="fas fa-user ml-2"></i>
                        </button>
                        <ul class="dropdown-menu user_dropdown_menu" aria-labelledby="akunDropdown">
                            @auth
                                <li class="dropdown-header">
                                    <small>Halo, {{ Auth::user()->name }}</small>
                                </li>
                                <!-- Tambahkan link ke dashboard pesanan di dropdown -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item border-0 bg-transparent">
                                            <i class="fas fa-sign-in-alt me-2"></i>Log Out
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="/login">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/register">
                                        <i class="fas fa-sign-in-alt me-2"></i>Daftar
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
