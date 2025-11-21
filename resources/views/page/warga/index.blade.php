<section class="container-fluid pt-4 px-4">
    <section class="row g-4">
        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">Total Warga</p>
                    <h6 class="mb-0">{{ $warga->total() }}</h6>
                </section>
            </section>
        </section>
        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-male fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">Laki-laki</p>
                    <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'L')->count() }}</h6>
                </section>
            </section>
        </section>
        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-female fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">Perempuan</p>
                    <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'P')->count() }}</h6>
                </section>
            </section>
        </section>
        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-store fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">Pemilik UMKM</p>
                    <h6 class="mb-0">{{ $warga->filter(function ($w) {return $w->umkm->count() > 0;})->count() }}
                    </h6>
                </section>
            </section>
        </section>
    </section>
</section>
<!-- Sale & Revenue End -->

<!-- Warga Card View Start -->
<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Warga</h6>
            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah Warga
            </a>
        </section>

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

        @if (session('error'))
            <section class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </section>
        @endif

        <!-- Filter dan Search Form -->
        <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
            <section class="row g-3 justify-content-center">
                <!-- Search -->
                <section class="col-md-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama, NIK, alamat...">
                        <button type="submit" class="input-group-text">
                            <i class="fa fa-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn-clear">
                                Clear
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Filter Jenis Kelamin -->
                <section class="col-md-2">
                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </section>

                <!-- Filter UMKM -->
                <section class="col-md-2">
                    <select name="umkm_status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pemilik" {{ request('umkm_status') == 'pemilik' ? 'selected' : '' }}>Pemilik
                            UMKM</option>
                        <option value="bukan" {{ request('umkm_status') == 'bukan' ? 'selected' : '' }}>Bukan Pemilik
                        </option>
                    </select>
                </section>

                <!-- Sorting -->
                <section class="col-md-2">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>A-Z</option>
                        <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Z-A</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </section>
            </section>
        </form>

        <!-- Card View -->
        <section class="row" id="wargaCards">
            @forelse($warga as $index => $w)
                <section class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <section class="card h-100 shadow-sm">
                        <section class="card-body d-flex flex-column">
                            <!-- Header dengan Avatar dan Info Utama -->
                            <section class="d-flex align-items-start mb-3">
                                <section class="flex-shrink-0">
                                    <section
                                        class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px; font-size: 20px;">
                                        {{ strtoupper(substr($w->nama, 0, 1)) }}
                                    </section>
                                </section>
                                <section class="flex-grow-1 ms-3">
                                    <h5 class="card-title mb-1">{{ $w->nama }}</h5>
                                    <section class="d-flex flex-wrap gap-1 mb-2">
                                        @if ($w->jenis_kelamin == 'L')
                                            <span class="badge bg-primary">Laki-laki</span>
                                        @else
                                            <span class="badge bg-success">Perempuan</span>
                                        @endif
                                        @if ($w->umkm->count() > 0)
                                            <span class="badge bg-warning">Pemilik UMKM</span>
                                        @endif
                                    </section>
                                </section>
                            </section>

                            <!-- Informasi Detail -->
                            <section class="mb-3">
                                <section class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-id-card me-1"></i>
                                        <strong>NIK:</strong> {{ $w->no_ktp }}
                                    </small>
                                </section>
                                <section class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-briefcase me-1"></i>
                                        <strong>Pekerjaan:</strong> {{ $w->pekerjaan ?? '-' }}
                                    </small>
                                </section>
                                <section class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-star me-1"></i>
                                        <strong>Agama:</strong> {{ $w->agama ?? '-' }}
                                    </small>
                                </section>
                                <section class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-map-marker me-1"></i>
                                        <strong>RT/RW:</strong> {{ $w->rt }}/{{ $w->rw }}
                                    </small>
                                </section>
                            </section>

                            <!-- Kontak -->
                            <section class="mb-3">
                                @if ($w->telp)
                                    <section class="mb-1">
                                        <small class="text-muted">
                                            <i class="fa fa-phone me-1"></i>
                                            {{ $w->telp }}
                                        </small>
                                    </section>
                                @endif
                                @if ($w->email)
                                    <section>
                                        <small class="text-muted">
                                            <i class="fa fa-envelope me-1"></i>
                                            {{ $w->email }}
                                        </small>
                                    </section>
                                @endif
                            </section>

                            <!-- UMKM yang Dimiliki -->
                            @if ($w->umkm->count() > 0)
                                <section class="mb-3">
                                    <small class="text-muted d-block mb-1">
                                        <strong>UMKM:</strong>
                                    </small>
                                    @foreach ($w->umkm->take(2) as $umkm)
                                        <span class="badge bg-light text-dark me-1 mb-1">
                                            {{ $umkm->nama_usaha }}
                                        </span>
                                    @endforeach
                                    @if ($w->umkm->count() > 2)
                                        <small class="text-muted">
                                            +{{ $w->umkm->count() - 2 }} lainnya
                                        </small>
                                    @endif
                                </section>
                            @endif

                            <!-- Tombol Aksi -->
                            <section class="mt-auto">
                                <section class="btn-group w-100" role="group">
                                    <a href="{{ route('warga.show', $w) }}" class="btn btn-outline-primary btn-sm"
                                        title="Lihat Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('warga.edit', $w) }}" class="btn btn-outline-primary btn-sm"
                                        title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('warga.destroy', $w) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-primary btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </section>
                            </section>
                        </section>

                        <section class="card-footer bg-transparent">
                            <small class="text-muted">
                                Terdaftar:
                                {{ $w->created_at ? $w->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                            </small>
                        </section>
                    </section>
                </section>
            @empty
                <section class="col-12">
                    <section class="text-center py-5">
                        <i class="fa fa-users fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Tidak ada data warga</h5>
                        <p class="text-muted">Mulai dengan menambahkan warga baru</p>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Tambah Warga Pertama
                        </a>
                    </section>
                </section>
            @endforelse
        </section>

        <!-- Pagination -->
        @if ($warga->hasPages())
            <section class="mt-3">
                {{ $warga->links('pagination::bootstrap-5') }}
            </section>
        @else
            <section class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $warga->count() }} warga
                </small>
            </section>
        @endif
    </section>
</section>
