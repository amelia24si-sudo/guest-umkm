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

    <style>
        :root {
            --white: #ffffff;
            --black: #000000;
            --primary1: #ffbe33;
            --primary2: #222831;
            --textCol: #1f1f1f;
        }

        .cv-section {
            padding: 38px 0;
            background-color: var(--white);
            min-height: 100vh;
        }

        .layout-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header CV */
        .cv-header {
            text-align: center;
            margin-bottom: 50px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary1);
        }

        .cv-header h1 {
            color: var(--primary2);
            font-size: 2.8rem;
            margin-bottom: 10px;
        }

        .cv-header h2 {
            color: var(--primary1);
            font-size: 1.5rem;
            font-weight: 400;
        }

        /* Container Utama */
        .cv-container {
            display: flex;
            gap: 40px;
            background-color: var(--white);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Sidebar Kiri */
        .cv-sidebar {
            width: 35%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Bagian Foto */
        .photo-container {
            text-align: center;
        }

        .profile-photo {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid var(--primary1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
        }

        .photo-placeholder {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary1) 0%, var(--primary2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 5rem;
            border: 8px solid var(--primary1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            margin: 0 auto 20px;
        }

        /* Info Pribadi */
        .personal-info {
            background-color: rgba(255, 190, 51, 0.05);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid var(--primary1);
        }

        .info-item {
            margin-bottom: 20px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary2);
            font-size: 1rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-label i {
            color: var(--primary1);
        }

        .info-value {
            color: var(--textCol);
            font-size: 1.05rem;
            padding-left: 28px;
        }

        /* Social Links */
        .social-links {
            background-color: rgba(34, 40, 49, 0.03);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid var(--primary2);
        }

        .social-title {
            color: var(--primary2);
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 600;
            text-align: center;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary2);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background-color: var(--primary1);
            transform: translateY(-5px);
        }

        /* Konten Utama */
        .cv-content {
            width: 65%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Section Styling */
        .cv-section-item {
            margin-bottom: 30px;
        }

        .cv-section-item:last-child {
            margin-bottom: 0;
        }

        .section-title {
            color: var(--primary2);
            font-size: 1.8rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary1);
        }

        /* About Me */
        .about-text {
            color: var(--textCol);
            line-height: 1.8;
            font-size: 1.1rem;
            text-align: justify;
        }

        /* Education */
        .education-item {
            background-color: rgba(255, 190, 51, 0.05);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary1);
        }

        .education-item:last-child {
            margin-bottom: 0;
        }

        .education-title {
            color: var(--primary2);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .education-detail {
            color: var(--textCol);
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .education-year {
            color: var(--primary1);
            font-weight: 600;
        }

        /* Skills */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .skill-tag {
            background-color: var(--primary2);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            background-color: var(--primary1);
            transform: translateY(-3px);
        }

        /* Projects */
        .project-item {
            background-color: rgba(34, 40, 49, 0.03);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary2);
        }

        .project-item:last-child {
            margin-bottom: 0;
        }

        .project-title {
            color: var(--primary2);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .project-desc {
            color: var(--textCol);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .cv-container {
                flex-direction: column;
            }

            .cv-sidebar,
            .cv-content {
                width: 100%;
            }

            .profile-photo,
            .photo-placeholder {
                width: 200px;
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .cv-section {
                padding: 50px 0;
            }

            .cv-header h1 {
                font-size: 2.2rem;
            }

            .cv-container {
                padding: 25px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .social-icons {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 576px) {
            .cv-header h1 {
                font-size: 1.8rem;
            }

            .cv-header h2 {
                font-size: 1.2rem;
            }

            .profile-photo,
            .photo-placeholder {
                width: 150px;
                height: 150px;
            }

            .photo-placeholder {
                font-size: 3rem;
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

    <!-- CV Section -->
    <section class="cv-section layout_padding">
        <div class="layout-container">
            <!-- Header CV -->
            <div class="cv-header">
                <h1>Amelia Golisa</h1>
                <h2>Web Developer & Sistem Informasi</h2>
            </div>

            <!-- Container CV -->
            <div class="cv-container">
                <!-- Sidebar Kiri -->
                <div class="cv-sidebar">
                    <!-- Foto Profil -->
                    <div class="photo-container">
                        <!-- Jika ada foto -->
                        <img src="{{ asset('assets-admin/img/IMG_20251212_120321.jpg') }}" alt="Amelia Golisa" class="profile-photo">

                        <!-- Placeholder jika belum ada foto -->
                        {{-- <div class="photo-placeholder">
                            <i class="fas fa-user"></i>
                        </div> --}}
                        <h3 style="color: var(--primary2);">Amelia Golisa</h3>
                        <p style="color: var(--textCol);">Mahasiswa Politeknik Caltex Riau</p>
                    </div>

                    <!-- Info Pribadi -->
                    <div class="personal-info">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-id-card"></i>
                                <span>NIM</span>
                            </div>
                            <div class="info-value">2457301013</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Program Studi</span>
                            </div>
                            <div class="info-value">Sistem Informasi</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-envelope"></i>
                                <span>Email</span>
                            </div>
                            <div class="info-value">amelia.golisa@gmail.com</div>
                            <div class="info-value">amelia24si@mahasiswa.pcr.ac.id</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-phone"></i>
                                <span>Telepon</span>
                            </div>
                            <div class="info-value">+62-816-1669-4896</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Lokasi</span>
                            </div>
                            <div class="info-value">Kota Pekanbaru, Riau, Indonesia</div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="social-links">
                        <h3 class="social-title">Hubungi Saya</h3>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/amelia-amelia-8359173a0?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://github.com/amelia24si-sudo" target="_blank" class="social-icon">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://www.instagram.com/amel.lisa09?igsh=MXIzNzZjY29zdHpzOQ==" target="_blank" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Konten Utama -->
                <div class="cv-content">
                    <!-- Tentang Saya -->
                    <div class="cv-section-item">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Tentang Saya
                        </h3>
                        <p class="about-text">
                            Perkenalkan saya Amelia Golisa, seorang mahasiswa Politeknik Caltex Riau Pekanbaru dengan
                            latar belakang pendidikan Sistem Informasi. Memiliki passion dalam data analisis dan manajemen.
                            Berpengalaman dalam mengembangkan solusi digital untuk UMKM lokal seperti UMKM Kami, dengan tujuan
                            memberdayakan ekonomi desa melalui teknologi.
                        </p>
                    </div>

                    <!-- Pendidikan -->
                    <div class="cv-section-item">
                        <h3 class="section-title">
                            <i class="fas fa-graduation-cap"></i>
                            Pendidikan
                        </h3>
                        <div class="education-item">
                            <div class="education-title">Politeknik Caltex Riau</div>
                            <div class="education-detail">Mahasiswa Politeknik Caltex Riau</div>
                            <div class="education-year">2021 - Sekarang</div>
                        </div>
                        <div class="education-item">
                            <div class="education-title">SMA Kristen Kalam Kudus Pekanbaru</div>
                            <div class="education-detail">Jurusan Bahasa</div>
                            <div class="education-year">2018 - 2021</div>
                        </div>
                    </div>

                    <!-- Proyek -->
                    <div class="cv-section-item">
                        <h3 class="section-title">
                            <i class="fas fa-project-diagram"></i>
                            Proyek yang Dikembangkan
                        </h3>
                        <div class="project-item">
                            <div class="project-title">UMKM Kami - Platform UMKM Digital</div>
                            <p class="project-desc">
                                Mengembangkan website BinaDesa sebagai platform digital untuk memberdayakan UMKM
                                di pedesaan. Bertanggung jawab dalam frontend development dan user interface design.
                            </p>
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
