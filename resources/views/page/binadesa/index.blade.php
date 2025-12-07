<!-- Sale & Revenue Start -->
<section class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-store fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total UMKM</p>
                    <h6 class="mb-0">{{ $totalUsaha }}</h6>
                </div>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Usaha Aktif</p>
                    <h6 class="mb-0">{{ $usahaAktif }}</h6>
                </div>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-tags fa-3x text-primary"></i>&nbsp;
                <div class="ms-3">
                    <p class="mb-2">Kategori Terbanyak</p>
                    <h6 class="mb-0">{{ $kategoriTerbanyak }}</h6>
                </div>
            </section>
        </div>
        <div class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Usaha Baru (Bulan Ini)</p>
                    <h6 class="mb-0">{{ $usahaBaru }}</h6>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- Sale & Revenue End -->

<!-- UMKM Card View Start -->
<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar UMKM/Binadesa</h6>
            <a href="{{ route('binadesa.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah UMKM
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
        <form method="GET" action="{{ route('binadesa.index') }}" class="mb-4">
            <section class="row g-3 justify-content-center">
                <!-- Search -->
                <section class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Cari nama UMKM, alamat...">
                        <button type="submit" class="input-group-text">
                            <i class="fa fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                               class="btn-clear ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Kategori Filter -->
                <section class="col-md-3">
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoriList as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </section>

                <!-- Sorting -->
                <section class="col-md-3">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </section>
            </section>
        </form>

        <!-- Card View -->
        <section class="row" id="umkmCards">
            @forelse($binadesa as $b)
                <section class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <section class="card h-100 shadow-sm">
                        <!-- Logo/Gambar UMKM -->
                        <section class="position-relative">
                            @if ($b->media && $b->media->count() > 0)
                                <img src="{{ Storage::url($b->media->first()->file_url) }}" class="card-img-top"
                                    alt="{{ $b->nama_usaha }}" style="height: 200px; object-fit: cover;">
                            @else
                                <section
                                    class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white"
                                    style="height: 200px;">
                                    <i class="fa fa-store fa-3x"></i>
                                </section>
                            @endif
                            <section class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-primary">{{ $b->kategori }}</span>
                            </section>
                        </section>
                        <br>

                        <section class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $b->nama_usaha }}</h5>
                            <section class="mb-2">
                                <small class="text-muted">
                                    <i class="fa fa-user me-1"></i>
                                    {{ $b->pemilik->nama }}
                                </small>
                            </section>
                            <section class="mb-2">
                                <small class="text-muted">
                                    <i class="fa fa-phone me-1"></i>
                                    {{ $b->kontak }}
                                </small>
                            </section>
                            <section class="mb-3">
                                <small class="text-muted">
                                    <i class="fa fa-map-marker me-1"></i>
                                    RT {{ $b->rt }}/RW {{ $b->rw }}
                                </small>
                            </section>

                            @if ($b->deskripsi)
                                <p class="card-text flex-grow-1">
                                    {{ Str::limit($b->deskripsi, 100) }}
                                </p>
                            @endif

                            <section class="mt-auto">
                                <section class="btn-group w-100" role="group">
                                    <a href="{{ route('binadesa.show', $b) }}" class="btn btn-outline-primary btn-sm"
                                        title="Lihat Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('binadesa.edit', $b) }}" class="btn btn-outline-primary btn-sm"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('binadesa.destroy', $b) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-primary btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </section>
                            </section>
                        </section>

                        <section class="card-footer bg-transparent">
                            <small class="text-muted">
                                Dibuat: {{ $b->created_at->format('d M Y') }}
                            </small>
                        </section>
                    </section>
                </section>
            @empty
                <section class="col-12">
                    <section class="text-center py-5">
                        <i class="fa fa-store fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data UMKM</h5>
                        <p class="text-muted">Mulai dengan menambahkan UMKM baru</p>
                        <a href="{{ route('binadesa.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Tambah UMKM Pertama
                        </a>
                    </section>
                </section>
            @endforelse
        </section>

        <!-- Pagination -->
        @if($binadesa->hasPages())
            <section class="mt-3">
                {{ $binadesa->links('pagination::bootstrap-5') }}
            </section>
        @else
            <section class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $binadesa->count() }} UMKM
                </small>
            </section>
        @endif
    </section>
</section>
<!-- UMKM Card View End -->
