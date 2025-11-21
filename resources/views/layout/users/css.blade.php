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
    .proses-layanan,
    .cta-section {
        padding: 10px 0px;
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
        color: #222831;
    }

    .cta-section .card p {
        font-size: 1.1rem;
        color: #222831;
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

    /* UMKM */
    /* Sale & Revenue Section Styles */
    .container-fluid.pt-4.px-4 {
        padding: 90px 25px 0 25px;
    }

    .bg-light.rounded {
        background-color: #f8f9fa !important;
        border-radius: 10px !important;
        border: 1px solid #e9ecef;
    }

    .bg-light.rounded p.mb-2 {
        color: #6c757d;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .bg-light.rounded h6.mb-0 {
        color: #222831;
        font-size: 24px;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
    }

    /* Header Section without Background */
    .bg-light.text-center.rounded.p-4 {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .d-flex.align-items-center.justify-content-between.mb-4 {
        border-bottom: 2px solid #ffbe33;
        padding-bottom: 1rem;
        margin-bottom: 2rem !important;
    }

    .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
        color: #222831;
        font-size: 1.75rem;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
    }

    /* Tombol Tambah UMKM */
    .btn-primary {
        background-color: #ffbe33;
        border-color: #ffbe33;
        border-radius: 45px;
        padding: 10px 25px;
        font-weight: 600;
        text-transform: uppercase;
        transition: all 0.3s ease;
        color: #222831;
    }

    .btn-primary:hover {
        background-color: #e0a300;
        border-color: #e0a300;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 190, 51, 0.3);
        color: #222831;
    }

    /* Alert Styles */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 10px;
        border-left: 4px solid #28a745;
    }

    .alert-success .btn-close {
        padding: 0.75rem;
    }

    /* Filter Section Styles */
    .row.mb-4 {
        margin-bottom: 2rem !important;
    }

    /* Card Styles dengan Hover */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(34, 40, 49, 0.15);
    }

    .card.shadow-sm {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    }

    .card:hover .shadow-sm {
        box-shadow: 0 8px 25px rgba(34, 40, 49, 0.15) !important;
    }

    .card-img-top {
        border-radius: 0;
        transition: transform 0.3s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }

    .position-relative .bg-secondary {
        background-color: #6c757d !important;
    }

    .badge.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .card-body {
        padding: 1.5rem;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .card:hover .card-body {
        background-color: #fafafa;
    }

    .card-title {
        color: #222831;
        font-size: 1.25rem;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
        margin-bottom: 0.75rem;
    }

    .card-text {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-muted i {
        color: #ffbe33;
        width: 16px;
    }

    /* Button Group Styles */
    .btn-group {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        border-color: #ffbe33;
        color: #ffbe33;
        background-color: transparent;
        padding: 8px 12px;
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #ffbe33;
        border-color: #ffbe33;
        color: #ffffff;
    }

    .btn-outline-primary:first-child {
        border-radius: 8px 0 0 8px;
    }

    .btn-outline-primary:last-child {
        border-radius: 0 8px 8px 0;
    }

    /* Card Footer */
    .card-footer {
        background-color: #f8f9fa !important;
        border-top: 1px solid #e9ecef;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .card:hover .card-footer {
        background-color: #f1f3f4;
    }

    /* Empty State Styles */
    .text-center.py-5 {
        padding: 3rem 0 !important;
    }

    .text-center.py-5 .fa-store {
        color: #6c757d;
        opacity: 0.5;
    }

    .text-center.py-5 h5 {
        color: #6c757d;
        font-weight: 600;
        margin: 1rem 0 0.5rem 0;
    }

    .text-center.py-5 p {
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    /* Info Text */
    .text-muted small {
        font-size: 13px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid.pt-4.px-4 {
            padding: 75px 15px 0 15px;
        }

        .col-sm-6.col-xl-3 {
            margin-bottom: 1rem;
        }

        .bg-light.rounded {
            padding: 1.5rem !important;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
            padding-bottom: 1rem;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
            font-size: 1.5rem;
        }

        .btn-group.w-100 {
            flex-direction: column;
        }

        .btn-outline-primary {
            border-radius: 8px !important;
            margin-bottom: 0.5rem;
        }
    }

    @media (max-width: 576px) {

        .row.mb-4 .col-md-6,
        .row.mb-4 .col-md-3 {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1rem;
        }
    }

    /* ================= */
    /* Form Tambah UMKM Styles */
    .bg-light.rounded.p-4 {
        background-color: #f8f9fa !important;
        border-radius: 15px !important;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
        color: #222831;
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
    }

    /* Tombol Kembali */
    .btn-primary {
        background-color: #ffbe33;
        border-color: #ffbe33;
        border-radius: 45px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #222831;
    }

    .btn-primary:hover {
        background-color: #e0a300;
        border-color: #e0a300;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 190, 51, 0.3);
        color: #222831;
    }

    /* Alert Error Styles */
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        border-radius: 10px;
        border-left: 4px solid #dc3545;
        padding: 1rem 1.5rem;
    }

    .alert-danger ul {
        margin-bottom: 0;
    }

    .alert-danger li {
        font-size: 14px;
        line-height: 1.5;
    }

    /* Form Label Styles */
    .form-label {
        color: #222831;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    /* Form Control Styles */
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #222831;
    }

    .form-control:focus {
        border-color: #ffbe33;
        box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
        background-color: #fff;
    }

    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.7;
    }

    /* Textarea Styles */
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Small Text Helper */
    .text-muted {
        color: #6c757d !important;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Button Group Styles */
    .mb-3 .btn {
        margin-right: 10px;
        border-radius: 45px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        color: #fff;
    }

    /* Form Row Spacing */
    .row .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .col-md-6.mb-3,
    .col-md-3.mb-3 {
        margin-bottom: 1.5rem !important;
    }

    /* Required Field Indicator */
    .form-label:has(+ .form-control[required])::after,
    .form-label:has(+ .form-select[required])::after {
        content: " *";
        color: #dc3545;
    }

    /* Focus States for Interactive Elements */
    .form-control:hover,
    .form-select:hover {
        border-color: #adb5bd;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .bg-light.rounded.p-4 {
            padding: 1.5rem !important;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
            font-size: 1.25rem;
        }

        .mb-3 .btn {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            margin-right: 0;
        }

        .row .col-md-6,
        .row .col-md-3 {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {

        .form-control,
        .form-select {
            padding: 10px 12px;
            font-size: 16px;
        }

        input[type="file"].form-control {
            padding: 10px 12px;
        }
    }

    /* Animation for Form Elements */
    .form-control,
    .form-select {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Success State for Valid Fields */
    .form-control:valid:not(:focus) {
        border-color: #28a745;
        background-color: #f8fff9;
    }

    /* Error State for Invalid Fields */
    .form-control:invalid:not(:focus) {
        border-color: #dc3545;
        background-color: #fff5f5;
    }

    /* Custom Select Option Styling */
    .form-select option {
        padding: 10px;
        background-color: #fff;
        color: #222831;
    }

    .form-select option:hover {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    /* Detail UMKM Styles */
    .bg-light.rounded.p-4 {
        background-color: #f8f9fa !important;
        border-radius: 15px !important;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
        color: #222831;
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
    }

    /* Button Styles for Detail Page */
    .btn-primary {
        background-color: #ffbe33;
        border-color: #ffbe33;
        border-radius: 45px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #222831;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .btn-primary:hover {
        background-color: #e0a300;
        border-color: #e0a300;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 190, 51, 0.3);
        color: #222831;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 600;
    }

    /* Updated Card Header Colors */
    .card-header.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .card-header.bg-success {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .card-header.bg-info {
        background-color: #222831 !important;
        color: #ffffff !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Table Styles with Better Readability */
    .table-borderless {
        border: none;
    }

    .table-borderless tr {
        border-bottom: 1px solid #f1f1f1;
    }

    .table-borderless tr:last-child {
        border-bottom: none;
    }

    .table-borderless td {
        padding: 12px 8px;
        vertical-align: top;
    }

    .table-borderless td:first-child {
        font-weight: 600;
        color: #222831;
        width: 35%;
    }

    /* Improved text color for better readability */
    .table-borderless td:last-child {
        color: #444444;
        font-weight: 500;
    }

    .table-sm td {
        padding: 8px 6px;
    }

    /* Badge Styles - Updated Colors */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge.bg-info {
        background-color: #222831 !important;
        color: #ffffff;
    }

    .badge.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
        color: #fff;
    }

    /* Image Styles */
    .img-fluid.rounded {
        border-radius: 10px !important;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .img-fluid.rounded:hover {
        border-color: #ffbe33;
    }

    /* Empty State for Logo */
    .text-muted .fa-image {
        color: #dee2e6;
        margin-bottom: 10px;
    }

    .text-muted p {
        color: #666666;
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    /* Alert Styles */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 10px;
        border-left: 4px solid #28a745;
    }

    .alert-success .btn-close {
        padding: 0.75rem;
    }

    /* Improved Text Muted for better readability */
    .text-muted {
        color: #666666 !important;
        font-size: 13px;
        font-weight: 500;
    }

    /* Additional text color improvements */
    small.text-muted {
        color: #777777 !important;
        font-weight: 400;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .bg-light.rounded.p-4 {
            padding: 1.5rem !important;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
            font-size: 1.25rem;
        }

        .btn-primary {
            display: block;
            width: 100%;
            margin-right: 0;
        }

        .card-body {
            padding: 1rem;
        }

        .table-borderless td:first-child {
            width: 40%;
        }
    }

    @media (max-width: 576px) {

        .col-md-8,
        .col-md-4 {
            margin-bottom: 1.5rem;
        }

        .table-borderless td {
            padding: 8px 4px;
            display: block;
            width: 100% !important;
        }

        .table-borderless tr {
            border-bottom: 1px solid #f1f1f1;
            padding: 8px 0;
            display: block;
        }

        .table-borderless td:first-child {
            font-weight: 600;
            color: #222831;
            margin-bottom: 4px;
        }

        .table-borderless td:last-child {
            color: #444444;
        }
    }

    /* Animation */
    .card {
        animation: fadeInUp 0.6s ease-out;
    }

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

    /* Hover Effects */
    .card-header {
        transition: all 0.3s ease;
    }

    .card:hover .card-header {
        transform: translateY(-1px);
    }

    /* Custom spacing for button group */
    .d-flex.align-items-center.justify-content-between.mb-4 section {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* Form inline styles */
    form[style*="display:inline"] {
        display: inline !important;
    }

    /* Detail UMKM Styles */
    .bg-light.rounded.p-4 {
        background-color: #f8f9fa !important;
        border-radius: 15px !important;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
        color: #222831;
        font-size: 1.5rem;
        font-weight: 700;
        font-family: 'Open Sans', sans-serif;
        margin: 0;
    }

    /* Button Styles for Detail Page */
    .btn-primary {
        background-color: #ffbe33;
        border-color: #ffbe33;
        border-radius: 45px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #222831;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .btn-primary:hover {
        background-color: #e0a300;
        border-color: #e0a300;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 190, 51, 0.3);
        color: #222831;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        border: none;
        padding: 1rem 1.5rem;
        font-weight: 600;
    }

    /* Updated Card Header Colors - All Orange */
    .card-header.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .card-header.bg-success {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .card-header.bg-info {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Table Styles with Better Readability */
    .table-borderless {
        border: none;
    }

    .table-borderless tr {
        border-bottom: 1px solid #f1f1f1;
    }

    .table-borderless tr:last-child {
        border-bottom: none;
    }

    .table-borderless td {
        padding: 12px 8px;
        vertical-align: top;
    }

    .table-borderless td:first-child {
        font-weight: 600;
        color: #222831;
        width: 35%;
    }

    /* Improved text color - Dark gray instead of muted */
    .table-borderless td:last-child {
        color: #333333;
        font-weight: 500;
    }

    .table-sm td {
        padding: 8px 6px;
    }

    /* Badge Styles - All Orange */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge.bg-info {
        background-color: #ffbe33 !important;
        color: #222831;
    }

    .badge.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831;
    }

    .badge.bg-success {
        background-color: #ffbe33 !important;
        color: #222831;
    }

    /* Image Styles */
    .img-fluid.rounded {
        border-radius: 10px !important;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .img-fluid.rounded:hover {
        border-color: #ffbe33;
    }

    /* Empty State for Logo */
    .text-muted .fa-image {
        color: #ffbe33;
        margin-bottom: 10px;
        opacity: 0.7;
    }

    .text-muted p {
        color: #333333;
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }

    /* Alert Styles */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 10px;
        border-left: 4px solid #28a745;
    }

    .alert-success .btn-close {
        padding: 0.75rem;
    }

    /* Improved Text - No muted colors */
    .text-muted {
        color: #333333 !important;
        font-size: 13px;
        font-weight: 500;
    }

    /* Additional text color improvements */
    small.text-muted {
        color: #444444 !important;
        font-weight: 400;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .bg-light.rounded.p-4 {
            padding: 1.5rem !important;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .d-flex.align-items-center.justify-content-between.mb-4 h6.mb-0 {
            font-size: 1.25rem;
        }

        .btn-primary {
            display: block;
            width: 100%;
            margin-right: 0;
        }

        .card-body {
            padding: 1rem;
        }

        .table-borderless td:first-child {
            width: 40%;
        }
    }

    @media (max-width: 576px) {

        .col-md-8,
        .col-md-4 {
            margin-bottom: 1.5rem;
        }

        .table-borderless td {
            padding: 8px 4px;
            display: block;
            width: 100% !important;
        }

        .table-borderless tr {
            border-bottom: 1px solid #f1f1f1;
            padding: 8px 0;
            display: block;
        }

        .table-borderless td:first-child {
            font-weight: 600;
            color: #222831;
            margin-bottom: 4px;
        }

        .table-borderless td:last-child {
            color: #333333;
        }
    }

    /* Animation */
    .card {
        animation: fadeInUp 0.6s ease-out;
    }

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

    /* Hover Effects */
    .card-header {
        transition: all 0.3s ease;
    }

    .card:hover .card-header {
        transform: translateY(-1px);
    }

    /* Custom spacing for button group */
    .d-flex.align-items-center.justify-content-between.mb-4 section {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* Form inline styles */
    form[style*="display:inline"] {
        display: inline !important;
    }

    /* UMKM */

    /* WARGA */
    //* Warga Dashboard Specific Styles */

    /* Avatar Circle */
    .rounded-circle.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831 !important;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .card:hover .rounded-circle.bg-primary {
        transform: scale(1.05);
    }

    /* Badge Styles for Warga - Change green to orange */
    .badge.bg-primary {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .badge.bg-success {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .badge.bg-warning {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    .badge.bg-light {
        background-color: #f8f9fa !important;
        color: #222831 !important;
        border: 1px solid #dee2e6;
    }

    /* Warga Info Sections */
    .card-title {
        color: #222831;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .text-muted {
        color: #555555 !important;
        font-size: 13px;
        line-height: 1.4;
    }

    .text-muted i {
        color: #ffbe33;
        width: 14px;
    }

    .text-muted strong {
        color: #333333;
        font-weight: 600;
    }

    /* UMKM Badge List */
    .mb-3 .badge {
        font-size: 11px;
        padding: 4px 8px;
        margin-right: 4px;
        margin-bottom: 4px;
    }

    /* Empty State for Warga */
    .text-center.py-5 .fa-users {
        color: #dee2e6;
        opacity: 0.7;
    }

    .text-center.py-5 h5 {
        color: #6c757d;
        font-weight: 600;
        margin: 1rem 0 0.5rem 0;
    }

    .text-center.py-5 p {
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    /* Card Footer */
    .card-footer.bg-transparent {
        background-color: #f8f9fa !important;
        border-top: 1px solid #e9ecef;
        padding: 0.75rem 1.5rem;
    }

    .card:hover .card-footer.bg-transparent {
        background-color: #f1f3f4 !important;
    }

    /* Button Group for Warga */
    .btn-group.w-100 {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        border-color: #ffbe33;
        color: #ffbe33;
        background-color: transparent;
        padding: 6px 10px;
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #ffbe33;
        border-color: #ffbe33;
        color: #222831;
    }

    .btn-outline-primary:first-child {
        border-radius: 6px 0 0 6px;
    }

    .btn-outline-primary:last-child {
        border-radius: 0 6px 6px 0;
    }

    /* Warga Card Animation */
    .warga-card {
        animation: slideInUp 0.5s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design for Warga Cards */
    @media (max-width: 768px) {
        .col-xl-4.col-lg-6.col-md-6 {
            margin-bottom: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .d-flex.align-items-start.mb-3 {
            flex-direction: column;
            text-align: center;
        }

        .flex-grow-1.ms-3 {
            margin-left: 0 !important;
            margin-top: 1rem;
        }

        .btn-group.w-100 {
            flex-direction: column;
        }

        .btn-outline-primary {
            border-radius: 6px !important;
            margin-bottom: 2px;
        }
    }

    @media (max-width: 576px) {

        .row.mb-4 .col-md-4,
        .row.mb-4 .col-md-3,
        .row.mb-4 .col-md-2 {
            margin-bottom: 1rem;
        }

        .rounded-circle.bg-primary {
            width: 50px !important;
            height: 50px !important;
            font-size: 18px !important;
        }
    }

    /* Hover Effects Specific to Warga Cards */
    .card:hover .card-body {
        background-color: #fafafa;
    }

    /* Gender-specific icon colors */
    .fa-male.text-primary,
    .fa-female.text-primary,
    .fa-users.text-primary,
    .fa-store.text-primary {
        color: #ffbe33 !important;
    }

    /* Custom spacing for badge groups */
    .d-flex.flex-wrap.gap-1 {
        gap: 0.25rem !important;
    }

    /* Form inline styles for delete button */
    form[style*="display: inline-block"] {
        display: inline-block !important;
        width: 100%;
    }

    form[style*="display: inline-block"] button {
        width: 100%;
        border-radius: 0;
    }

    /* WARGA */

    /* USER */
    /* User Dashboard Specific Styles */

    /* User Avatar */
    .rounded-circle.bg-primary.text-white {
        background-color: #ffbe33 !important;
        color: #222831 !important;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .card:hover .rounded-circle.bg-primary.text-white {
        transform: scale(1.08);
    }

    /* User Status Badges */
    .badge.bg-success {
        background-color: #28a745 !important;
        color: #fff !important;
    }

    .badge.bg-info {
        background-color: #ffbe33 !important;
        color: #222831 !important;
    }

    /* User Card Specific Layout */
    .text-center .card-title {
        font-size: 1.2rem;
        margin-bottom: 0.25rem;
    }

    .text-center .text-muted {
        font-size: 0.9rem;
    }

    /* User Info Grid */
    .row.text-center .col-6 {
        padding: 0 5px;
    }

    .row.text-center .text-muted {
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    /* User Join Date Info */
    .d-flex.justify-content-between.align-items-center {
        border-bottom: 1px solid #f1f1f1;
        padding: 4px 0;
    }

    .d-flex.justify-content-between.align-items-center:last-child {
        border-bottom: none;
    }

    /* User Card Animation */
    .user-card {
        animation: fadeInScale 0.6s ease-out;
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(10px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* User Action Buttons */
    .btn-group.w-100 .btn-outline-primary {
        padding: 8px 12px;
        font-size: 0.875rem;
    }

    .btn-group.w-100 .btn-outline-primary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-group.w-100 .btn-outline-primary:disabled:hover {
        background-color: transparent;
        color: #ffbe33;
    }

    /* User Alert Icons */
    .alert-success .fa-check-circle {
        color: #28a745;
    }

    .alert-danger .fa-exclamation-circle {
        color: #dc3545;
    }

    /* User Empty State */
    .text-center.py-5 .fa-users {
        color: #dee2e6;
        opacity: 0.6;
    }

    .text-center.py-5 h5 {
        color: #6c757d;
        font-size: 1.25rem;
    }

    .text-center.py-5 p {
        color: #6c757d;
        font-size: 0.95rem;
    }

    /* Responsive Design for User Cards */
    @media (max-width: 768px) {
        .col-xl-4.col-lg-6.col-md-6.mb-4 {
            margin-bottom: 1rem;
        }

        .text-center.mb-3 .rounded-circle {
            width: 70px !important;
            height: 70px !important;
            font-size: 25px !important;
        }

        .card-body {
            padding: 1.25rem;
        }
    }

    @media (max-width: 576px) {

        .row.mb-4 .col-md-6,
        .row.mb-4 .col-md-3 {
            margin-bottom: 0.75rem;
        }

        .text-center.mb-3 .rounded-circle {
            width: 60px !important;
            height: 60px !important;
            font-size: 22px !important;
        }

        .btn-group.w-100 {
            flex-direction: column;
        }

        .btn-group.w-100 .btn-outline-primary {
            border-radius: 6px !important;
            margin-bottom: 2px;
        }
    }

    /* Hover Effects for User Cards */
    .card:hover .card-body {
        background-color: #fafafa;
    }

    /* Specific icon colors for user statistics */
    .fa-calendar-plus.text-primary {
        color: #ffbe33 !important;
    }

    /* UMKM Detail Page Specific Styles */

    /* Breadcrumb */
    .breadcrumb {
        background-color: transparent;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
    }

    .breadcrumb-item a {
        color: #ffbe33;
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: #e0a300;
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #222831;
        font-weight: 600;
    }

    /* Animation */
    .fade-in-up {
        animation: fadeInUpDetail 0.8s ease-out;
    }

    @keyframes fadeInUpDetail {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Profile Card */
    .umkm-profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 0 0.5rem;
    }

    .umkm-profile-card .card-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .bg-custom-light {
        background-color: #f8f9fa !important;
        padding: 2rem;
    }

    .text-custom-dark {
        color: #222831 !important;
    }

    .umkm-name {
        color: #222831;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 1rem 1rem 0.5rem 1rem;
        font-family: 'Open Sans', sans-serif;
    }

    .umkm-badge {
        background-color: #ffbe33;
        color: #222831;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0 1rem 1rem 1rem;
        display: inline-block;
    }

    /* Contact Card - White Header */
    .contact-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 0 0.5rem;
    }

    .contact-card .card-header {
        background-color: #ffffff !important;
        color: #222831 !important;
        border: none;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 2px solid #ffbe33;
    }

    .contact-card .card-body {
        padding: 1.5rem;
    }

    .contact-info {
        margin-bottom: 1.25rem;
        padding: 0 0.5rem;
    }

    .contact-info:last-child {
        margin-bottom: 1.5rem;
    }

    .contact-info strong {
        color: #222831;
        font-size: 0.95rem;
        display: block;
        margin-bottom: 0.25rem;
    }

    .contact-info p {
        color: #555555;
        margin: 0;
        font-size: 1rem;
    }

    /* WhatsApp Button */
    .btn-success {
        background-color: #25D366;
        border-color: #25D366;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 0 0.5rem;
    }

    .btn-success:hover {
        background-color: #128C7E;
        border-color: #128C7E;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    /* Info Item Styles */
    .info-item {
        margin-bottom: 1.25rem;
        padding: 0 0.5rem;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-item strong {
        color: #222831;
        font-size: 0.95rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .info-item p {
        color: #555555;
        margin: 0;
        font-size: 1rem;
    }

    /* Info Sections - White Headers */
    .info-section,
    .owner-info {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 0 0.5rem 1rem 0.5rem;
    }

    .info-section .card-header,
    .owner-info .card-header {
        background-color: #ffffff !important;
        color: #222831 !important;
        border: none;
        font-weight: 600;
        padding: 1rem 1.5rem;
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 2px solid #ffbe33;
    }

    .info-section .card-body,
    .owner-info .card-body {
        padding: 1.5rem;
    }

    .info-section .card-body p {
        color: #555555;
        line-height: 1.6;
        font-size: 1rem;
        padding: 0 0.5rem;
    }

    /* Related UMKM Section */
    .related-umkm-section {
        padding: 0 1rem;
    }

    .related-umkm-section h4 {
        color: #222831;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #ffbe33;
    }

    .related-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin: 0 0.5rem;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .related-card .card-img-top {
        height: 140px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .related-card .card-body {
        padding: 1.25rem;
    }

    .related-card .card-title {
        color: #222831;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .card-badge {
        background-color: #ffbe33;
        color: #222831;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .related-card .btn-outline-primary {
        border-color: #ffbe33;
        color: #ffbe33;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .related-card .btn-outline-primary:hover {
        background-color: #ffbe33;
        color: #222831;
    }

    /* Responsive Design for UMKM Detail */
    @media (max-width: 768px) {
        .umkm-name {
            font-size: 1.5rem;
            margin: 1rem 0.75rem 0.5rem 0.75rem;
        }

        .umkm-badge {
            margin: 0 0.75rem 1rem 0.75rem;
        }

        .contact-card .card-body,
        .info-section .card-body,
        .owner-info .card-body {
            padding: 1.25rem;
        }

        .related-card .card-img-top {
            height: 120px;
        }

        .breadcrumb {
            padding: 0.75rem 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb {
            font-size: 0.9rem;
            padding: 0.75rem 0.25rem;
        }

        .umkm-name {
            font-size: 1.3rem;
            margin: 1rem 0.5rem 0.5rem 0.5rem;
        }

        .umkm-badge {
            margin: 0 0.5rem 1rem 0.5rem;
        }

        .col-lg-4.mb-4,
        .col-lg-8 {
            margin-bottom: 1.5rem;
        }

        .related-card .card-body {
            padding: 1rem;
        }

        .contact-info,
        .info-item,
        .info-section .card-body p {
            padding: 0 0.25rem;
        }

        .umkm-profile-card,
        .contact-card,
        .info-section,
        .owner-info,
        .related-card {
            margin: 0 0.25rem;
        }

        .btn-success {
            margin: 0 0.25rem;
        }
    }

    /* Custom background for empty image state */
    .bg-custom-light.rounded {
        border-radius: 10px !important;
        margin: 0 0.5rem;
    }

    /* USER */

    /* Floating WhatsApp Button Styles */
    .whatsapp-float {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 1000;
    }

    .whatsapp-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        color: white;
        border-radius: 50%;
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
        text-decoration: none;
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    .whatsapp-btn:hover {
        background-color: #128C7E;
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
        color: white;
    }

    .whatsapp-btn i {
        font-size: 28px;
    }

    .whatsapp-tooltip {
        position: absolute;
        right: 70px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .whatsapp-float:hover .whatsapp-tooltip {
        opacity: 1;
        visibility: visible;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .whatsapp-float {
            bottom: 20px;
            right: 20px;
        }

        .whatsapp-btn {
            width: 55px;
            height: 55px;
        }

        .whatsapp-btn i {
            font-size: 24px;
        }

        .whatsapp-tooltip {
            display: none;
        }
    }

    /* Base Form Styles - Digunakan oleh form-control, form-select, dan btn-clear */
    .form-control,
    .form-select,
    .btn-clear .input-group-text {
        border: 2px solid #222831;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        color: #1f1f1f;
        transition: all 0.3s ease;
        background-color: #fff;
        font-family: inherit;
        line-height: 1.5;
        width: 100%;
        box-sizing: border-box;
        height: 46px;
        /* Height tetap untuk konsistensi */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Text alignment - SAMA untuk semua */
    .form-control,
    .form-select {
        text-align: left;
        /* Default text di kiri seperti normal */
    }

    /* Focus State untuk Form Elements */
    .form-control:focus,
    .form-select:focus {
        border-color: #ffbe33;
        box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
        background-color: #fff;
        outline: none;
    }

    /* Placeholder untuk Form Control */
    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.7;
    }

    /* Khusus untuk Form Select - STYLE SAMA PERSIS dengan form-control */
    .form-select {
        background-position: right 15px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 45px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    /* Form Select saat focus - arrow juga berubah warna */
    .form-select:focus {}

    /* Option styling */
    .form-select option {
        padding: 8px 8px;
        background-color: #fff;
        color: #1f1f1f;
    }

    /* Khusus untuk Clear Button */
    .btn-clear {
        background-color: transparent;
        color: #222831;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
        min-width: 80px;
        white-space: nowrap;
        border-radius: 8px;
        border: #222831 2px solid;
    }

    .btn-clear:hover {
        background-color: #222831;
        border-color: #222831;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* Input Group Styles */
    .input-group-text {
        border: 2px solid #222831;
        border-left: none;
        background-color: #222831;
        color: #ffffff;
        border-radius: 0 8px 8px 0;
        padding: 12px 15px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group-text:hover {
        background-color: #3a4250;
        border-color: #3a4250;
    }

    /* Form Control dalam Input Group */
    .input-group .form-control {
        border-right: none;
        border-radius: 8px 0 0 8px;
    }

    /* Hover state untuk semua */
    .form-control:hover:not(:focus),
    .form-select:hover:not(:focus) {
        border-color: #3a4250;
    }

    /* Disabled state */
    .form-control:disabled,
    .form-select:disabled {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        opacity: 0.7;
    }

    /* Responsive Design */
    @media (max-width: 768px) {

        .form-control,
        .form-select,
        .btn-clear {
            padding: 10px 12px;
            font-size: 16px;
        }

        .form-select {
            padding-right: 40px;
            background-position: right 12px center;
        }

        .btn-clear {
            margin-left: 8px;
            min-width: 70px;
        }
    }

    /* Khusus untuk Input Group Text (Tombol Search) */
    .input-group-text {
        border-left: none;
        background-color: #222831;
        color: #ffffff;
        border-radius: 0 8px 8px 0;
        min-width: 46px;
        /* Sama dengan height */
        cursor: pointer;
        border-color: #222831;
    }

    .input-group-text:hover {
        background-color: #3a4250;
        border-color: #3a4250;
    }

    /* Form Control dalam Input Group */
    .input-group .form-control {
        border-right: none;
        border-radius: 8px 0 0 8px;
    }

    /* Input Group container */
    .input-group {
        display: flex;
        align-items: stretch;
        width: 100%;
    }

    /* Pagination Styles */
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 14px;
    color: #ffbe33;
    background-color: #fff;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
    display: block;
    line-height: 1.25;
}

/* Hover State */
.page-link:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
    color: #ffbe33;
}

/* Active State */
.page-item.active .page-link {
    background-color: #ffbe33;
    border-color: #ffbe33;
    color: #fff;
}

/* Disabled State */
.page-item.disabled .page-link {
    color: #9c9586;
    background-color: #fff;
    border-color: #dee2e6;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Focus State */
.page-link:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 196, 0, 0.25);
    outline: none;
}

/* Responsive Design */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-item {
        margin: 1px;
    }

    .page-link {
        padding: 6px 10px;
        font-size: 13px;
    }
}
</style>
