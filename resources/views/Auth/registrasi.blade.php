<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - UMKM Bina Desa</title>
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
            justify-content: center;
        }


        h1, h2 {
            font-family: 'Dancing Script', cursive;
        }

        /* Styles khusus untuk register page */
        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .register-header {
            background-color: var(--primary2);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .register-header h2 {
            font-weight: 700;
            margin: 0;
            font-size: 2.5rem;
        }

        .register-header p {
            margin-bottom: 0;
            font-family: "Open Sans", sans-serif;
        }

        .register-content {
            padding: 2rem;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            font-family: "Open Sans", sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary1);
            box-shadow: 0 0 0 0.2rem rgba(255, 190, 51, 0.25);
        }


        .btn-register {
            display: inline-block;
            padding: 12px 45px;
            background-color: var(--primary1);
            color: var(--white);
            border-radius: 45px;
            transition: all 0.3s;
            border: none;
            font-weight: 600;
            width: 100%;
            font-family: "Open Sans", sans-serif;
        }

        .btn-register:hover {
            background-color: #e6a500;
            color: var(--white);
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--textCol);
            font-family: "Open Sans", sans-serif;
        }

        .login-link a {
            color: var(--primary2);
            text-decoration: none;
            font-weight: 600;
            font-family: "Open Sans", sans-serif;
        }

        .login-link a:hover {
            color: var(--primary1);
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            font-family: "Open Sans", sans-serif;
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

        .form-label {
            font-family: "Open Sans", sans-serif;
            font-weight: 600;
        }

        /* Pastikan semua elemen menggunakan font yang benar */
        p, span, small, div, ul, li, a, input, button, label {
            font-family: "Open Sans", sans-serif;
        }

        @media (max-width: 576px) {
            .register-container {
                margin: 20px;
            }

            .register-content {
                padding: 1.5rem;
            }

            .register-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2>Daftar Akun</h2>
            <p class="mb-0">Bergabung dengan UMKM Bina Desa</p>
        </div>

        <div class="register-content">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">
                        <i class="fas fa-user me-2"></i>Nama Lengkap
                    </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Alamat Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-2"></i>Konfirmasi Password
                    </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>

            <div class="text-center mt-3">
                <a href="/" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman UMKM
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
