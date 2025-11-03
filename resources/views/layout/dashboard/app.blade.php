<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UMKM Bina Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    {{-- START CSS --}}
    @include('layout.dashboard.css')
    {{-- END CSS  --}}
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        {{-- START LOAD --}}
        @include('layout.dashboard.spinner')
        {{-- END LOAD  --}}


        {{-- START SIDEBAR --}}
        @include('layout.dashboard.sidebar')
        {{-- END SIDEBAR --}}

        <div class="content">
            <!-- Navbar Start -->
            @include('layout.dashboard.navbar')
            <!-- Navbar End -->

            <!-- Floating WhatsApp Button -->
            <div class="whatsapp-float">
                <div class="whatsapp-tooltip">
                    Hubungi Kami via WhatsApp
                </div>
                <a href="https://wa.me/6281234567890?text=Halo%20UMKM%20Desa%2C%20saya%20ingin%20bertanya%20tentang%20layanan%20UMKM"
                    class="whatsapp-btn" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>

            {{-- START CONTENT --}}
            @yield('content')
            {{-- END CONTENT --}}

            {{-- START FOOTER --}}
            @include('layout.dashboard.footer')
            {{-- END FOOTER  --}}
        </div>
    </div>

    <!-- START JS -->
    @include('layout.dashboard.js')
    {{-- END JS --}}
</body>

</html>
