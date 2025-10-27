<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/umkm">
            <strong>UMKM DESA</strong>
        </a>
        <div class="navbar-nav">
            <a class="nav-link" href="/umkm">Beranda</a>
            <a class="nav-link" href="/login">Login UMKM</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent">Log Out</button>
            </form>
        </div>
    </div>
</nav>
