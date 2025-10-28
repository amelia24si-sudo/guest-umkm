@extends('layout.guest.app')

@section('title', $umkm->nama_usaha)

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">Semua UMKM</a></li>
        <li class="breadcrumb-item active">{{ $umkm->nama_usaha }}</li>
    </ol>
</nav>

<div class="row fade-in-up">
    <!-- Gambar dan Info Utama -->
    <div class="col-lg-4 mb-4">
        <!-- Profile Card -->
        <div class="card umkm-profile-card">
            <div class="card-body">
                @if($umkm->media->count() > 0)
                <img src="{{ asset('storage/' . $umkm->media->first()->file_url) }}"
                     class="card-img"
                     alt="{{ $umkm->nama_usaha }}">
                @else
                <div class="bg-custom-light rounded d-flex align-items-center justify-content-center"
                     style="height: 250px;">
                    <div class="text-center">
                        <i class="fas fa-store fa-3x text-custom-dark mb-3"></i>
                        <p class="text-muted">Tidak ada gambar</p>
                    </div>
                </div>
                @endif

                <h1 class="umkm-name">{{ $umkm->nama_usaha }}</h1>
                <span class="umkm-badge">{{ $umkm->kategori }}</span>
            </div>
        </div>

        <!-- Info Kontak -->
        <div class="card contact-card mt-4">
            <div class="card-header">
                <i class="fas fa-phone me-2"></i>Informasi Kontak
            </div>
            <div class="card-body">
                <div class="contact-info">
                    <strong>Pemilik</strong>
                    <p>{{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                </div>

                <div class="contact-info">
                    <strong>Alamat Usaha</strong>
                    <p>{{ $umkm->alamat }}, RT {{ $umkm->rt }}/RW {{ $umkm->rw }}</p>
                </div>

                <div class="contact-info">
                    <strong>Kontak</strong>
                    <p>{{ $umkm->kontak }}</p>
                </div>

                @php
                    $clean_phone = preg_replace('/[^0-9]/', '', $umkm->kontak);
                    if (substr($clean_phone, 0, 1) === '0') {
                        $clean_phone = '62' . substr($clean_phone, 1);
                    }
                @endphp
                <a href="https://wa.me/{{ $clean_phone }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20usaha%20Anda"
                   class="btn btn-success w-100 hover-lift" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Detail Informasi -->
    <div class="col-lg-8">
        <!-- Deskripsi -->
        <div class="card info-section mb-4">
            <div class="card-header">
                <i class="fas fa-info-circle me-2"></i>Deskripsi Usaha
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $umkm->deskripsi ?: 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <!-- Layanan/Jasa yang Ditawarkan -->
        <div class="card info-section mb-4">
            <div class="card-header">
                <i class="fas fa-concierge-bell me-2"></i>Layanan/Jasa yang Ditawarkan
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-2">{{ $umkm->kategori }}</span>
                    <small class="text-muted">Kategori utama usaha</small>
                </div>
            </div>
        </div>

        <!-- Informasi Pemilik -->
        <div class="card owner-info">
            <div class="card-header">
                <i class="fas fa-user me-2"></i>Informasi Pemilik
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <strong>Nama Lengkap</strong>
                            <p>{{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                        </div>

                        <div class="info-item">
                            <strong>Jenis Kelamin</strong>
                            @if(isset($umkm->pemilik->jenis_kelamin))
                                @if($umkm->pemilik->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @else
                                    <span class="badge bg-success">Perempuan</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>

                        <div class="info-item">
                            <strong>Agama</strong>
                            <p>{{ $umkm->pemilik->agama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <strong>Pekerjaan</strong>
                            <p>{{ $umkm->pemilik->pekerjaan ?? '-' }}</p>
                        </div>

                        <div class="info-item">
                            <strong>Telepon</strong>
                            <p>{{ $umkm->pemilik->telp ?? '-' }}</p>
                        </div>

                        <div class="info-item">
                            <strong>Alamat Tempat Tinggal</strong>
                            <p>{{ $umkm->alamat ?? '-' }}, RT {{ $umkm->rt ?? '-' }}/RW {{ $umkm->rw ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UMKM Lainnya -->
@if($umkmLainnya->count() > 0)
<div class="row mt-5 related-umkm-section">
    <div class="col-12">
        <h4 class="gradient-text">UMKM Lainnya</h4>
        <div class="row">
            @foreach($umkmLainnya as $umkmLain)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card related-card h-100">
                    @if($umkmLain->media->count() > 0)
                        <img src="{{ asset('storage/' . $umkmLain->media->first()->file_url) }}"
                             class="card-img-top"
                             alt="{{ $umkmLain->nama_usaha }}">
                    @else
                        <div class="card-img-top bg-custom-light d-flex align-items-center justify-content-center"
                             style="height: 140px;">
                            <i class="fas fa-store fa-2x text-custom-dark"></i>
                        </div>
                    @endif
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ Str::limit($umkmLain->nama_usaha, 30) }}</h6>
                        <span class="card-badge">{{ $umkmLain->kategori }}</span>
                        <a href="{{ route('umkm.show', $umkmLain->umkm_id) }}"
                           class="btn btn-outline-primary btn-sm mt-3 w-100 hover-lift">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
