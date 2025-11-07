<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <strong>UMKM BINA DESA</strong>
        </a>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->is('umkm') ? 'active' : '' }}" href="/">Beranda</a>
            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">Tentang</a>
            <a class="nav-link {{ request()->is('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan</a>
            <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
            @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Tambah Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="tambahUmkmDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('binadesa.index') }}">
                                <i class="fas fa-store me-2"></i>Tambah UMKM
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                <i class="fas fa-users me-2"></i>Kelola User
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('warga.index') }}">
                                <i class="fas fa-user-friends me-2"></i>Kelola Warga
                            </a>
                        </li>
                    </ul>
                </div>
            @endauth
            <!-- Simple Dropdown -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Akun
                </a>
                <ul class="dropdown-menu">
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item border-0 bg-transparent">Log Out</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="/login">Login</a></li>
                        <li><a class="dropdown-item" href="/register">Daftar</a></li>
                    @endauth
            </div>
        </div>
</nav>
