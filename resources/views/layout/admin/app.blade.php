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
    @include('layout.admin.css')
    {{-- END CSS  --}}
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        {{-- START LOAD --}}
        @include('layout.admin.spinner')
        {{-- END LOAD  --}}


        {{-- START SIDEBAR --}}
        @include('layout.admin.sidebar')
        {{-- END SIDEBAR --}}

        <div class="content">
            <!-- Navbar Start -->
            @include('layout.admin.navbar')
            <!-- Navbar End -->

            {{-- START CONTENT --}}
            @yield('content')
            {{-- END CONTENT --}}

            {{-- START FOOTER --}}
            @include('layout.admin.footer')
            {{-- END FOOTER  --}}
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- START JS -->
    @include('layout.admin.js')
    {{-- END JS --}}
</body>

</html>
