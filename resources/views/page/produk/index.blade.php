<!-- Sale & Revenue Start -->
<section class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- Card Total Produk -->
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-box fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Produk</p>
                    <h6 class="mb-0">{{ $totalProduk }}</h6>
                </div>
            </section>
        </div>

        <!-- Card Produk Aktif -->
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Produk Aktif</p>
                    <h6 class="mb-0">{{ $produkAktif }}</h6>
                </div>
            </section>
        </div>

        <!-- Card Total Stok -->
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-cubes fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Stok</p>
                    <h6 class="mb-0">{{ $totalStok }}</h6>
                </div>
            </section>
        </div>

        <!-- Card Produk Baru -->
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Produk Baru (Bulan Ini)</p>
                    <h6 class="mb-0">{{ $produkBaru }}</h6>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- Sale & Revenue End -->

<!-- Produk Card View Start -->
<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Produk</h6>
            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah Produk
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <div class="flex-grow-1 text-center">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    style="background: transparent; border: none; font-size: 1.5rem; line-height: 1; padding: 0.5rem; color: inherit;">
                    ×
                </button>
            </div>
        @endif

        <!-- Filter dan Search Form -->
        <form method="GET" action="{{ route('produk.index') }}" class="mb-4">
            <section class="row g-3 justify-content-center">
                <!-- Search -->
                <section class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama produk, deskripsi...">
                        <button type="submit" class="input-group-text">
                            <i class="fa fa-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn-clear ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Status Filter -->
                <section class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                        </option>
                    </select>
                </section>

                <!-- Sorting -->
                <section class="col-md-3">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z
                        </option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A
                        </option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah
                        </option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga
                            Tertinggi</option>
                    </select>
                </section>
            </section>
        </form>
        <!-- Card View -->
        <section class="row" id="produkCards">
            @forelse($produk as $p)
                <section class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <section class="card h-100 shadow-sm">
                        <!-- Gambar Produk -->
                        <section class="position-relative">
                            @if ($p->media && $p->media->count() > 0)
                                <img src="{{ Storage::url($p->media->first()->file_nama) }}" class="card-img-top"
                                    alt="{{ $p->nama_produk }}" style="height: 200px; object-fit: cover;">
                            @else
                                <section
                                    class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white"
                                    style="height: 200px;">
                                    <i class="fa fa-image fa-3x"></i>
                                </section>
                            @endif
                            <!-- Status Badge -->
                            <section class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-{{ $p->status_badge }}">
                                    {{ $p->status_text }}
                                </span>
                            </section>
                            <!-- Stock Badge -->
                            <section class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-{{ $p->stok > 0 ? 'success' : 'danger' }}">
                                    <i class="fa fa-cube me-1"></i>{{ $p->stok }}
                                </span>
                            </section>
                        </section>
                        <br>

                        <section class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($p->nama_produk, 40) }}</h5>

                            <!-- UMKM -->
                            <section class="mb-2">
                                <small class="text-muted">
                                    <i class="fa fa-store me-1"></i>
                                    {{ $p->umkm->nama_usaha }}
                                </small>
                            </section>

                            <!-- Harga -->
                            <section class="mb-3">
                                <small class="text-muted">
                                    <i class="fa fa-tag me-1"></i>Harga
                                </small>
                                <h6 class="mb-0 text-primary fw-bold">{{ $p->harga_formatted }}</h6>
                            </section>

                            @if ($p->deskripsi)
                                <p class="card-text flex-grow-1">
                                    {{ Str::limit($p->deskripsi, 100) }}
                                </p>
                            @endif

                            <section class="mt-auto">
                                <section class="btn-group w-100" role="group">
                                    <a href="{{ route('produk.show', $p) }}" class="btn btn-outline-primary btn-sm"
                                        title="Lihat Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('produk.edit', $p) }}" class="btn btn-outline-primary btn-sm"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $p) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-primary btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </section>
                            </section>
                        </section>

                        <section class="card-footer bg-transparent">
                            <small class="text-muted">
                                Dibuat: {{ $p->created_at->format('d M Y') }}
                            </small>
                        </section>
                    </section>
                </section>
            @empty
                <section class="col-12">
                    <section class="text-center py-5">
                        <i class="fa fa-box-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Produk</h5>
                        <p class="text-muted">Mulai dengan menambahkan produk pertama Anda</p>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Tambah Produk Pertama
                        </a>
                    </section>
                </section>
            @endforelse
        </section>

        <!-- Pagination -->
        @if ($produk->hasPages())
            <section class="mt-3">
                {{ $produk->links('pagination::bootstrap-5') }}
            </section>
        @else
            <section class="mt-3">
                <small class="text-muted">
                    Menampilkan
                    {{ $produk->firstItem() ? $produk->firstItem() . ' - ' . $produk->lastItem() . ' dari ' . $produk->total() : $produk->count() }}
                    produk
                </small>
            </section>
        @endif
    </section>
</section>
<!-- Produk Card View End -->
