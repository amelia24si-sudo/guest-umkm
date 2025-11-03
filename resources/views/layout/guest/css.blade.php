<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    :root {
        --primary-light: #9FE7E7;
        --primary-medium: #6ECBD3;
        --background-light: #E8F8FF;
        --primary-dark: #289FB7;
        --secondary-dark: #146B8C;
        --text-dark: #0F1A1B;
        --whatsapp-green: #25D366;
        --whatsapp-dark: #128C7E;
    }

    body {
        background-color: var(--background-light);
        color: var(--text-dark);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }

    /* ===== HEADER ===== */
    .header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%239FE7E7" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
        background-size: cover;
    }

    .header h1 {
        font-weight: 700;
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .header .lead {
        font-size: 1.3rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* ===== NAVBAR ===== */
    .navbar {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%) !important;
        box-shadow: 0 4px 15px rgba(20, 107, 140, 0.2);
        padding: 0.8rem 0;
    }

    .navbar-brand {
        font-weight: 800;
        font-size: 1.8rem;
        color: white !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .navbar-nav .nav-link {
        color: white !important;
        font-weight: 500;
        padding: 0.5rem 1.2rem !important;
        margin: 0 0.2rem;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
    }

    .navbar-nav .nav-link.active {
        background-color: var(--primary-light);
        color: var(--text-dark) !important;
        font-weight: 600;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* ===== BREADCRUMB ===== */
    .breadcrumb {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--background-light) 100%);
        border-radius: 15px;
        padding: 1rem 1.5rem;
        border: 2px solid var(--primary-medium);
    }

    .breadcrumb-item a {
        color: var(--primary-dark);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--secondary-dark);
    }

    .breadcrumb-item.active {
        color: var(--text-dark);
        font-weight: 600;
    }

    /* ===== FOOTER ===== */
    /* Footer Styles */
    .footer {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--text-dark) 100%);
        color: white;
        padding: 50px 0 30px;
        margin-top: 80px;
    }

    .footer h5 {
        color: var(--primary-light);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .footer a.text-light {
        color: var(--primary-light) !important;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer a.text-light:hover {
        color: white !important;
        text-decoration: underline;
    }

    .footer hr {
        background-color: var(--primary-medium);
        height: 2px;
        opacity: 0.3;
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: none;
        border-radius: 15px;
        color: var(--text-dark);
        border-left: 5px solid #28a745;
    }

    .alert-info {
        background: linear-gradient(135deg, var(--background-light) 0%, var(--primary-light) 100%);
        border: none;
        border-radius: 15px;
        color: var(--text-dark);
        border-left: 5px solid var(--primary-dark);
    }

    .form-control {
        border: 2px solid var(--primary-light);
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 0.2rem rgba(40, 159, 183, 0.25);
    }

    .form-select {
        border: 2px solid var(--primary-light);
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 0.2rem rgba(40, 159, 183, 0.25);
    }


    /* Step Number Styles */
    .step-number {
        font-weight: bold;
        font-size: 1.3rem;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 4px 15px rgba(40, 159, 183, 0.3);
    }

    /* Accordion Styles */
    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, var(--background-light) 0%, var(--primary-light) 100%);
        color: var(--text-dark);
        font-weight: 600;
        border: none;
        box-shadow: none;
    }

    .accordion-button:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 0.2rem rgba(40, 159, 183, 0.25);
    }

    .accordion-item {
        border: 2px solid var(--primary-light);
        border-radius: 10px !important;
        margin-bottom: 1rem;
    }


    /* ===== CARD STYLES ===== */
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(20, 107, 140, 0.1);
        transition: all 0.4s ease;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(20, 107, 140, 0.15);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        color: white;
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* ===== UMKM PROFILE CARD ===== */
    .umkm-profile-card {
        text-align: center;
        border: 3px solid var(--primary-light);
    }

    .umkm-profile-card .card-img {
        border-radius: 15px 15px 0 0;
        height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .umkm-profile-card .umkm-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 1rem 0 0.5rem;
    }

    .umkm-profile-card .umkm-badge {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-medium) 100%);
        color: var(--text-dark);
        font-size: 0.9rem;
        font-weight: 600;
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        display: inline-block;
    }

    /* ===== CONTACT CARD ===== */
    .contact-card {
        border: 3px solid var(--primary-light);
    }

    .contact-info {
        margin-bottom: 1rem;
    }

    .contact-info:last-child {
        margin-bottom: 0;
    }

    .contact-info strong {
        color: var(--primary-dark);
        display: block;
        margin-bottom: 0.3rem;
    }

    .contact-info p {
        margin: 0;
        color: var(--text-dark);
        line-height: 1.5;
    }

    /* ===== BUTTON STYLES ===== */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(40, 159, 183, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 159, 183, 0.4);
        background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--primary-dark) 100%);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--whatsapp-green) 0%, var(--whatsapp-dark) 100%);
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        background: linear-gradient(135deg, var(--whatsapp-dark) 0%, var(--whatsapp-green) 100%);
    }

    .btn-outline-primary {
        border: 2px solid var(--primary-dark);
        color: var(--primary-dark);
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
    }

    /* ===== INFO SECTIONS ===== */
    .info-section {
        background: linear-gradient(135deg, #ffffff 0%, var(--background-light) 100%);
        border-left: 5px solid var(--primary-dark);
    }

    .info-section .card-header {
        background: transparent;
        color: var(--text-dark);
        border-bottom: 2px solid var(--primary-light);
        padding: 1rem 1.5rem;
    }

    .info-section .card-body {
        padding: 1.5rem;
    }

    /* ===== OWNER INFO ===== */
    .owner-info {
        background: linear-gradient(135deg, #ffffff 0%, #f8fdff 100%);
    }

    .info-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--primary-light);
    }

    .info-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .info-item strong {
        color: var(--primary-dark);
        display: block;
        margin-bottom: 0.3rem;
        font-size: 0.95rem;
    }

    .info-item .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 15px;
    }

    /* ===== RELATED UMKM ===== */
    .related-umkm-section {
        margin-top: 3rem;
    }

    .related-umkm-section h4 {
        color: var(--text-dark);
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid var(--primary-light);
        display: inline-block;
    }

    .related-card {
        border: 2px solid var(--primary-light);
        transition: all 0.3s ease;
        height: 100%;
    }

    .related-card:hover {
        border-color: var(--primary-dark);
        transform: translateY(-5px);
    }

    .related-card .card-img-top {
        height: 140px;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }

    .related-card .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .related-card .card-badge {
        background: var(--primary-medium);
        color: var(--text-dark);
        font-size: 0.75rem;
        padding: 0.3rem 0.7rem;
        border-radius: 15px;
    }

    /* ===== BADGE STYLES ===== */
    .badge.bg-primary {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%) !important;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
    }

    /* ===== UTILITY CLASSES ===== */
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bg-custom-light {
        background-color: var(--primary-light) !important;
    }

    .text-custom-dark {
        color: var(--text-dark) !important;
    }

    /* Custom Background Classes */
    .bg-custom-light {
        background-color: var(--primary-light) !important;
    }

    .bg-custom-medium {
        background-color: var(--primary-medium) !important;
    }

    .bg-custom-dark {
        background-color: var(--primary-dark) !important;
    }

    .text-custom-dark {
        color: var(--text-dark) !important;
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Custom Shadow */
    .custom-shadow {
        box-shadow: 0 8px 25px rgba(20, 107, 140, 0.15);
    }

    /* Hover Effects */
    .hover-lift {
        transition: transform 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .header h1 {
            font-size: 2.2rem;
        }

        .header .lead {
            font-size: 1.1rem;
        }

        .umkm-profile-card .umkm-name {
            font-size: 1.5rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .btn-primary,
        .btn-success {
            padding: 0.6rem 1.5rem;
            font-size: 0.9rem;
        }

        .related-umkm-section h4 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        .umkm-profile-card .card-img {
            height: 200px;
        }

        .info-item {
            margin-bottom: 0.8rem;
            padding-bottom: 0.8rem;
        }
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    .hover-lift {
        transition: transform 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
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
