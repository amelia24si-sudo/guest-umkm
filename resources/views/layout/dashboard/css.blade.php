{{-- START CSS --}}
<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="{{ asset('assets-admin/lib/bootstrap-icons-1.4.1/font/bootstrap-icons.css') }}" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('assets-admin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets-admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('assets-admin/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('assets-admin/css/style.css') }}" rel="stylesheet">
{{-- END CSS  --}}
<style>
    .umkm-card {
        transition: transform 0.2s ease-in-out;
    }

    .umkm-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .card-img-top {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .warga-card {
        transition: transform 0.2s ease-in-out;
    }

    .warga-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .user-card {
        transition: transform 0.2s ease-in-out;
    }

    .user-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
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
</style>
