<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('assets-admin/img/favicon.png') }}" type="">

    <title> BinaDesa </title>

    {{-- START CSS --}}
    @include('layout.users.css')
    {{-- END CSS --}}
</head>

<body class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets-admin/img/portrait-person-working-dried-flowers-shop.jpg') }}" alt="">
        </div>
        <!-- Floating WhatsApp Button -->
        @include('layout.users.wa')

        {{-- STAR HEADER --}}
        @include('layout.users.header')
    </div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/umkm">Semua UMKM</a></li>
            <li class="breadcrumb-item active">{{ $umkm->nama_usaha }}</li>
        </ol>
    </nav>

    <section class="row fade-in-up">
        <!-- Gambar dan Info Utama -->
        <section class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <section class="card umkm-profile-card">
                <section class="card-body">
                    @if ($umkm->media->count() > 0)
                        <img src="{{ asset('storage/' . $umkm->media->first()->file_url) }}" class="card-img"
                            alt="{{ $umkm->nama_usaha }}">
                    @else
                        <section class="bg-custom-light rounded d-flex align-items-center justify-content-center"
                            style="height: 250px;">
                            <section class="text-center">
                                <i class="fas fa-store fa-3x text-custom-dark mb-3"></i>
                                <p class="text-muted">Tidak ada gambar</p>
                            </section>
                        </section>
                    @endif

                    <h1 class="umkm-name">{{ $umkm->nama_usaha }}</h1>
                    <span class="umkm-badge">{{ $umkm->kategori }}</span>
                </section>
            </section>

            <!-- Info Kontak -->
            <section class="card contact-card mt-4">
                <section class="card-header">
                    <i class="fas fa-phone me-2"></i>Informasi Kontak
                </section>
                <section class="card-body">
                    <section class="contact-info">
                        <strong>Pemilik</strong>
                        <p>{{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                    </section>

                    <section class="contact-info">
                        <strong>Alamat Usaha</strong>
                        <p>{{ $umkm->alamat }}, RT {{ $umkm->rt }}/RW {{ $umkm->rw }}</p>
                    </section>

                    <section class="contact-info">
                        <strong>Kontak</strong>
                        <p>{{ $umkm->kontak }}</p>
                    </section>

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
                </section>
            </section>
        </section>

        <!-- Detail Informasi -->
        <section class="col-lg-8">
            <!-- Deskripsi -->
            <section class="card info-section mb-4">
                <section class="card-header">
                    <i class="fas fa-info-circle me-2"></i>Deskripsi Usaha
                </section>
                <section class="card-body">
                    <p class="mb-0">{{ $umkm->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                </section>
            </section>

            <!-- Layanan/Jasa yang Ditawarkan -->
            <section class="card info-section mb-4">
                <section class="card-header">
                    <i class="fas fa-concierge-bell me-2"></i>Layanan/Jasa yang Ditawarkan
                </section>
                <section class="card-body">
                    <section class="d-flex align-items-center">
                        <span class="badge bg-primary me-2">{{ $umkm->kategori }}</span>
                        <small class="text-muted">Kategori utama usaha</small>
                    </section>
                </section>
            </section>

            <!-- Informasi Pemilik -->
            <section class="card owner-info">
                <section class="card-header">
                    <i class="fas fa-user me-2"></i>Informasi Pemilik
                </section>
                <section class="card-body">
                    <section class="row">
                        <section class="col-md-6">
                            <section class="info-item">
                                <strong>Nama Lengkap</strong>
                                <p>{{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                            </section>

                            <section class="info-item">
                                <strong>Jenis Kelamin</strong>
                                @if (isset($umkm->pemilik->jenis_kelamin))
                                    @if ($umkm->pemilik->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge bg-success">Perempuan</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </section>

                            <section class="info-item">
                                <strong>Agama</strong>
                                <p>{{ $umkm->pemilik->agama ?? '-' }}</p>
                            </section>
                        </section>
                        <section class="col-md-6">
                            <section class="info-item">
                                <strong>Pekerjaan</strong>
                                <p>{{ $umkm->pemilik->pekerjaan ?? '-' }}</p>
                            </section>

                            <section class="info-item">
                                <strong>Telepon</strong>
                                <p>{{ $umkm->pemilik->telp ?? '-' }}</p>
                            </section>

                            <section class="info-item">
                                <strong>Alamat Tempat Tinggal</strong>
                                <p>{{ $umkm->alamat ?? '-' }}, RT {{ $umkm->rt ?? '-' }}/RW {{ $umkm->rw ?? '-' }}
                                </p>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <!-- UMKM Lainnya -->
    @if ($umkmLainnya->count() > 0)
        <section class="row mt-5 related-umkm-section">
            <section class="col-12">
                <h4 class="gradient-text">UMKM Lainnya</h4>
                <section class="row">
                    @foreach ($umkmLainnya as $umkmLain)
                        <section class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <section class="card related-card h-100">
                                @if ($umkmLain->media->count() > 0)
                                    <img src="{{ asset('storage/' . $umkmLain->media->first()->file_url) }}"
                                        class="card-img-top" alt="{{ $umkmLain->nama_usaha }}">
                                @else
                                    <section
                                        class="card-img-top bg-custom-light d-flex align-items-center justify-content-center"
                                        style="height: 140px;">
                                        <i class="fas fa-store fa-2x text-custom-dark"></i>
                                    </section>
                                @endif
                                <section class="card-body text-center">
                                    <h6 class="card-title">{{ Str::limit($umkmLain->nama_usaha, 30) }}</h6>
                                    <span class="card-badge">{{ $umkmLain->kategori }}</span>
                                    <a href="{{ route('umkm.show', $umkmLain->umkm_id) }}"
                                        class="btn btn-outline-primary btn-sm mt-3 w-100 hover-lift">
                                        Lihat Detail
                                    </a>
                                </section>
                            </section>
                        </section>
                    @endforeach
                </section>
            </section>
        </section>
    @endif
    <!-- end about section -->
    @include('layout.users.footer')

    <!-- jQery -->
    @include('layout.users.js1')

</body>

</html>
