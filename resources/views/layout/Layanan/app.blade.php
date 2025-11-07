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
        <!-- header section strats -->
        @include('layout.users.header')
        <!-- end header section -->
    </div>

    <section class="hero_section layout_padding">
        <div class="container">
        <h2>Layanan UMKM Desa Kita</h2>
        <p >Berbagai layanan yang kami sediakan untuk mendukung perkembangan UMKM desa</p>
    </div>
    </section>

    <!-- Layanan Utama -->
    <section class="layanan-utama mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-store fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Pendaftaran UMKM</h5>
                            <p class="card-text text-muted">
                                Daftarkan usaha Anda secara gratis untuk mendapatkan akses ke berbagai program
                                dan bantuan dari pemerintah desa.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-chart-line fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Pelatihan Bisnis</h5>
                            <p class="card-text text-muted">
                                Ikuti berbagai pelatihan dan workshop untuk meningkatkan kemampuan
                                manajemen bisnis dan pemasaran produk.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center border-0 shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-hand-holding-usd fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Bantuan Modal</h5>
                            <p class="card-text text-muted">
                                Akses informasi tentang program bantuan modal usaha dari pemerintah
                                dan lembaga keuangan mitra.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Tambahan -->
    <section class="layanan-tambahan mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-truck fa-2x text-info me-3"></i>
                                <h5 class="card-title mb-0">Distribusi & Logistik</h5>
                            </div>
                            <p class="card-text text-muted">
                                Fasilitas pendistribusian produk ke pasar yang lebih luas dengan
                                biaya terjangkau dan jaringan logistik yang terpercaya.
                            </p>
                            <ul class="list-unstyled text-muted">
                                <li><i class="fas fa-check text-success me-2"></i> Jaringan distribusi regional</li>
                                <li><i class="fas fa-check text-success me-2"></i> Kemasan produk standar</li>
                                <li><i class="fas fa-check text-success me-2"></i> Bantuan transportasi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-digital-tachograph fa-2x"></i>
                                <h5 class="card-title mb-0">Digitalisasi UMKM</h5>
                            </div>
                            <p class="card-text text-muted">
                                Bantuan dalam transformasi digital termasuk pembuatan website,
                                media sosial, dan platform e-commerce untuk pemasaran online.
                            </p>
                            <ul class="list-unstyled text-muted">
                                <li><i class="fas fa-check text-success me-2"></i> Pembuatan website UMKM</li>
                                <li><i class="fas fa-check text-success me-2"></i> Pelatihan digital marketing</li>
                                <li><i class="fas fa-check text-success me-2"></i> Akses platform e-commerce</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Proses Layanan -->
    <section class="proses-layanan mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <h4 class="text-center mb-4">Cara Mendapatkan Layanan</h4>
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                        style="width: 50px; height: 50px;">
                                        1
                                    </div>
                                    <h6>Daftar UMKM</h6>
                                    <small class="text-muted">Registrasi usaha Anda di sistem</small>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                        style="width: 50px; height: 50px;">
                                        2
                                    </div>
                                    <h6>Verifikasi Data</h6>
                                    <small class="text-muted">Tim verifikasi akan memeriksa data</small>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="step-number bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                        style="width: 50px; height: 50px;">
                                        3
                                    </div>
                                    <h6>Pilih Layanan</h6>
                                    <small class="text-muted">Pilih layanan yang dibutuhkan</small>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="step-number bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2"
                                        style="width: 50px; height: 50px;">
                                        4
                                    </div>
                                    <h6>Dapatkan Bantuan</h6>
                                    <small class="text-muted">Terima bantuan dan pendampingan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="card bg-primary text-white">
                        <div class="card-body py-5">
                            <h3>Siap Mengembangkan Usaha Anda?</h3>
                            <p class="mb-4">Daftarkan UMKM Anda sekarang dan dapatkan akses ke semua layanan kami</p>
                            <a href="/login" class="btn btn-light btn-lg me-3">Daftar UMKM</a>
                            <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->
    @include('layout.users.footer')
    <!-- footer section -->

    <!-- jQery -->
    @include('layout.users.js')

</body>

</html>
