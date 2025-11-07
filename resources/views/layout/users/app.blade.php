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

<body>

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets-admin/img/hero-bg.jpg') }}" alt="">
        </div>
        {{-- STAR HEADER --}}
        @include('layout.users.header')
        {{-- END HEADER --}}

        <!-- slider section -->

        {{-- START CONTENT --}}
        @include('layout.users.index1')
    </div>

    @include('layout.users.index2')

    @include('layout.users.index3')

    @include('layout.users.index4')

    @include('layout.users.index5')

    @include('layout.users.index6')

   {{-- END CONTENT --}}

    {{-- START FOOTER --}}
    @include('layout.users.footer')
    {{-- END FOOTER --}}

    {{-- START JS --}}
    <!-- jQery -->
    @include('layout.users.js')
    {{-- END JS --}}
</body>

</html>
