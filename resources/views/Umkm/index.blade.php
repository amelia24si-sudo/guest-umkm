@extends('layouts.app')
@section('title', 'Daftar UMKM')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2>Daftar UMKM Desa</h2>
        <p class="text-muted">Temukan berbagai usaha mikro, kecil, dan menengah di desa kita</p>
    </div>
</div>

<!-- Search Box -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari UMKM...">
            <button class="btn btn-primary" type="button">Cari</button>
        </div>
    </div>
</div>

<!-- UMKM List -->
<div class="row">
    @foreach($umkms as $umkm)
    <div class="col-md-6 col-lg-3">
        <div class="card card-umkm">
            @if($umkm['gambar'])
            <img src="https://via.placeholder.com/300x200/667eea/white?text={{ urlencode($umkm['nama_usaha']) }}"
                 class="card-img-top"
                 alt="{{ $umkm['nama_usaha'] }}">
            @else
            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                 style="height: 150px;">
                <span class="text-muted">No Image</span>
            </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $umkm['nama_usaha'] }}</h5>
                <p class="card-text">
                    <small class="text-muted">
                        <strong>Pemilik:</strong> {{ $umkm['pemilik'] }}<br>
                        <strong>Kategori:</strong> {{ $umkm['kategori'] }}<br>
                        <strong>Kontak:</strong> {{ $umkm['kontak'] }}
                    </small>
                </p>
                <p class="card-text small text-muted">
                    {{ Str::limit($umkm['deskripsi'], 80) }}
                </p>
                <a href="/umkm/detail/{{ $umkm['id'] }}" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

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
