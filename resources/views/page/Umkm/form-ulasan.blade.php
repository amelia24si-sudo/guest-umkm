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

    <title> Beri Ulasan - {{ $produk->nama_produk }} - BinaDesa </title>

    {{-- START CSS --}}
    @include('layout.users.css')
    <style>
        /* CSS untuk rating stars */
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
            font-size: 32px;
            color: #ddd;
            padding: 0 5px;
            transition: color 0.2s;
        }

        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: #ffc107;
        }

        /* CARD PRODUK FIXED HEIGHT */
        .product-card {
            background: #f8f9fa;
            min-height: 100px; /* FIXED MINIMUM HEIGHT */
            height: auto;
            overflow: hidden;
            margin-bottom: 20px;
        }

        /* Batasi panjang judul - 1 BARIS SAJA */
        .product-title {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
            line-height: 1.2;
            max-width: 100%;
        }

        /* Batasi nama UMKM - 1 BARIS */
        .umkm-name {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 14px;
            margin-bottom: 5px;
            color: #6c757d;
            line-height: 1.2;
        }

        /* Harga - PASTI 1 BARIS */
        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #28a745;
            margin: 0;
            line-height: 1.2;
        }

        /* Layout card - COMPACT */
        .product-card .card-body {
            padding: 15px 20px;
        }

        /* Row alignment */
        .product-card .row {
            margin: 0;
            align-items: center;
        }

        /* Kolom kiri - MAIN CONTENT */
        .product-card .col-md-8 {
            padding-right: 10px;
            width: 70%;
        }

        /* Kolom kanan - BADGE ONLY */
        .product-card .col-md-4 {
            padding-left: 10px;
            text-align: right;
            width: 30%;
        }

        /* Badge */
        .product-card .badge {
            font-size: 12px;
            padding: 5px 10px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .product-card {
                min-height: 90px;
            }

            .rating-input label {
                font-size: 24px;
                padding: 0 3px;
            }

            .product-title {
                font-size: 16px;
            }

            .umkm-name {
                font-size: 13px;
            }

            .product-price {
                font-size: 14px;
            }

            .product-card .card-body {
                padding: 12px 15px;
            }
        }

        /* Batasi panjang teks di ulasan */
        .ulasan-komentar {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 72px;
        }
    </style>
    {{-- END CSS --}}
</head>

<body class="sub_page">
    <section class="hero_area">
        <section class="bg-box">
            <img src="{{ asset('assets-admin/img/portrait-person-working-dried-flowers-shop.jpg') }}" alt="">
        </section>
        @include('layout.users.wa')
        @include('layout.users.header')
    </section>
