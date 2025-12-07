<!-- Sale & Revenue Start -->
<section class="stats-section py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Card Total Pesanan -->
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
            <!-- Card Pesanan Baru -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Pesanan Baru</h5>
                                <h6 class="card-subtitle mb-2">Bulan Ini</h6>
                                <h3 class="card-value mb-0">{{ $pesananBaru ?? '0' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pesanan Diproses -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-sync-alt fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Sedang Diproses</h5>
                                <h3 class="card-value mb-0">{{ $pesananDiproses ?? '0' }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sale & Revenue End -->

<!-- Pesanan List Start -->
<section class="pesanan-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Pesanan</h5>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('pesanan.index') }}">Semua Pesanan</a></li>
                                <li><a class="dropdown-item"
                                       href="{{ route('pesanan.index') }}?status=menunggu_pembayaran">Menunggu Pembayaran</a></li>
                                <li><a class="dropdown-item"
                                       href="{{ route('pesanan.index') }}?status=diproses">Diproses</a></li>
                                <li><a class="dropdown-item"
                                       href="{{ route('pesanan.index') }}?status=dikirim">Dikirim</a></li>
                                <li><a class="dropdown-item"
                                       href="{{ route('pesanan.index') }}?status=selesai">Selesai</a></li>
                                <li><a class="dropdown-item"
                                       href="{{ route('pesanan.index') }}?status=dibatalkan">Dibatalkan</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-2"></i>Tambah Pesanan
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <div class="flex-grow-1 text-center">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="background: transparent; border: none; font-size: 1.5rem; line-height: 1; padding: 0.5rem; color: inherit;">
                            ×
                        </button>
                    </div>
                @endif

                @if ($pesanan->count() > 0)
                    <div class="row g-4">
                        @foreach ($pesanan as $p)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card pesanan-card border-0 shadow-sm h-100">
                                    <!-- Card Header -->
                                    <div class="card-header bg-light border-bottom py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold">#{{ $p->nomor_pesanan }}</h6>
                                                <small class="text-muted">
                                                    {{ $p->created_at->format('d M Y H:i') }}
                                                </small>
                                            </div>
                                            <span class="badge bg-{{ $p->status == 'selesai' ? 'success' : ($p->status == 'dibatalkan' ? 'danger' : ($p->status == 'diproses' ? 'warning' : ($p->status == 'dikirim' ? 'info' : 'secondary'))) }}">
                                                {{ $p->status_lengkap }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body d-flex flex-column">
                                        <!-- Customer Info -->
                                        <div class="mb-3">
                                            <small class="text-muted d-block">
                                                <i class="fa fa-user me-1"></i>Pelanggan
                                            </small>
                                            <p class="mb-0 fw-medium">{{ $p->warga->nama }}</p>
                                            <small class="text-muted">{{ $p->warga->telp }}</small>
                                        </div>

                                        <!-- Address -->
                                        <div class="mb-3">
                                            <small class="text-muted d-block">
                                                <i class="fa fa-map-marker-alt me-1"></i>Alamat Kirim
                                            </small>
                                            <p class="mb-0 text-muted small">
                                                {{ $p->alamat_kirim }}, RT {{ $p->rt }}/RW {{ $p->rw }}
                                            </p>
                                        </div>

                                        <!-- Payment Method & Total -->
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">
                                                    <i class="fa fa-credit-card me-1"></i>Pembayaran
                                                </small>
                                                <p class="mb-0">{{ $p->metode_bayar_lengkap }}</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <small class="text-muted d-block">Total</small>
                                                <h5 class="mb-0 text-primary fw-bold">
                                                    Rp {{ number_format($p->total, 0, ',', '.') }}
                                                </h5>
                                            </div>
                                        </div>

                                        <!-- Tracking Info -->
                                        <div class="mb-3">
                                            @if($p->resi_pengiriman)
                                                <small class="text-muted d-block">
                                                    <i class="fa fa-truck me-1"></i>Resi Pengiriman
                                                </small>
                                                <p class="mb-0 fw-medium">{{ $p->resi_pengiriman }}</p>
                                            @endif
                                            @if($p->bukti_bayar)
                                                <small class="text-muted d-block mt-2">
                                                    <i class="fa fa-receipt me-1"></i>Bukti Bayar
                                                </small>
                                                <a href="{{ asset('storage/' . $p->bukti_bayar) }}"
                                                   target="_blank"
                                                   class="text-decoration-none">
                                                    <i class="fa fa-eye me-1"></i>Lihat Bukti
                                                </a>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="mt-auto pt-3 border-top">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group w-100" role="group">
                                                    <a href="{{ route('pesanan.show', $p) }}"
                                                        class="btn btn-outline-warning btn-sm flex-fill" title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                        <span class="d-none d-md-inline ms-1">Detail</span>
                                                    </a>
                                                    <a href="{{ route('pesanan.edit', $p) }}"
                                                        class="btn btn-outline-warning btn-sm flex-fill mx-2"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                        <span class="d-none d-md-inline ms-1">Edit</span>
                                                    </a>
                                                    <form action="{{ route('pesanan.destroy', $p) }}" method="POST"
                                                        class="d-inline flex-fill">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-outline-warning btn-sm w-100" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                                            <i class="fa fa-trash"></i>
                                                            <span class="d-none d-md-inline ms-1">Hapus</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card Footer -->
                                    <div class="card-footer bg-white border-top py-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $p->updated_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted mb-3">Belum Ada Pesanan</h4>
                            <p class="text-muted mb-4">
                                Mulai dengan menambahkan pesanan pertama Anda
                            </p>
                            <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-plus me-2"></i>Tambah Pesanan Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($pesanan->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $pesanan->firstItem() }} - {{ $pesanan->lastItem() }} dari
                            {{ $pesanan->total() }} pesanan
                        </div>
                        <div>
                            {{ $pesanan->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
