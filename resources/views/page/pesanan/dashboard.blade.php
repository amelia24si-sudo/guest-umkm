<section class="dashboard-section py-4">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('pesanan.index') }}" class="text-decoration-none">
                                <i class="fa fa-shopping-cart me-1"></i>Pesanan
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fa fa-chart-bar me-1"></i>Dashboard
                        </li>
                    </ol>
                </nav>
                <h4 class="fw-bold mb-3">
                    <i class="fa fa-chart-bar me-2 text-primary"></i>Dashboard Pesanan
                </h4>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Pesanan -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-shopping-cart fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Total Pesanan</h5>
                                <h3 class="card-value mb-0">{{ $totalPesanan }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-money-bill-wave fa-3x text-success"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Total Pendapatan</h5>
                                <h3 class="card-value mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesanan Baru -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-plus-circle fa-3x text-info"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Pesanan Baru</h5>
                                <h6 class="card-subtitle mb-2">Bulan Ini</h6>
                                <h3 class="card-value mb-0">{{ $pesananBaru }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pesanan Selesai -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-check-circle fa-3x text-success"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Selesai</h5>
                                <h3 class="card-value mb-0">{{ $pesananSelesai }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0">
                            <i class="fa fa-chart-pie me-2"></i>Distribusi Status Pesanan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Menunggu Pembayaran -->
                            <div class="col-md-3 col-6 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="mb-2">
                                        <i class="fa fa-clock fa-2x text-secondary"></i>
                                    </div>
                                    <h4 class="mb-1">{{ $pesananMenunggu }}</h4>
                                    <p class="text-muted small mb-0">Menunggu Pembayaran</p>
                                </div>
                            </div>

                            <!-- Diproses -->
                            <div class="col-md-3 col-6 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="mb-2">
                                        <i class="fa fa-sync-alt fa-2x text-warning"></i>
                                    </div>
                                    <h4 class="mb-1">{{ $pesananDiproses }}</h4>
                                    <p class="text-muted small mb-0">Diproses</p>
                                </div>
                            </div>

                            <!-- Dikirim -->
                            <div class="col-md-3 col-6 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="mb-2">
                                        <i class="fa fa-truck fa-2x text-info"></i>
                                    </div>
                                    <h4 class="mb-1">{{ $pesananDikirim }}</h4>
                                    <p class="text-muted small mb-0">Dikirim</p>
                                </div>
                            </div>

                            <!-- Dibatalkan -->
                            <div class="col-md-3 col-6 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="mb-2">
                                        <i class="fa fa-times-circle fa-2x text-danger"></i>
                                    </div>
                                    <h4 class="mb-1">
                                        {{ $totalPesanan - ($pesananMenunggu + $pesananDiproses + $pesananDikirim + $pesananSelesai) }}
                                    </h4>
                                    <p class="text-muted small mb-0">Dibatalkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="fa fa-history me-2"></i>Pesanan Terbaru
                            </h5>
                            <a href="{{ route('pesanan.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-list me-1"></i>Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($pesananTerbaru->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No. Pesanan</th>
                                            <th>Pelanggan</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesananTerbaru as $pesanan)
                                            <tr>
                                                <td>
                                                    <strong>#{{ $pesanan->nomor_pesanan }}</strong>
                                                </td>
                                                <td>{{ $pesanan->warga->nama }}</td>
                                                <td>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $pesanan->status == 'selesai' ? 'success' : ($pesanan->status == 'dibatalkan' ? 'danger' : ($pesanan->status == 'diproses' ? 'warning' : ($pesanan->status == 'dikirim' ? 'info' : 'secondary'))) }}">
                                                        {{ $pesanan->status_lengkap }}
                                                    </span>
                                                </td>
                                                <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <a href="{{ route('pesanan.show', $pesanan) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada pesanan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
