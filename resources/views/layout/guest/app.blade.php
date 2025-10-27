<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Desa - @yield('title')</title>
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
