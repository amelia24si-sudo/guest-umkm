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
        {{-- STAR HEADER --}}
        @include('layout.users.header')
        {{-- END HEADER --}}
    </div>
    @yield('content')
    {{-- START FOOTER --}}
    @include('layout.users.footer')
    {{-- END FOOTER --}}

    {{-- START JS --}}
    <!-- jQery -->
    @include('layout.users.js')
    {{-- END JS --}}
</body>

</html>
