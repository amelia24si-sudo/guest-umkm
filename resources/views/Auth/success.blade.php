<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .success-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .success-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 40px;
            text-align: center;
        }
        .checkmark {
            font-size: 4rem;
            color: #28a745;
        }
        .user-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .email-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card success-card">
                    <div class="success-header">
                        <div class="checkmark">✓</div>
                        <h2 class="mt-3">Login Berhasil!</h2>
                    </div>
                    <div class="card-body p-5 text-center">
                        <!-- Informasi User yang Login -->
                        <div class="user-info">
                            <h5>Selamat datang kembali!</h5>
                            <div class="email-badge">
                                {{ $email }}
                            </div>
                            <p class="text-muted mb-0">Anda telah berhasil login ke sistem</p>
                        </div>

                        <p class="lead">Anda sekarang dapat mengakses fitur-fitur khusus untuk UMKM.</p>
                        
                        <div class="mt-4">
                            <a href="/umkm" class="btn btn-primary me-2">
                                <i class="fas fa-store"></i> Lihat Daftar UMKM
                            </a>
                            <a href="/login" class="btn btn-outline-secondary">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>

                        <!-- Info Tambahan -->
                        <div class="mt-4 p-3 bg-light rounded">
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> 
                                Login berhasil pada: {{ date('d F Y H:i:s') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>