<link rel="stylesheet" type="text/css" href="{{ asset('assets-admin/css/bootstrap.css') }}" />

<!--owl slider stylesheet -->
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<!-- nice select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
    integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
    crossorigin="anonymous" />

<!-- PERBAIKAN: Font Awesome dari CDN yang lengkap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<!-- Custom styles for this template -->
<link href="{{ asset('assets-admin/css/style.css') }}" rel="stylesheet" />
<!-- responsive style -->
<link href="{{ asset('assets-admin/css/responsive.css') }}" rel="stylesheet" />


<style>
    /* Style untuk button dropdown di user_option */
    .user_option {
        display: flex;
        align-items: center;
    }

    .user_dropdown {
        position: relative;
    }

    .btn-dropdown {
        background: #ffbe33;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        border: 1px solid #ffbe33;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-dropdown:hover {
        background: transparent;
        color: #ffbe33;
        border-color: #ffbe33;
    }

    .btn-dropdown:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
    }

    .btn-dropdown:active {
        transform: translateY(0);
    }

    .btn-dropdown::after {
        margin-left: 5px;
    }

    .user_dropdown_menu {
        right: 0;
        left: auto;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        border-radius: 12px;
        padding: 8px 0;
        min-width: 200px;
        margin-top: 10px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .user_dropdown_menu .dropdown-item {
        padding: 10px 20px;
        color: #333;
        display: flex;
        align-items: center;
        font-size: 14px;
        border: none;
    }

    /* Hapus semua hover effect untuk dropdown item */
    .user_dropdown_menu .dropdown-item:hover {
        background: transparent;
        color: #333;
        transform: none;
    }

    .user_dropdown_menu .dropdown-item i {
        width: 20px;
        text-align: center;
        margin-right: 10px;
    }

    .user_dropdown_menu .dropdown-header {
        padding: 8px 20px;
        font-size: 12px;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .user_dropdown_menu .dropdown-divider {
        margin: 8px 0;
        border-color: #eee;
    }

    /* Style untuk form logout */
    .user_dropdown_menu form {
        margin: 0;
    }

    .user_dropdown_menu .dropdown-item[type="submit"] {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .user_option {
            width: 100%;
            justify-content: center;
            margin-top: 15px;
        }

        .btn-dropdown {
            width: 100%;
            max-width: 250px;
            padding: 12px 25px;
        }

        .user_dropdown_menu {
            right: auto;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 250px;
        }
    }

    @media (max-width: 576px) {
        .btn-dropdown {
            font-size: 14px;
            padding: 10px 20px;
        }

        .user_dropdown_menu {
            min-width: 180px;
        }

        .user_dropdown_menu .dropdown-item {
            padding: 8px 15px;
            font-size: 13px;
        }
    }

    /* Animation untuk dropdown */
    .user_dropdown_menu {
        animation: fadeInDown 0.3s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* PERBAIKAN: Style untuk footer social icons */
    .footer_social {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .footer_social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .footer_social a:hover {
        background: #ffbe33;
        transform: translateY(-3px);
    }

    /* PERBAIKAN: Style untuk ikon di tombol WhatsApp */
    .btn1 a {
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .btn1 a:hover {
        color: white;
    }

    .view-icon,
    .contact_link_box {
        color: #fcfbf9;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .view-icon:hover {
        color: #0e0901;
        transform: scale(1.1);
    }

    /* PERBAIKAN: Style untuk footer social icons */
    .footer_social {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .footer_social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
        color: white;
        text-decoration: none;
        font-size: 18px;
    }

    .footer_social a:hover {
        background: #140e01;
        transform: translateY(-3px);
    }

    /* Hero Section */
    .hero_section {
        background-color: #222831;
        color: #ffffff;
        text-align: center;
        padding: 90px 0;
    }

    .hero_section h2 {
        font-family: 'Dancing Script', cursive;
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #ffffff;
    }

    .hero_section p {
        font-family: "Open Sans", sans-serif;
        font-size: 1.2rem;
        color: #b1b1b1;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Layanan Section */
    .layanan-utama,
    .layanan-tambahan,
    .proses-layanan {
        padding: 60px 0;
    }

    /* Layanan Utama Cards */
    .layanan-utama .card {
        transition: all 0.3s ease;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #dcdcdc;
        height: 100%;
    }

    .layanan-utama .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(34, 40, 49, 0.1);
    }

    .layanan-utama .card .card-body {
        padding: 2rem;
        text-align: center;
    }

    .layanan-utama .card i {
        color: #ffbe33;
        transition: transform 0.3s ease;
    }

    .layanan-utama .card:hover i {
        transform: scale(1.1);
    }

    .layanan-utama .card .card-title {
        font-family: "Open Sans", sans-serif;
        font-weight: 700;
        color: #222831;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .layanan-utama .card .card-text {
        line-height: 1.6;
        color: #1f1f1f;
    }

    /* Layanan Tambahan Cards */
    .layanan-tambahan .card {
        transition: all 0.3s ease;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #dcdcdc;
        height: 100%;
    }

    .layanan-tambahan .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(34, 40, 49, 0.1);
    }

    .layanan-tambahan .card .card-body {
        padding: 2rem;
    }

    .layanan-tambahan .card i {
        color: #ffbe33;
    }

    .layanan-tambahan .card .card-title {
        font-family: "Open Sans", sans-serif;
        font-weight: 700;
        color: #222831;
        font-size: 1.25rem;
        margin-bottom: 0;
    }

    .layanan-tambahan .d-flex i {
        color: #ffbe33;
    }

    .layanan-tambahan .card .card-text {
        line-height: 1.6;
        color: #1f1f1f;
        margin-bottom: 1.5rem;
    }

    .layanan-tambahan .card ul {
        padding-left: 0;
        list-style: none;
    }

    .layanan-tambahan .card ul li {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        color: #1f1f1f;
    }

    .layanan-tambahan .card ul li i {
        font-size: 0.9rem;
        margin-right: 0.5rem;
        color: #ffbe33;
    }

    /* Proses Layanan Section */
    .proses-layanan {
        padding: 60px 0;
    }

    .proses-layanan .card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #dcdcdc;
    }

    .proses-layanan .card .card-body {
        padding: 2.5rem 2rem;
    }

    .proses-layanan .card h4 {
        font-family: 'Dancing Script', cursive;
        color: #222831;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .proses-layanan .step-number {
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #ffbe33;
        color: #ffffff;
        width: 50px;
        height: 50px;
        margin-bottom: 1rem;
    }

    .proses-layanan h6 {
        font-family: "Open Sans", sans-serif;
        font-weight: 600;
        color: #222831;
        margin: 0 0 0.5rem 0;
        font-size: 1rem;
    }

    .proses-layanan small {
        font-size: 0.85rem;
        color: #1f1f1f;
        line-height: 1.4;
    }

    /* CTA Section */
    .cta-section {
        padding: 60px 0;
    }

    .cta-section .card {
        border-radius: 10px;
        background: #222831;
        border: none;
    }

    .cta-section .card .card-body {
        padding: 3rem 2rem;
        text-align: center;
    }

    .cta-section .card h3 {
        font-family: 'Dancing Script', cursive;
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
        color: #ffffff;
    }

    .cta-section .card p {
        font-size: 1.1rem;
        color:#ffffff ;
        margin-bottom: 2rem;
    }

    .cta-section .btn {
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: "Open Sans", sans-serif;
        font-size: 0.95rem;
        border: none;
    }

    .cta-section .btn-light {
        background-color: #000000;
        color: #ffbe33;
    }

    .cta-section .btn-light:hover {
        background-color: #ffbe33;
        border-color: #000000;
        transform: translateY(-2px);
        color: #222831;
    }

    .cta-section .btn-outline-light {
        border: 2px solid #ffbe33;
        color: #000000;
        background-color: transparent;
    }

    .cta-section .btn-outline-light:hover {
        background-color: #000000;
        color: #ffbe33;
        transform: translateY(-2px);
        border-color: #000000;
    }

    /* Remove all external colors */
    .text-primary,
    .text-success,
    .text-warning,
    .text-info,
    .text-purple,
    .bg-primary,
    .bg-success,
    .bg-warning,
    .bg-info {
        color: inherit !important;
        background-color: transparent !important;
    }

    /* Override Bootstrap colors */
    .text-primary {
        color: #ffbe33 !important;
    }

    .text-success {
        color: #ffbe33 !important;
    }

    .text-warning {
        color: #ffbe33 !important;
    }

    .text-info {
        color: #ffbe33 !important;
    }

    .bg-primary {
        background-color: #ffbe33 !important;
    }

    .bg-success {
        background-color: #ffbe33 !important;
    }

    .bg-warning {
        background-color: #ffbe33 !important;
    }

    .bg-info {
        background-color: #ffbe33 !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero_section h2 {
            font-size: 2.2rem;
        }

        .hero_section p {
            font-size: 1rem;
        }

        .layanan-utama .card-body,
        .layanan-tambahan .card-body {
            padding: 1.5rem;
        }

        .proses-layanan .card-body {
            padding: 2rem 1rem;
        }

        .proses-layanan h4 {
            font-size: 1.7rem;
        }

        .cta-section .card-body {
            padding: 2.5rem 1.5rem;
        }

        .cta-section h3 {
            font-size: 1.8rem;
        }

        .cta-section .btn {
            padding: 8px 20px;
            margin-bottom: 10px;
        }
    }

    @media (max-width: 576px) {
        .hero_section {
            padding: 60px 0;
        }

        .hero_section h2 {
            font-size: 1.8rem;
        }

        .layanan-utama,
        .layanan-tambahan,
        .proses-layanan,
        .cta-section {
            padding: 40px 0;
        }

        .cta-section .btn {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .cta-section .btn.me-3 {
            margin-right: 0;
        }

        .proses-layanan .step-number {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .layanan-utama .card-body,
        .layanan-tambahan .card-body {
            padding: 1.25rem;
        }
    }

    /* Animation Effects */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .layanan-utama .card,
    .layanan-tambahan .card,
    .proses-layanan .card,
    .cta-section .card {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Utility Classes */
    .mb-5 {
        margin-bottom: 3rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .text-center {
        text-align: center;
    }

    .shadow-sm {
        box-shadow: 0 2px 4px rgba(34, 40, 49, 0.1) !important;
    }

    .border-0 {
        border: none;
    }

    .h-100 {
        height: 100%;
    }
</style>
