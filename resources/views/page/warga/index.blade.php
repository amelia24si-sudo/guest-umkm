@extends('layout.dashboard.app')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Warga</p>
                        <h6 class="mb-0">{{ $warga->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-male fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Laki-laki</p>
                        <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'L')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-female fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Perempuan</p>
                        <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'P')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-store fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pemilik UMKM</p>
                        <h6 class="mb-0">{{ $warga->filter(function ($w) {return $w->umkm->count() > 0;})->count() }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->

    <!-- Warga Card View Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Warga</h6>
                <a href="{{ route('warga.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-2"></i>Tambah Warga
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Options -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" id="searchWarga" class="form-control" placeholder="Cari nama warga...">
                </div>
                <div class="col-md-3">
                    <select id="genderFilter" class="form-select">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="pekerjaanFilter" class="form-select">
                        <option value="">Semua Pekerjaan</option>
                        @foreach ($warga->pluck('pekerjaan')->unique()->filter() as $pekerjaan)
                            <option value="{{ $pekerjaan }}">{{ $pekerjaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="umkmFilter" class="form-select">
                        <option value="">Semua</option>
                        <option value="pemilik">Pemilik UMKM</option>
                        <option value="bukan">Bukan Pemilik</option>
                    </select>
                </div>
            </div>

            <!-- Card View -->
            <div class="row" id="wargaCards">
                @forelse($warga as $index => $w)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4 warga-card" data-name="{{ strtolower($w->nama) }}"
                        data-gender="{{ $w->jenis_kelamin }}" data-pekerjaan="{{ $w->pekerjaan }}"
                        data-umkm="{{ $w->umkm->count() > 0 ? 'pemilik' : 'bukan' }}" data-created="{{ $w->created_at }}">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <!-- Header dengan Avatar dan Info Utama -->
                                <div class="d-flex align-items-start mb-3">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px; font-size: 20px;">
                                            {{ strtoupper(substr($w->nama, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="card-title mb-1">{{ $w->nama }}</h5>
                                        <div class="d-flex flex-wrap gap-1 mb-2">
                                            @if ($w->jenis_kelamin == 'L')
                                                <span class="badge bg-primary">Laki-laki</span>
                                            @else
                                                <span class="badge bg-success">Perempuan</span>
                                            @endif
                                            @if ($w->umkm->count() > 0)
                                                <span class="badge bg-warning">Pemilik UMKM</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Detail -->
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fa fa-id-card me-1"></i>
                                            <strong>NIK:</strong> {{ $w->no_ktp }}
                                        </small>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fa fa-briefcase me-1"></i>
                                            <strong>Pekerjaan:</strong> {{ $w->pekerjaan ?? '-' }}
                                        </small>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fa fa-star me-1"></i>
                                            <strong>Agama:</strong> {{ $w->agama ?? '-' }}
                                        </small>
                                    </div>
                                </div>

                                <!-- Kontak -->
                                <div class="mb-3">
                                    @if ($w->telp)
                                        <div class="mb-1">
                                            <small class="text-muted">
                                                <i class="fa fa-phone me-1"></i>
                                                {{ $w->telp }}
                                            </small>
                                        </div>
                                    @endif
                                    @if ($w->email)
                                        <div>
                                            <small class="text-muted">
                                                <i class="fa fa-envelope me-1"></i>
                                                {{ $w->email }}
                                            </small>
                                        </div>
                                    @endif
                                </div>

                                <!-- UMKM yang Dimiliki -->
                                @if ($w->umkm->count() > 0)
                                    <div class="mb-3">
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
                                    </div>
                                @endif

                                <!-- Tombol Aksi -->
                                <div class="mt-auto">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('warga.show', $w) }}" class="btn btn-outline-primary btn-sm"
                                            title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('warga.edit', $w) }}" class="btn btn-outline-primary btn-sm"
                                            title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $w) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-primary btn-sm" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-transparent">
                                <small class="text-muted">
                                    Terdaftar: {{ $w->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa fa-users fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada data warga</h5>
                            <p class="text-muted">Mulai dengan menambahkan warga baru</p>
                            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah Warga Pertama
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Info Jumlah Data -->
            <div class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $warga->count() }} warga
                </small>
            </div>
        </div>
    </div>
    <!-- Warga Card View End -->

@endsection
