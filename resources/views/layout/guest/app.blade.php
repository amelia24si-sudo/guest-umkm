<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Bina Desa - @yield('title')</title>
    {{-- START CSS  --}}
    @include('layout.guest.css')
    {{-- END CSS  --}}
</head>

<body>
    {{-- START HEADER --}}
    @include('layout.guest.header')
    {{-- END HEADER  --}}

    {{-- START NAVBAR --}}
    @include('layout.guest.navbar')
    {{-- END NAVBAR --}}

    {{-- START CONTENT --}}
    <div class="container mt-4">
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
        @yield('content')
    </div>
    {{-- END CONTENT  --}}

    {{-- START FOOTER  --}}
    @include('layout.guest.footer')
    {{-- END FOOTER --}}

    {{-- START JS  --}}
    @include('layout.guest.js')
    {{-- END JS  --}}
</body>

</html>
