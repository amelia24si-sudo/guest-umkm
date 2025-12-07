<section class="create-pesanan-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('pesanan.index') }}" class="text-decoration-none">
                                        <i class="fa fa-shopping-cart me-1"></i>Pesanan
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah Pesanan
                                </li>
                            </ol>
                        </nav>
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fa fa-plus-circle me-2 text-primary"></i>Tambah Pesanan Baru
                        </h4>
                        <p class="text-muted mb-0 mt-1">Lengkapi form di bawah untuk menambahkan pesanan baru</p>
                    </div>
                    <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
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

                <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data"
                    class="pesanan-form">
                    @csrf

                    <!-- Section 1: Informasi Dasar -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-info-circle"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Informasi Dasar Pesanan</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-user me-1"></i>Pelanggan
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="warga_id" class="form-select form-control-lg" id="inputselect"required>
                                        <option value="" selected disabled>-- Pilih Pelanggan --</option>
                                        @foreach ($wargaList as $w)
                                        <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                            data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                            data-telp="{{ $w->telp }}""
                                            {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                    </select>
                                    <small class="form-text text-muted mt-2">
                                        <i class="fa fa-info-circle me-1"></i>
                                        Pilih pelanggan yang melakukan pemesanan
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-money-bill-wave me-1"></i>Total
                                        <span class="text-danger"></span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fa fa-rupiah-sign"></i>
                                        </span>
                                        <input type="number" name="total" class="form-control"
                                            value="{{ old('total') }}" min="0" step="0.01"
                                            placeholder="0" required>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        Total biaya pesanan dalam Rupiah
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Status & Pembayaran -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-chart-line"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Status & Pembayaran</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-toggle-on me-1"></i>Status
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="status" class="form-select form-control-lg" required>
                                        <option value="menunggu_pembayaran" {{ old('status') == 'menunggu_pembayaran' ? 'selected' : '' }}>
                                            Menunggu Pembayaran
                                        </option>
                                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                        <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>
                                            Dikirim
                                        </option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>
                                            Dibatalkan
                                        </option>
                                    </select>
                                    <small class="form-text text-muted mt-2">
                                        Status awal pesanan
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-credit-card me-1"></i>Metode Bayar
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="metode_bayar" class="form-select form-control-lg" required>
                                        <option value="transfer" {{ old('metode_bayar') == 'transfer' ? 'selected' : '' }}>
                                            Transfer Bank
                                        </option>
                                        <option value="cod" {{ old('metode_bayar') == 'cod' ? 'selected' : '' }}>
                                            Cash on Delivery (COD)
                                        </option>
                                        <option value="lainnya" {{ old('metode_bayar') == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    <small class="form-text text-muted mt-2">
                                        Metode pembayaran yang digunakan
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Informasi Pengiriman -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-truck"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Informasi Pengiriman</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-map-marker-alt me-1"></i>Alamat Kirim
                                        <span class="text-danger"></span>
                                    </label>
                                    <textarea name="alamat_kirim" class="form-control" rows="3" placeholder="Masukkan alamat lengkap pengiriman..." required id="alamat">{{ old('alamat_kirim') }}</textarea>
                                    <small class="form-text text-muted mt-2">
                                        Alamat lengkap untuk pengiriman pesanan
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-hashtag me-1"></i>RT
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt') }}" placeholder="RT" required id="rt">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-hashtag me-1"></i>RW
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw') }}" placeholder="RW" required id="rw">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Tracking & Bukti -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-shipping-fast"></i>
                                </div>
                                <h5 class="section-title mb-0 ms-3">Tracking & Bukti</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                 <section class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-receipt me-1"></i>Bukti Bayar
                                    </label>
                                    <input type="file" name="bukti_bayar" class="form-control" accept="image/*" style="width: 550px">
                                    <small class="form-text text-muted mt-2">
                                        Format: JPG, PNG, JPEG, GIF. Maksimal 2MB
                                    </small>
                                </section>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <section class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-barcode me-1"></i>Resi Pengiriman
                                    </label>
                                    <input type="text" name="resi_pengiriman" class="form-control"
                                        value="{{ old('resi_pengiriman') }}"
                                        placeholder="Masukkan nomor resi (jika sudah dikirim)" style="width: 550px">
                                    <small class="form-text text-muted mt-2">
                                        Nomor resi untuk tracking pengiriman
                                    </small>
                                    <section>
                                </div>
                            </div>
                        </div>
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
                                <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
                                    <i class="fa fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-2"></i>Simpan Pesanan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
