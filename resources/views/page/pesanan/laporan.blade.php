    <section class="laporan-section py-4">
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
                                <i class="fa fa-file-alt me-1"></i>Laporan
                            </li>
                        </ol>
                    </nav>
                    <h4 class="fw-bold mb-3">
                        <i class="fa fa-file-alt me-2 text-primary"></i>Laporan Pesanan
                    </h4>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0">
                        <i class="fa fa-filter me-2"></i>Filter Laporan
                    </h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('pesanan.laporan') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="menunggu_pembayaran"
                                    {{ request('status') == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu
                                    Pembayaran</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                    Diproses</option>
                                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim
                                </option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-search me-1"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4 border-end">
                                    <h3 class="text-primary">{{ $pesanan->count() }}</h3>
                                    <p class="text-muted mb-0">Total Pesanan</p>
                                </div>
                                <div class="col-md-4 border-end">
                                    <h3 class="text-success">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                    <p class="text-muted mb-0">Total Pendapatan</p>
                                </div>
                                <div class="col-md-4">
                                    <h3 class="text-info">{{ $pesanan->where('status', 'selesai')->count() }}</h3>
                                    <p class="text-muted mb-0">Pesanan Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Laporan -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="fa fa-list me-2"></i>Data Pesanan
                        </h5>
                        <div>
                            @if (request()->anyFilled(['dari', 'sampai', 'status']))
                                <a href="{{ route('pesanan.laporan') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-times me-1"></i>Reset Filter
                                </a>
                            @endif
                            <button onclick="window.print()" class="btn btn-primary btn-sm ms-2">
                                <i class="fa fa-print me-1"></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($pesanan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Metode Bayar</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>#{{ $item->nomor_pesanan }}</td>
                                            <td>{{ $item->warga->nama }}</td>
                                            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->status == 'selesai' ? 'success' : ($item->status == 'dibatalkan' ? 'danger' : ($item->status == 'diproses' ? 'warning' : ($item->status == 'dikirim' ? 'info' : 'secondary'))) }}">
                                                    {{ $item->status_lengkap }}
                                                </span>
                                            </td>
                                            <td>{{ $item->metode_bayar_lengkap }}</td>
                                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fa fa-file-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada data pesanan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