<br>
    <section class="container fade-in-up">
        <section class="row justify-content-center">
            <section class="col-lg-8">
                <!-- Card Produk - FIXED HEIGHT -->
                <section class="card product-card">
                    <section class="card-body">
                        <section class="row">
                            <!-- KOLOM KIRI - CONTENT -->
                            <section class="col-md-8">
                                <!-- JUDUL - 1 BARIS -->
                                <h4 class="product-title" title="{{ $produk->nama_produk }}">
                                    {{ $produk->nama_produk }}
                                </h4>

                                <!-- NAMA UMKM - 1 BARIS -->
                                <p class="umkm-name mb-1" title="{{ $produk->umkm->nama_usaha }}">
                                    <i class="fas fa-store me-1"></i>
                                    {{ $produk->umkm->nama_usaha }}
                                </p>

                                <!-- HARGA - 1 BARIS -->
                                <h5 class="product-price">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </h5>
                            </section>

                            <!-- KOLOM KANAN - BADGE -->
                            <section class="col-md-4">
                                <span class="badge bg-primary">{{ $produk->umkm->kategori }}</span>
                            </section>
                        </section>
                    </section>
                </section>

                <!-- Form Ulasan -->
                <section class="card">
                    <section class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Beri Ulasan Produk</h5>
                    </section>
                    <section class="card-body">
                        @if(session('success'))
                            <section class="alert alert-success">
                                {{ session('success') }}
                            </section>
                        @endif

                        @if(session('error'))
                            <section class="alert alert-danger">
                                {{ session('error') }}
                            </section>
                        @endif

                        <form action="{{ route('umkm.tambah-ulasan', ['produk' => $produk->produk_id]) }}" method="POST">
                            @csrf

                            <!-- Rating -->
                            <section class="mb-4">
                                <label class="form-label fw-bold">Rating Produk</label>
                                <p class="text-muted small mb-3">Berikan penilaian dari 1 (sangat buruk) sampai 5 (sangat baik)</p>

                                <section class="rating-input mb-3">
                                    @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                           {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <label for="star{{ $i }}" title="{{ $i }} bintang">
                                        <i class="fas fa-star"></i>
                                    </label>
                                    @endfor
                                </section>

                                <section class="d-flex justify-content-between text-muted small">
                                    <span>Tidak Puas</span>
                                    <span>Sangat Puas</span>
                                </section>

                                @error('rating')
                                <section class="text-danger mt-2">{{ $message }}</section>
                                @enderror
                            </section>

                            <!-- Komentar -->
                            <section class="mb-4">
                                <label class="form-label fw-bold">Komentar</label>
                                <p class="text-muted small mb-3">Bagikan pengalaman Anda menggunakan produk ini</p>

                                <textarea name="komentar" class="form-control" rows="5"
                                          placeholder="Contoh: Produk berkualitas, pengiriman cepat, seller ramah...">{{ old('komentar') }}</textarea>

                                @error('komentar')
                                <section class="text-danger mt-2">{{ $message }}</section>
                                @enderror

                                <section class="form-text"><small><i>Komentar akan ditampilkan secara publik.</i></small></section>
                            </section>

                            <!-- Tombol -->
                            <section class="d-flex justify-content-between">
                                <a href="{{ route('umkm.show', $produk->umkm_id) }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali ke UMKM
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Kirim Ulasan
                                </button>
                            </section>
                        </form>
                    </section>
                </section>

                <!-- Ulasan Lainnya -->
                @if($produk->ulasan->count() > 0)
                <section class="card mt-4">
                    <section class="card-header">
                        <h5 class="mb-0"><i class="fas fa-comments me-2"></i>Ulasan Lainnya untuk Produk Ini</h5>
                    </section>
                    <section class="card-body">
                        @foreach($produk->ulasan->take(3) as $ulasan)
                        <article class="border-bottom pb-3 mb-3">
                            <section class="d-flex justify-content-between align-items-start mb-2">
                                <section>
                                    <strong>{{ $ulasan->warga->nama ?? 'Anonim' }}</strong>
                                    <section class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $ulasan->rating ? '' : '-o' }}"></i>
                                        @endfor
                                        <small class="text-muted ms-2">{{ $ulasan->created_at->format('d M Y') }}</small>
                                    </section>
                                </section>
                            </section>

                            @if($ulasan->komentar)
                            <p class="mb-0 ulasan-komentar">{{ $ulasan->komentar }}</p>
                            @if(strlen($ulasan->komentar) > 150)
                            <button type="button" class="btn btn-link btn-sm p-0 mt-1" onclick="this.previousElementSibling.style.webkitLineClamp='unset'; this.previousElementSibling.style.maxHeight='none'; this.remove()">
                                Baca selengkapnya
                            </button>
                            @endif
                            @else
                            <p class="text-muted mb-0"><i>Tidak ada komentar</i></p>
                            @endif
                        </article>
                        @endforeach

                        @if($produk->ulasan->count() > 3)
                        <section class="text-center">
                            <a href="{{ route('umkm.tampil-ulasan', ['produk' => $produk->produk_id]) }}"
                               class="btn btn-outline-primary">
                                Lihat Semua {{ $produk->ulasan->count() }} Ulasan
                            </a>
                        </section>
                        @endif
                    </section>
                </section>
                @endif
            </section>
        </section>
    </section>
<br>
    @include('layout.users.footer')
    @include('layout.users.js1')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-input input');

            stars.forEach(star => {
                star.addEventListener('change', function() {
                    const rating = this.value;
                    console.log('Rating selected:', rating);
                });
            });
        });
    </script>
</body>
</html>
