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
    <style>
        /* Tambahan CSS untuk rating stars */
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-input input {
            display: none;
        }

        .rating-input label {
            cursor: pointer;
            font-size: 1.5rem;
            color: #ddd;
            padding: 0 2px;
            transition: color 0.2s;
        }

        .rating-input label:hover,
        .rating-input label:hover~label,
        .rating-input input:checked~label {
            color: #ffc107;
        }

        .ulasan-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .ulasan-list .text-warning {
            color: #ffc107;
        }
    </style>
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

            {{-- <!-- PRODUK YANG DIJUAL - TAMBAHAN -->
            <section class="card info-section mb-4">
                <section class="card-header">
                    <i class="fas fa-box me-2"></i>Produk yang Dijual
                </section>
                <section class="card-body">
                    @if ($umkm->produk && $umkm->produk->where('status', 'aktif')->count() > 0)
                        <section class="row">
                            @foreach ($umkm->produk->where('status', 'aktif') as $produk)
                                <section class="col-md-6 mb-3">
                                    <section class="card h-100">
                                        <section class="card-body">
                                            <section class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title mb-0 fw-bold">{{ $produk->nama_produk }}</h6>
                                                <span class="badge bg-success">Rp
                                                    {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            </section>
                                            <section class="d-flex justify-content-between align-items-center">
                                                @php
                                                    $clean_phone = preg_replace('/[^0-9]/', '', $umkm->kontak);
                                                    if (substr($clean_phone, 0, 1) === '0') {
                                                        $clean_phone = '62' . substr($clean_phone, 1);
                                                    }
                                                    $whatsapp_message =
                                                        'Halo ' .
                                                        $umkm->nama_usaha .
                                                        ', saya ingin bertanya tentang produk ' .
                                                        $produk->nama_produk .
                                                        ' dengan harga Rp ' .
                                                        number_format($produk->harga, 0, ',', '.');
                                                @endphp
                                                <a href="https://wa.me/{{ $clean_phone }}?text={{ urlencode($whatsapp_message) }}"
                                                    class="btn btn-sm btn-outline-success" target="_blank">
                                                    <i class="fab fa-whatsapp me-1"></i> Pesan
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    @else
                        <section class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Belum ada produk yang tersedia</p>
                        </section>
                    @endif
                </section>
            </section>
            <!-- END PRODUK YANG DIJUAL --> --}}

            <!-- PRODUK YANG DIJUAL - TAMBAHAN -->
            <section class="card info-section mb-4">
                <section class="card-header">
                    <i class="fas fa-box me-2"></i>Produk yang Dijual
                </section>
                <section class="card-body">
                    @if ($umkm->produk && $umkm->produk->where('status', 'aktif')->count() > 0)
                        <section class="row">
                            @foreach ($umkm->produk->where('status', 'aktif') as $produk)
                                <section class="col-md-6 mb-3">
                                    <section class="card h-100">
                                        <section class="card-body">
                                            <section class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title mb-0 fw-bold">{{ $produk->nama_produk }}</h6>
                                                <span class="badge bg-success">Rp
                                                    {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            </section>

                                            <!-- Info Rating -->
                                            @if ($produk->ulasan->count() > 0)
                                                <section class="mb-3">
                                                    <div class="text-warning small">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="fas fa-star{{ $i <= $produk->average_rating ? '' : '-o' }}"></i>
                                                        @endfor
                                                        <span class="text-muted ms-2">
                                                            {{ number_format($produk->average_rating, 1) }}
                                                            ({{ $produk->ulasan->count() }} ulasan)
                                                        </span>
                                                    </div>
                                                </section>
                                            @endif

                                            <section class="d-flex justify-content-between align-items-center">
                                                @php
                                                    $clean_phone = preg_replace('/[^0-9]/', '', $umkm->kontak);
                                                    if (substr($clean_phone, 0, 1) === '0') {
                                                        $clean_phone = '62' . substr($clean_phone, 1);
                                                    }
                                                    $whatsapp_message =
                                                        'Halo ' .
                                                        $umkm->nama_usaha .
                                                        ', saya ingin bertanya tentang produk ' .
                                                        $produk->nama_produk .
                                                        ' dengan harga Rp ' .
                                                        number_format($produk->harga, 0, ',', '.');
                                                @endphp
                                                <a href="https://wa.me/{{ $clean_phone }}?text={{ urlencode($whatsapp_message) }}"
                                                    class="btn btn-sm btn-outline-success" target="_blank">
                                                    <i class="fab fa-whatsapp me-1"></i> Pesan
                                                </a>

                                                <!-- Tombol Beri Ulasan -->
                                                @auth
                                                    <a href="{{ route('umkm.form-ulasan', ['produk' => $produk->produk_id]) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-star me-1"></i> Beri Ulasan
                                                    </a>
                                                @else
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-star me-1"></i> Login untuk Ulas
                                                    </a>
                                                @endauth
                                            </section>
                                        </section>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    @else
                        <section class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">Belum ada produk yang tersedia</p>
                        </section>
                    @endif
                </section>
            </section>
            <!-- END PRODUK YANG DIJUAL -->

            <!-- ULASAN SEMUA PRODUK - DI SATUKAN -->
            @if ($umkm->produk->where('status', 'aktif')->count() > 0)
                <section class="card info-section mb-4">
                    <section class="card-header">
                        <i class="fas fa-star me-2"></i>Semua Ulasan Produk
                    </section>
                    <section class="card-body">
                        <!-- Daftar Ulasan Semua Produk -->
                        <section class="ulasan-list">
                            @php
                                // Kumpulkan semua ulasan dari semua produk aktif
                                $semuaUlasan = collect();
                                foreach ($umkm->produk->where('status', 'aktif') as $produk) {
                                    foreach ($produk->ulasan->take(2) as $ulasan) {
                                        $semuaUlasan->push(
                                            (object) [
                                                'produk_nama' => $produk->nama_produk,
                                                'ulasan' => $ulasan,
                                            ],
                                        );
                                    }
                                }
                                $semuaUlasan = $semuaUlasan->sortByDesc('ulasan.created_at')->take(6);
                            @endphp

                            @if ($semuaUlasan->count() > 0)
                                <div class="row">
                                    @foreach ($semuaUlasan as $item)
                                        <div class="col-md-6 mb-3">
                                            <article class="ulasan-item h-100">
                                                <section class="d-flex justify-content-between align-items-start mb-2">
                                                    <section>
                                                        <strong>{{ $item->ulasan->warga->nama ?? 'Anonim' }}</strong>
                                                        <div class="text-warning small">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fas fa-star{{ $i <= $item->ulasan->rating ? '' : '-o' }}"></i>
                                                            @endfor
                                                            <small
                                                                class="text-muted ms-2">{{ $item->ulasan->created_at->format('d M Y') }}</small>
                                                        </div>
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-box me-1"></i> {{ $item->produk_nama }}
                                                        </small>
                                                    </section>
                                                </section>

                                                @if ($item->ulasan->komentar)
                                                    <p class="mb-0 small">
                                                        {{ Str::limit($item->ulasan->komentar, 150) }}</p>
                                                @else
                                                    <p class="text-muted mb-0 small"><i>Tidak ada komentar</i></p>
                                                @endif
                                            </article>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Tombol Lihat Semua Ulasan -->
                                @if ($umkm->produk->where('status', 'aktif')->sum('ulasan.count') > 6)
                                    <section class="text-center mt-3">
                                        <a href="#" class="btn btn-outline-primary">
                                            Lihat Semua Ulasan
                                            ({{ $umkm->produk->where('status', 'aktif')->sum('ulasan.count') }})
                                        </a>
                                    </section>
                                @endif
                            @else
                                <section class="text-center py-4">
                                    <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Belum ada ulasan untuk produk UMKM ini.</p>
                                    <p class="text-muted small">Jadilah yang pertama memberikan ulasan!</p>
                                </section>
                            @endif
                        </section>
                    </section>
                </section>
            @endif
            <!-- END ULASAN SEMUA PRODUK -->

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
