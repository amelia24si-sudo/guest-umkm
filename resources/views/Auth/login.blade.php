<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --color1: #9FE7E7;
            --color2: #6ECBD3;
            --color3: #E8F8FF;
            --color4: #289FB7;
            --color5: #146B8C;
            --color6: #0F1A1B;
        }

        body {
            background: linear-gradient(135deg, var(--color1) 0%, var(--color2) 50%, var(--color4) 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .login-container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(15, 26, 27, 0.2);
            overflow: hidden;
            background-color: var(--color3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(15, 26, 27, 0.3);
        }

        .login-header {
            background: linear-gradient(135deg, var(--color4) 0%, var(--color5) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(30deg);
        }

        .login-header h2 {
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .card-body {
            padding: 30px;
            background-color: var(--color3);
        }

        .form-label {
            font-weight: 600;
            color: var(--color6);
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            transition: all 0.3s ease;
            background-color: white;
        }

        .form-control:focus {
            border-color: var(--color4);
            box-shadow: 0 0 0 0.2rem rgba(40, 159, 183, 0.25);
            background-color: white;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--color4) 0%, var(--color5) 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 159, 183, 0.4);
            background: linear-gradient(135deg, var(--color5) 0%, var(--color4) 100%);
            color: white;
        }

        .form-check-input:checked {
            background-color: var(--color4);
            border-color: var(--color4);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            border-radius: 10px;
            color: #c0392b;
        }

        .bg-light {
            background-color: rgba(232, 248, 255, 0.7) !important;
            border-radius: 10px;
            border-left: 3px solid var(--color4);
        }

        .text-decoration-none {
            color: var(--color5);
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .text-decoration-none:hover {
            color: var(--color4);
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 70%;
            left: 80%;
            animation-delay: -5s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 40%;
            left: 85%;
            animation-delay: -10s;
        }

        .floating-element:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 15%;
            animation-delay: -7s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.7;
            }

            100% {
                transform: translateY(0) rotate(360deg);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 20px;
            }

            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>

    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="login-header">
                        <h2><i class="fas fa-user-circle me-2"></i>Login UMKM Desa</h2>
                        <p class="mb-0">Masuk ke akun UMKM Anda</p>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="/login">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="contoh: umkm@desa.id" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan password" required>
                            </div>

                            <div class="text-center mt-3">
                                <p>Belum punya akun? <a href="{{ route('register') }}"
                                        class="text-decoration-none">Daftar di sini</a></p>
                            </div>

                            <button type="submit" class="btn btn-login w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="/beranda" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman UMKM
                            </a>
                        </div>

                        <!-- Contoh email untuk testing -->
                        <div class="mt-3 p-2 bg-light rounded">
                            <small class="text-muted">
                                <i class="fas fa-lightbulb me-2"></i>
                                Contoh email: <strong>umkm@desa.id</strong> - Password: minimal 6 karakter
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
