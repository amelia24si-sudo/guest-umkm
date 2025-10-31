<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <strong>UMKM BINA DESA</strong>
        </a>
        <div class="navbar-nav">
            <a class="nav-link {{ request()->is('umkm') ? 'active' : '' }}" href="/">Beranda</a>
            <a class="nav-link {{ request()->is('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan</a>
            <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
            <a class="nav-link" href="/login">Login UMKM</a>
            <a class="nav-link" href="/register">Daftar</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent">Log Out</button>
            </form>
        </div>
    </div>
</nav>
