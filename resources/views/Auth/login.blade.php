<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/font-awesome.min.css') }}" rel="stylesheet" />
    @include('layout.users.css')
    <style>
        /* Variabel dan Import Font - SAMA PERSIS dengan CSS utama */
        :root {
            --white: #ffffff;
            --black: #000000;
            --primary1: #ffbe33;
            --primary2: #222831;
            --textCol: #1f1f1f;
        }

        /* import fonts - font-family: 'Open Sans', sans-serif and font-family: 'Dancing Script', cursive; */

        body {
            font-family: "Open Sans", sans-serif;
            color: #0c0c0c;
            background-color: #f8f9fa;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }


        h1, h2 {
            font-family: 'Dancing Script', cursive;
        }

        /* Styles khusus untuk login page */
        .login-container {
            position: relative;
            z-index: 1;
        }

        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: var(--white);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            background-color: var(--primary2);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header h2 {
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            font-size: 2.5rem;
        }

        .login-header p {
            opacity: 0.9;
            position: relative;
            z-index: 1;
            margin-bottom: 0;
            font-family: "Open Sans", sans-serif;
        }

        .card-body {
            padding: 30px;
            background-color: var(--white);
        }

        .form-label {
            font-weight: 600;
            color: var(--textCol);
            margin-bottom: 8px;
            font-family: "Open Sans", sans-serif;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
            background-color: white;
            font-family: "Open Sans", sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary1);
            box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
            background-color: white;
        }


        .btn-login {
            display: inline-block;
            padding: 12px 45px;
            background-color: var(--primary1);
            color: var(--white);
            border-radius: 45px;
            transition: all 0.3s;
            border: none;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
            font-family: "Open Sans", sans-serif;
        }

        .btn-login:hover {
            background-color: #e6a500;
            color: var(--white);
            transform: translateY(-2px);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            border-radius: 10px;
            color: #c0392b;
            font-family: "Open Sans", sans-serif;
        }

        .bg-light {
            background-color: #f8f9fa !important;
            border-radius: 10px;
            border-left: 3px solid var(--primary1);
        }

        .text-decoration-none {
            color: var(--primary2);
            transition: color 0.3s ease;
            font-weight: 500;
            font-family: "Open Sans", sans-serif;
        }

        .text-decoration-none:hover {
            color: var(--primary1);
        }

        .form-check-input:checked {
            background-color: var(--primary1);
            border-color: var(--primary1);
        }

        /* Pastikan semua elemen menggunakan font yang benar */
        p, span, small, div, ul, li, a, input, button, label {
            font-family: "Open Sans", sans-serif;
        }

        @media (max-width: 768px) {
            .login-card {
                margin: 20px;
            }

            .card-body {
                padding: 20px;
            }

            .login-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="login-header">
                        <h2>Login UMKM Desa</h2>
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
                                    value="{{ old('email') }}" placeholder="Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>

                            <div class="text-center mt-3">
                                <p>Belum punya akun? <a href="{{ route('register') }}"
                                        class="text-decoration-none">Daftar di sini</a></p>
                            </div>

                            <button type="submit" class="btn-login w-100 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="/" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman UMKM
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
