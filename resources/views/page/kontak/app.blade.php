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
    @if (session('success'))
        <section class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
        </section>
    @endif

    <section class="book_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Contact Us
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <form action="{{ route('kirim.pesan') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Nama Lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="subjek" class="form-label fw-bold">Subjek</label>
                                <input type="text" class="form-control @error('subjek') is-invalid @enderror"
                                    id="subjek" name="subjek" value="{{ old('subjek') }}"
                                    placeholder="Subject">
                                @error('subjek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pesan" class="form-label fw-bold">Pesan</label>
                                <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" rows="6"
                                     placeholder="Pesan">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3">
                                <button type="submit" class="btn1">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                                &ensp;
                                <button type="submit" class="btn1">
                                    <a href="https://wa.me/6281234567890?text=Halo%20UMKM%20Desa%2C%20saya%20ingin%20bertanya%20tentang%3A%0A%0A"
                                        target="_blank">
                                        <i class="fab fa-whatsapp me-2 "></i>WhatsApp
                                    </a>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map_container ">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layout.users.footer')
    <!-- footer section -->

    <!-- jQery -->
    @include('layout.users.js1')

</body>

</html>
