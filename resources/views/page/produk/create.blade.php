<section class="create-produk-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('produk.index') }}" class="text-decoration-none">
                                        <i class="fa fa-box me-1"></i>Produk
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Produk
                                </li>
                            </ol>
                        </nav>
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fa fa-plus-circle me-2 text-primary"></i>Tambah Produk Baru
                        </h4>
                        <p class="text-muted mb-0 mt-1">Lengkapi form di bawah untuk menambahkan produk baru</p>
                    </div>
                    <a href="{{ route('produk.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-exclamation-triangle fa-lg me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading mb-2">Terdapat kesalahan!</h6>
                                <ul class="mb-0 ps-0">
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

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data"
                    class="produk-form">
                    @csrf

                    <!-- Section 1: Informasi Dasar -->
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
                                        <i class="fa fa-store me-1"></i>UMKM
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="umkm_id" class="form-select form-control-lg" id="inputselect"
                                        required>
                                        <option value="" selected disabled>-- Pilih UMKM --</option>
                                        @foreach ($umkm as $u)
                                            <option value="{{ $u->umkm_id }}"
                                                {{ old('umkm_id') == $u->umkm_id ? 'selected' : '' }}>
                                                {{ $u->nama_usaha }} - {{ $u->pemilik->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted mt-2">
                                        <i class="fa fa-info-circle me-1"></i>
                                        Pilih UMKM pemilik produk
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-tag me-1"></i>Nama Produk
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="nama_produk" class="form-control form-control-lg"
                                        value="{{ old('nama_produk') }}" placeholder="Masukkan nama produk" required >
                                    <small class="form-text text-muted mt-2">
                                        <i class="fa fa-lightbulb me-1"></i>
                                        Gunakan nama yang deskriptif dan mudah diingat
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Deskripsi -->
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
                            <textarea name="deskripsi" class="form-control" rows="5" placeholder="Deskripsikan produk secara detail...">{{ old('deskripsi') }}</textarea>
                            <div class="form-text mt-2">
                                <i class="fa fa-tips me-1"></i>
                                Jelaskan keunggulan, bahan, ukuran, atau informasi penting lainnya
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Harga & Stok -->
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
                                            value="{{ old('harga') }}" min="0" step="0.01"
                                            placeholder="0" required>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        Harga dalam Rupiah
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-cubes me-1"></i>Stok
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-info text-white">
                                            <i class="fa fa-box"></i>
                                        </span>
                                        <input type="number" name="stok" class="form-control"
                                            value="{{ old('stok', 0) }}" min="0" placeholder="0" required>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        Jumlah stok tersedia
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-toggle-on me-1"></i>Status
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="status" class="form-select form-control-lg" required>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                            <span class="badge bg-success me-2"></span> Aktif
                                        </option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                            <span class="badge bg-danger me-2"></span> Nonaktif
                                        </option>
                                    </select>
                                    <small class="form-text text-muted mt-2">
                                        Status tampilan produk
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Foto Produk -->
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
                            <input type="file" name="logo" class="form-control" accept="image/*" style="width: 1120px">
                            <small class="text-muted">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</small>
                        </section>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0">
                                    <i class="fa fa-exclamation-circle me-1"></i>
                                    Field dengan tanda <span class="text-danger">*</span> wajib diisi
                                </p>
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
                </form>
            </div>
        </div>
    </div>
</section>
