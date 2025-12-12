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
    @include('page.binadesa.index')
    <br>
    @include('layout.users.footer')
    <!-- footer section -->

    <!-- jQery -->
    @include('layout.users.js1')
</body>

</html>
