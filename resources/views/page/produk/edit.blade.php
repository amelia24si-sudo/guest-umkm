<section class="edit-produk-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Section -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('produk.index') }}" class="text-decoration-none">
                                        <i class="fa fa-box me-1"></i>Produk
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('produk.show', $produk) }}" class="text-decoration-none">
                                        {{ Str::limit($produk->nama_produk, 20) }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Produk
                                </li>
                            </ol>
                        </nav>
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fa fa-edit me-2 text-warning"></i>Edit Produk
                        </h4>
                        <p class="text-muted mb-0 mt-2">
                            Mengedit produk: <span class="fw-semibold">{{ $produk->nama_produk }}</span>
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('produk.show', $produk) }}" class="btn btn-primary">
                            <i class="fa fa-eye me-1"></i>Lihat
                        </a>
                        <a href="{{ route('produk.index') }}" class="btn btn-primary">
                            <i class="fa fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Body Section -->
            <div class="card-body p-4">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-check-circle fa-lg me-3 text-success"></i>
                            <div class="flex-grow-1">
                                <strong>Berhasil!</strong> {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-exclamation-triangle fa-lg me-3 text-danger"></i>
                            <div class="flex-grow-1">
                                <strong>Kesalahan!</strong> Terdapat masalah dengan data yang Anda masukkan.
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <!-- Form Section -->
                <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-info-circle"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Informasi Dasar Produk</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-store me-1"></i>UMKM <span class="text-danger"></span>
                                    </label>
                                    <select name="umkm_id" class="form-select" required>
                                        <option value="" disabled>-- Pilih UMKM --</option>
                                        @foreach ($umkm as $u)
                                            <option value="{{ $u->umkm_id }}"
                                                {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                                {{ $u->nama_usaha }} - {{ $u->pemilik->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        Pilih UMKM pemilik produk ini
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-tag me-1"></i>Nama Produk <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="nama_produk" class="form-control"
                                        value="{{ old('nama_produk', $produk->nama_produk) }}"
                                        placeholder="Masukkan nama produk" required>
                                    <small class="form-text text-muted">
                                        Nama produk yang akan ditampilkan
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="section-icon">
                                        <i class="fa fa-file-alt"></i>
                                    </div>&nbsp;
                                    <h5 class="section-title mb-0 ms-3">Deskripsi Produk</h5>
                                </div>
                                <div class="section-divider"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-align-left me-1"></i>Deskripsi
                                </label>
                                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan produk secara detail...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                <div class="form-text mt-2">
                                    <i class="fa fa-tips me-1"></i>
                                    Jelaskan keunggulan, bahan, ukuran, atau informasi penting lainnya
                                </div>
                            </div>
                        </div>

                        <!-- Price, Stock & Status Section -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="section-icon">
                                        <i class="fa fa-chart-line"></i>
                                    </div>&nbsp;
                                    <h5 class="section-title mb-0 ms-3">Harga & Stok</h5>
                                </div>
                                <div class="section-divider"></div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-money-bill-wave me-1"></i>Harga
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="fa fa-rupiah-sign"></i>
                                            </span>
                                            <input type="number" name="harga" class="form-control"
                                                value="{{ old('harga', $produk->harga) }}" min="0"
                                                step="0.01" required>
                                        </div>
                                        <small class="form-text text-muted">
                                            Harga produk dalam Rupiah
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-cubes me-1"></i>Stok
                                            <span class="text-danger"></span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-info text-white">
                                                <i class="fa fa-box"></i>
                                            </span>
                                            <input type="number" name="stok" class="form-control"
                                                value="{{ old('stok', $produk->stok) }}" min="0" required>
                                        </div>
                                        <small class="form-text text-muted">
                                            Jumlah stok yang tersedia
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-toggle-on me-1"></i>Status
                                            <span class="text-danger"></span>
                                        </label>
                                        <select name="status" class="form-select" required>
                                            <option value="aktif"
                                                {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>
                                                <i class="fa fa-circle text-success me-1"></i> Aktif
                                            </option>
                                            <option value="nonaktif"
                                                {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>
                                                <i class="fa fa-circle text-danger me-1"></i> Nonaktif
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">
                                            Status tampilan produk
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Photo Section -->
                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="section-icon">
                                        <i class="fa fa-camera"></i>
                                    </div>&nbsp;
                                    <h5 class="section-title mb-0 ms-3">Foto Produk</h5>
                                </div>
                                <div class="section-divider"></div>
                            </div>

                            <section class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-image me-1"></i>Upload Foto Produk
                                </label>
                                <input type="file" name="logo" class="form-control" accept="image/*"
                                    style="width: 1120px">
                                <small class="text-muted">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</small>
                            </section>
                        </div>

                        @if ($produk->media->count() > 0)
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-image me-1"></i>Foto Saat Ini
                                    </label>
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            <img src="{{ asset('storage/' . $produk->media->first()->file_url) }}"
                                                alt="{{ $produk->nama_produk }}"
                                                class="img-thumbnail border border-3 border-primary"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-2">
                                                <strong>Foto produk saat ini</strong>
                                            </p>
                                            <div class="btn-group">
                                                <a href="{{ asset('storage/' . $produk->media->first()->file_url) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-expand me-1"></i>Lihat Full
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deletePhotoModal">
                                                    <i class="fa fa-trash me-1"></i>Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 mb-3">
                                <div class="alert alert-warning border-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-exclamation-triangle fa-lg me-3"></i>
                                        <div>
                                            <strong>Perhatian!</strong> Produk ini belum memiliki foto.
                                            Sebaiknya tambahkan foto untuk tampilan yang lebih baik.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-4 mt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        <i class="fa fa-exclamation-circle me-1"></i>
                                        Field dengan tanda <span class="text-danger">*</span> wajib diisi
                                    </div>
                                    <div class="action-buttons">
                                        <a href="{{ route('produk.index') }}" class="btn btn-primary">
                                            <i class="fa fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Simpan Produk
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Delete Photo Modal -->
@if ($produk->media->count() > 0)
    <div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deletePhotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePhotoModalLabel">
                        <i class="fa fa-exclamation-triangle me-2"></i>Konfirmasi Hapus Foto
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus foto produk ini?</p>
                    <div class="text-center my-3">
                        <img src="{{ asset('storage/' . $produk->media->first()->file_url) }}"
                            alt="{{ $produk->nama_produk }}" class="img-fluid rounded border"
                            style="max-height: 200px;">
                    </div>
                    <p class="text-muted small mb-0">
                        Foto yang dihapus tidak dapat dikembalikan. Pastikan Anda telah membuat backup jika diperlukan.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i>Batal
                    </button>
                    <form action="{{ route('produk.delete-photo', $produk) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash me-1"></i>Hapus Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
