<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - UMKM Bina Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-light: #9FE7E7;
            --primary-medium: #6ECBD3;
            --background-light: #E8F8FF;
            --primary-dark: #289FB7;
            --secondary-dark: #146B8C;
            --text-dark: #0F1A1B;
        }

        body {
            background: linear-gradient(135deg, var(--background-light) 0%, var(--primary-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(20, 107, 140, 0.15);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }

        .register-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .register-header h2 {
            font-weight: 700;
            margin: 0;
        }

        .register-body {
            padding: 2rem;
        }

        .form-control {
            border: 2px solid var(--primary-light);
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 0.2rem rgba(40, 159, 183, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-dark) 100%);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 159, 183, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-dark);
        }

        .login-link a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2>Daftar Akun</h2>
            <p class="mb-0">Bergabung dengan UMKM Bina Desa</p>
        </div>

        <div class="register-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn-register" action="/beranda">Daftar</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
