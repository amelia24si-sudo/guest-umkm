<!-- Sale & Revenue Start -->
<section class="stats-section py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <!-- Card Total Produk -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-box fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Total Produk</h5>
                                <h3 class="card-value mb-0">{{ $totalProduk }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Produk Aktif -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-check-circle fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Produk Aktif</h5>
                                <h3 class="card-value mb-0">{{ $produkAktif }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Stok -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-cubes fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Total Stok</h5>
                                <h3 class="card-value mb-0">{{ $totalStok }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Produk Baru -->
            <div class="col-sm-6 col-xl-3">
                <div class="card stats-card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="card-icon">
                                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                            </div>
                            <div class="card-content ms-3 text-end">
                                <h5 class="card-title mb-1">Produk Baru</h5>
                                <h6 class="card-subtitle mb-2">Bulan Ini</h6>
                                <h3 class="card-value mb-0">{{ $produkBaru }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sale & Revenue End -->

<!-- Produk List Start -->
<section class="produk-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Produk</h5>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-filter me-2"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('produk.index') }}">Semua Produk</a></li>
                                <li><a class="dropdown-item" href="{{ route('produk.index') }}?status=aktif">Aktif</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('produk.index') }}?status=nonaktif">Nonaktif</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-2"></i>Tambah Produk
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

                @if ($produk->count() > 0)
                    <div class="row g-4">
                        @foreach ($produk as $p)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="card product-card border-0 shadow-sm h-100">
                                    <!-- Product Image -->
                                    <div class="product-card-image position-relative">
                                        @if ($p->media->count() > 0)
                                            <img src="{{ asset('storage/' . $p->media->first()->file_url) }}"
                                                alt="{{ $p->nama_produk }}" class="card-img-top product-card-img">
                                        @else
                                            <div
                                                class="product-card-img-placeholder d-flex align-items-center justify-content-center">
                                                <i class="fa fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <!-- Status Badge -->
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge product-status-badge bg-{{ $p->status_badge }}">
                                                {{ $p->status_text }}
                                            </span>
                                        </div>
                                        <!-- Stock Badge -->
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-{{ $p->stok > 0 ? 'success' : 'danger' }}">
                                                <i class="fa fa-cube me-1"></i>{{ $p->stok }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="card-body d-flex flex-column">
                                        <!-- Product Name -->
                                        <h5 class="card-title product-name mb-2">
                                            {{ Str::limit($p->nama_produk, 40) }}
                                        </h5>

                                        <!-- UMKM -->
                                        <div class="mb-3">
                                            <small class="text-muted d-block">
                                                <i class="fa fa-store me-1"></i>UMKM
                                            </small>
                                            <p class="mb-0 fw-medium">{{ $p->umkm->nama_usaha }}</p>
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-3">
                                            <small class="text-muted d-block">
                                                <i class="fa fa-tag me-1"></i>Harga
                                            </small>
                                            <h4 class="mb-0 text-primary fw-bold">{{ $p->harga_formatted }}</h4>
                                        </div>

                                        <!-- Description Preview -->
                                        @if ($p->deskripsi)
                                            <div class="mb-3 flex-grow-1">
                                                <small class="text-muted d-block">
                                                    <i class="fa fa-align-left me-1"></i>Deskripsi
                                                </small>
                                                <p class="mb-0 text-muted small">
                                                    {{ Str::limit($p->deskripsi, 100) }}
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="mt-auto pt-3 border-top">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group w-100" role="group">
                                                    <a href="{{ route('produk.show', $p) }}"
                                                        class="btn btn-outline-warning btn-sm flex-fill" title="Detail">
                                                        <i class="fa fa-eye"></i>
                                                        <span class="d-none d-md-inline ms-1">Detail</span>
                                                    </a>
                                                    <a href="{{ route('produk.edit', $p) }}"
                                                        class="btn btn-outline-warning btn-sm flex-fill mx-2"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                        <span class="d-none d-md-inline ms-1">Edit</span>
                                                    </a>
                                                    <form action="{{ route('produk.destroy', $p) }}" method="POST"
                                                        class="d-inline flex-fill">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-outline-warning btn-sm w-100" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
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
                                                <i class="fa fa-calendar me-1"></i>
                                                {{ $p->created_at->format('d M Y') }}
                                            </small>
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
                            <i class="fa fa-box-open fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted mb-3">Belum Ada Produk</h4>
                            <p class="text-muted mb-4">
                                Mulai dengan menambahkan produk pertama Anda
                            </p>
                            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-plus me-2"></i>Tambah Produk Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($produk->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $produk->firstItem() }} - {{ $produk->lastItem() }} dari
                            {{ $produk->total() }} produk
                        </div>
                        <div>
                            {{ $produk->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
