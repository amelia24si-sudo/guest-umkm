<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('assets-admin/img/Untitled12_20251212083352.png') }}" type="">

    <title> UMKM Kami </title>

    {{-- START CSS --}}
    @include('layout.users.css')
    {{-- END CSS --}}

    <style>
        :root {
            --white: #ffffff;
            --black: #000000;
            --primary1: #ffbe33;
            --primary2: #222831;
            --textCol: #1f1f1f;
        }

        .div-layout-section {
            padding: 80px 0;
            background-color: var(--white);
        }

        .layout-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Parent Container Utama */
        .parent-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Baris Pertama: Div1 + Right Container */
        .first-row {
            display: flex;
            gap: 20px;
        }

        /* Container untuk Div2, Div3, Div4 */
        .right-container {
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Baris Atas (Div2 dan Div3) */
        .top-row {
            display: flex;
            gap: 20px;
            height: 320px;
        }

        /* Div Item Umum */
        .div-item {
            background-color: var(--white);
            border-radius: 12px;
        }

        .div-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-3px);
        }

        /* Div 1 - Gambar */
        .div1 {
            width: 40%;
            height: 650px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .img-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        /* Div 2 - Deskripsi */
        .div2 {
            width: calc(66.66% - 10px);
            background: rgba(255, 190, 51, 0.05);
            border-left: 5px solid var(--primary1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .div2 h2 {
            color: var(--primary2);
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .div2 p {
            line-height: 1.7;
            font-size: 1.05rem;
            color: var(--textCol);
        }

        /* Div 3 - Quote */
        .div3 {
            width: calc(33.33% - 10px);
            background-color: var(--primary2);
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .div3 i {
            font-size: 2.5rem;
            color: var(--primary1);
            margin-bottom: 15px;
        }

        .div3 p {
            font-size: 1.2rem;
            font-style: italic;
            line-height: 1.6;
        }

        /* Div 4 - Visi Misi */
        .div4 {
            height: 320px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .vision-mission-container {
            display: flex;
            height: 100%;
            gap: 25px;
        }

        .vision-box,
        .mission-box {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
        }

        .vision-box {
            background-color: rgba(255, 190, 51, 0.08);
            border-left: 4px solid var(--primary1);
        }

        .mission-box {
            background-color: rgba(34, 40, 49, 0.03);
            border-left: 4px solid var(--primary2);
        }

        .vision-box h3,
        .mission-box h3 {
            color: var(--primary2);
            margin-bottom: 15px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .vision-box h3 i {
            color: var(--primary1);
        }

        .mission-box h3 i {
            color: var(--primary2);
        }

        .vision-box p,
        .mission-box p {
            line-height: 1.7;
            font-size: 1.05rem;
            color: var(--textCol);
        }

        /* Div 5 - Stats (Baris Kedua) */
        .div5 {
            height: 240px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
            flex: 1;
            padding: 15px;
            border-radius: 10px;
            background-color: rgba(255, 190, 51, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 190, 51, 0.1);
        }

        .stat-number {
            display: block;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary2);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--textCol);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .first-row {
                flex-direction: column;
            }

            .div1 {
                width: 100%;
                height: 500px;
            }

            .right-container {
                width: 100%;
            }

            .top-row {
                flex-direction: column;
                height: auto;
            }

            .div2,
            .div3 {
                width: 100%;
                height: 250px;
            }

            .div4 {
                height: auto;
            }

            .vision-mission-container {
                flex-direction: column;
            }

            .div5 {
                height: auto;
            }

            .stats-container {
                flex-wrap: wrap;
            }

            .stat-item {
                flex: 0 0 calc(50% - 10px);
                margin-bottom: 15px;
            }
        }

        @media (max-width: 768px) {
            .div-layout-section {
                padding: 50px 0;
            }

            .div1 {
                height: 400px;
            }

            .div2 h2 {
                font-size: 1.7rem;
            }

            .vision-box h3,
            .mission-box h3 {
                font-size: 1.3rem;
            }

            .stat-item {
                flex: 0 0 100%;
            }

            .stat-number {
                font-size: 1.8rem;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets-admin/img/portrait-person-working-dried-flowers-shop.jpg') }}" alt="">
        </div>
        @include('layout.users.wa')
        @include('layout.users.header')
    </div>

    <!-- Layout Section -->
    <section class="div-layout-section layout_padding">
        <div class="layout-container">
            <div class="parent-container">
                <!-- Baris Pertama -->
                <div class="first-row">
                    <!-- Div 1 - Gambar -->
                    <div class="div-item div1">
                        <div class="img-container">
                            <img src="{{ asset('assets-admin/img/Lovepik_com-401725292-old-man-selling-vegetables.png') }}"
                                alt="UMKM Lokal">
                        </div>
                    </div>

                    <!-- Container Kanan -->
                    <div class="right-container">
                        <!-- Baris Atas (Div2 dan Div3) -->
                        <div class="top-row">
                            <!-- Div 2 - Deskripsi -->
                            <div class="div-item div2">
                                <h2>UMKM Kami</h2>
                                <p>
                                    UMKM Kami hadir sebagai solusi atas tantangan yang dihadapi oleh pelaku usaha di
                                    pedesaan, seperti keterbatasan akses pasar, modal, dan pengetahuan digital. Website
                                    ini bukan sekadar marketplace, tetapi merupakan ekosistem yang komprehensif untuk
                                    memberdayakan, mempromosikan, dan mengembangkan potensi ekonomi desa.
                                </p>
                            </div>

                            <!-- Div 3 - Quote -->
                            <div class="div-item div3">
                                <i class="fas fa-quote-left"></i>
                                <p>"Memberdayakan UMKM lokal berarti membangun ekonomi bangsa dari akar rumput."</p>
                            </div>
                        </div>

                        <!-- Div 4 - Visi Misi -->
                        <div class="div-item div4">
                            <div class="vision-mission-container">
                                <div class="vision-box">
                                    <h3><i class="fas fa-eye"></i> Visi</h3>
                                    <p>
                                        Menjadi platform digital terdepan yang mendorong kemandirian ekonomi desa dan
                                        memperkenalkan kekayaan produk UMKM lokal ke kancah nasional maupun global.
                                    </p>
                                </div>
                                <div class="mission-box">
                                    <h3><i class="fas fa-bullseye"></i> Misi</h3>
                                    <p>
                                        Memberdayakan UMKM Kami dengan memperluas pasar mereka secara online,
                                        disertai dengan program pelatihan untuk meningkatkan kapabilitas. Secara
                                        bersamaan, kami berupaya melestarikan budaya lokal melalui promosi produk.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Baris Kedua - Div5 Stats -->
                <div class="div-item div5">
                    <h3 style="color: var(--primary2); margin-bottom: 20px; font-size: 1.5rem;">Pencapaian Kami</h3>
                    <div class="stats-container">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">UMKM Terdaftar</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">85%</span>
                            <span class="stat-label">Peningkatan Penjualan</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Desa Terjangkau</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">1.2K+</span>
                            <span class="stat-label">Produk Unggulan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layout.users.footer')
    @include('layout.users.js1')

</body>
</html>
