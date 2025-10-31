@extends('layout.dashboard.app')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-store fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total UMKM</p>
                        <h6 class="mb-0">{{ $totalUsaha }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Usaha Aktif</p>
                        <h6 class="mb-0">{{ $usahaAktif }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-tags fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Kategori Terbanyak</p>
                        <h6 class="mb-0">{{ $kategoriTerbanyak }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-plus-circle fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Usaha Baru (Bulan Ini)</p>
                        <h6 class="mb-0">{{ $usahaBaru }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- UMKM Card View Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar UMKM/Binadesa</h6>
                <a href="{{ route('binadesa.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-2"></i>Tambah UMKM
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Options -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari UMKM...">
                </div>
                <div class="col-md-3">
                    <select id="categoryFilter" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Makanan & Minuman">Makanan & Minuman</option>
                        <option value="Kerajinan Tangan">Kerajinan Tangan</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Peternakan">Peternakan</option>
                        <option value="Jasa">Jasa</option>
                        <option value="Perdagangan">Perdagangan</option>
                        <option value="Industri Kecil">Industri Kecil</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="sortFilter" class="form-select">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name_asc">Nama A-Z</option>
                        <option value="name_desc">Nama Z-A</option>
                    </select>
                </div>
            </div>

            <!-- Card View -->
            <div class="row" id="umkmCards">
                @forelse($binadesa as $index => $b)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 umkm-card" data-category="{{ $b->kategori }}"
                        data-name="{{ strtolower($b->nama_usaha) }}" data-created="{{ $b->created_at }}">
                        <div class="card h-100 shadow-sm">
                            <!-- Logo/Gambar UMKM -->
                            <div class="position-relative">
                                @if ($b->media && $b->media->count() > 0)
                                    <img src="{{ Storage::url($b->media->first()->file_url) }}" class="card-img-top"
                                        alt="{{ $b->nama_usaha }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white"
                                        style="height: 200px;">
                                        <i class="fa fa-store fa-3x"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary">{{ $b->kategori }}</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $b->nama_usaha }}</h5>
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-user me-1"></i>
                                        {{ $b->pemilik->nama }}
                                    </small>
                                </div>
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fa fa-phone me-1"></i>
                                        {{ $b->kontak }}
                                    </small>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="fa fa-map-marker me-1"></i>
                                        RT {{ $b->rt }}/RW {{ $b->rw }}
                                    </small>
                                </div>

                                @if ($b->deskripsi)
                                    <p class="card-text flex-grow-1">
                                        {{ Str::limit($b->deskripsi, 100) }}
                                    </p>
                                @endif

                                <div class="mt-auto">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('binadesa.show', $b) }}" class="btn btn-outline-primary btn-sm"
                                            title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('binadesa.edit', $b) }}" class="btn btn-outline-primary btn-sm"
                                            title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('binadesa.destroy', $b) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-primary btn-sm" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent">
                                <small class="text-muted">
                                    Dibuat: {{ $b->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa fa-store fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada data UMKM</h5>
                            <p class="text-muted">Mulai dengan menambahkan UMKM baru</p>
                            <a href="{{ route('binadesa.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah UMKM Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Info Jumlah Data -->
            <div class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $binadesa->count() }} UMKM
                </small>
            </div>
        </div>
    </div>
    <!-- UMKM Card View End -->
@endsection
