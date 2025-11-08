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
        <!-- Floating WhatsApp Button -->
        @include('layout.users.wa')
        {{-- STAR HEADER --}}
        @include('layout.users.header')
    </div>

    <!-- about section -->

    <section class="about_section layout_padding">
        <div class="container  ">

            <div class="row">
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="{{ asset('assets-admin/img/Lovepik_com-401725292-old-man-selling-vegetables.png') }}"
                            alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                We Are BinaDesa
                            </h2>
                        </div>
                        <p>
                            UMKM BinaDesa hadir sebagai solusi atas tantangan yang dihadapi oleh pelaku usaha di
                            pedesaan,
                            seperti keterbatasan akses pasar, modal, dan pengetahuan digital. Website ini bukan sekadar
                            marketplace,
                            tetapi merupakan ekosistem yang komprehensif untuk memberdayakan, mempromosikan, dan
                            mengembangkan potensi
                            ekonomi desa.
                        </p>
                        <h2>
                            Visi
                        </h2>
                        <p>
                            Menjadi platform digital terdepan yang mendorong kemandirian ekonomi desa dan memperkenalkan
                            kekayaan produk UMKM lokal ke kancah nasional maupun global.
                        </p>
                        <h2>
                            Misi
                        </h2>
                        <p>
                            Misi kami adalah memberdayakan UMKM desa dengan memperluas pasar mereka secara online,
                            disertai dengan program pelatihan untuk peningkatan kapabilitas. Secara bersamaan, kami
                            berupaya melestarikan budaya lokal melalui promosi produk yang kaya cerita dan membangun
                            rantai pasok yang berkelanjutan untuk meningkatkan keuntungan para produsen.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- footer section -->
    @include('layout.users.footer')
    <!-- footer section -->

    <!-- jQery -->
    @include('layout.users.js1')

</body>

</html>
