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
    <link rel="shortcut icon" href="{{ asset('assets-admin/img/Untitled12_20251212083352.png') }}" type="">

    <title> UMKM Kami </title>

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

    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>UMKM Kami</h2>
            </div>

            {{-- Filter Menu --}}
            <ul class="filters_menu">
                <li class="active" data-filter="*">Semua</li>
                <li data-filter=".makanan-minuman">Makanan & Minuman</li>
                <li data-filter=".kerajinan-tangan">Kerajinan Tangan</li>
                <li data-filter=".pertanian">Pertanian</li>
                <li data-filter=".peternakan">Peternakan</li>
                <li data-filter=".jasa">Jasa</li>
                <li data-filter=".perdagangan">Perdagangan</li>
                <li data-filter=".industri-kecil">Industri Kecil</li>
                <li data-filter=".lainnya">Lainnya</li>
            </ul>

            <div class="filters-content">
                @if ($umkms->count() > 0)
                    <div class="row grid">
                        @foreach ($umkms as $umkm)
                            @php
                                // Map kategori ke class filter untuk isotope
                                $filterClass = match ($umkm->kategori) {
                                    'Makanan & Minuman' => 'makanan-minuman',
                                    'Kerajinan Tangan' => 'kerajinan-tangan',
                                    'Pertanian' => 'pertanian',
                                    'Peternakan' => 'peternakan',
                                    'Jasa' => 'jasa',
                                    'Perdagangan' => 'perdagangan',
                                    'Industri Kecil' => 'industri-kecil',
                                    default => 'lainnya',
                                };
                            @endphp

                            <div class="col-sm-6 col-lg-4 all {{ $filterClass }}">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            @if ($umkm->media->count() > 0)
                                                <img src="{{ asset('storage/' . $umkm->media->first()->file_nama) }}"
                                                    class="card-img-top" alt="{{ $umkm->nama_usaha }}"
                                                    style="height: 200px; object-fit: cover; width: 100%;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center"
                                                    style="height: 200px; width: 100%;">
                                                    <span class="text-muted">Tidak ada gambar</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="detail-box">
                                            <h5>{{ $umkm->nama_usaha }}</h5>
                                            <p>
                                                <strong>Pemilik:</strong>
                                                {{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}<br>
                                                <strong>Kategori:</strong> {{ $umkm->kategori }}<br>
                                                <strong>Kontak:</strong> {{ $umkm->kontak }}
                                            </p>
                                            <p class="small text-muted">
                                                {{ $umkm->deskripsi ? Str::limit($umkm->deskripsi, 100) : 'Tidak ada deskripsi' }}
                                            </p>
                                            <div class="options">
                                                <h6>{{ $umkm->kategori }}</h6>
                                                <a href="{{ route('umkm.show', $umkm->umkm_id) }}" class="view-icon">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- PAGINATION --}}
                    @if ($umkms->hasPages())
                        <section class="mt-4">
                            {{ $umkms->links('pagination::bootstrap-5') }}
                        </section>
                    @else
                        <section class="mt-4">
                            <small class="text-muted">
                                Menampilkan {{ $umkms->count() }} UMKM
                            </small>
                        </section>
                    @endif
                    {{-- END PAGINATION --}}
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
            </div>
        </div>
    </section>

    <!-- end about section -->
    @include('layout.users.footer')

    <!-- jQery -->
    @include('layout.users.js1')

</body>

</html>
