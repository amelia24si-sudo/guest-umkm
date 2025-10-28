@extends('layout.guest.app')
@section('title', 'Daftar UMKM')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2>Daftar UMKM Bina Desa</h2>
        <p class="text-muted">Temukan berbagai usaha mikro, kecil, dan menengah di desa kita</p>
    </div>
</div>

<!-- Search Box -->
<div class="row mb-4">
    <div class="col-md-6">
        <form action="{{ route('umkm.index') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Cari UMKM..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-end">
            <form action="{{ route('umkm.index') }}" method="GET" id="kategoriForm">
                <select class="form-select w-auto" name="kategori" onchange="document.getElementById('kategoriForm').submit()">
                    <option value="">Semua Kategori</option>
                    <option value="Makanan & Minuman" {{ request('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                    <option value="Kerajinan Tangan" {{ request('kategori') == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                    <option value="Pertanian" {{ request('kategori') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                    <option value="Peternakan" {{ request('kategori') == 'Peternakan' ? 'selected' : '' }}>Peternakan</option>
                    <option value="Jasa" {{ request('kategori') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                    <option value="Perdagangan" {{ request('kategori') == 'Perdagangan' ? 'selected' : '' }}>Perdagangan</option>
                    <option value="Industri Kecil" {{ request('kategori') == 'Industri Kecil' ? 'selected' : '' }}>Industri Kecil</option>
                    <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>
        </div>
    </div>
</div>

<!-- UMKM List -->
@if($umkms->count() > 0)
<div class="row">
    @foreach($umkms as $umkm)
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card card-umkm h-100">
            @if($umkm->media->count() > 0)
                <img src="{{ asset('storage/' . $umkm->media->first()->file_url) }}"
                     class="card-img-top"
                     alt="{{ $umkm->nama_usaha }}"
                     style="height: 200px; object-fit: cover;">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                     style="height: 200px;">
                    <span class="text-muted">Tidak ada gambar</span>
                </div>
            @endif

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $umkm->nama_usaha }}</h5>
                <p class="card-text">
                    <small class="text-muted">
                        <strong>Pemilik:</strong> {{ $umkm->pemilik->nama }}<br>
                        <strong>Kategori:</strong>
                        <span class="badge bg-info">{{ $umkm->kategori }}</span><br>
                        <strong>Kontak:</strong> {{ $umkm->kontak }}
                    </small>
                </p>
                <p class="card-text small text-muted flex-grow-1">
                    {{ $umkm->deskripsi ? Str::limit($umkm->deskripsi, 100) : 'Tidak ada deskripsi' }}
                </p>
                <div class="mt-auto">
                    <a href="{{ route('umkm.show', $umkm->umkm_id) }}" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="alert alert-info text-center">
            <h5>Tidak ada UMKM yang ditemukan</h5>
            <p class="mb-0">Belum ada data UMKM yang terdaftar di sistem.</p>
        </div>
    </div>
</div>
@endif

<!-- Info Section -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body text-center">
                <h4>Mari Dukung UMKM Lokal!</h4>
                <p class="mb-0">Dengan membeli produk UMKM, Anda turut membangun ekonomi desa dan menciptakan lapangan kerja</p>
            </div>
        </div>
    </div>
</div>
@endsection
