<section class="edit-pesanan-section py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Section -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <nav aria-label="breadcrumb" class="mb-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('pesanan.index') }}" class="text-decoration-none">
                                        <i class="fa fa-shopping-cart me-1"></i>Pesanan
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('pesanan.show', $pesanan) }}" class="text-decoration-none">
                                        #{{ $pesanan->nomor_pesanan }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Edit Pesanan
                                </li>
                            </ol>
                        </nav>
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fa fa-edit me-2 text-warning"></i>Edit Pesanan
                        </h4>
                        <p class="text-muted mb-0 mt-2">
                            Mengedit pesanan: <span class="fw-semibold">#{{ $pesanan->nomor_pesanan }}</span>
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('pesanan.show', $pesanan) }}" class="btn btn-primary">
                            <i class="fa fa-eye me-1"></i>Lihat
                        </a>
                        <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
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
                <form action="{{ route('pesanan.update', $pesanan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information Section -->
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
                                        <i class="fa fa-user me-1"></i>Pelanggan <span class="text-danger"></span>
                                    </label>
                                    <select name="warga_id" class="form-select" required id="inputselect">
                                        <option value="" disabled>-- Pilih Pelanggan --</option>
                                        @foreach ($wargaList as $w)
                                            <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                                data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                                data-telp="{{ $w->telp }}"
                                                {{ old('warga_id', $pesanan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Pilih pelanggan yang melakukan pemesanan
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-money-bill-wave me-1"></i>Total <span
                                            class="text-danger"></span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="fa fa-rupiah-sign"></i>
                                        </span>
                                        <input type="number" name="total" class="form-control"
                                            value="{{ old('total', $pesanan->total) }}" min="0" step="0.01"
                                            required>
                                    </div>
                                    <small class="form-text text-muted">
                                        Total biaya pesanan dalam Rupiah
                                    </small>
                                </div>
                            </div>
                        </div>


                        <!-- Status Section -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-toggle-on me-1"></i>Status <span class="text-danger"></span>
                                    </label>
                                    <select name="status" class="form-select" required>
                                        <option value="menunggu_pembayaran"
                                            {{ old('status', $pesanan->status) == 'menunggu_pembayaran' ? 'selected' : '' }}>
                                            Menunggu Pembayaran
                                        </option>
                                        <option value="diproses"
                                            {{ old('status', $pesanan->status) == 'diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>
                                        <option value="dikirim"
                                            {{ old('status', $pesanan->status) == 'dikirim' ? 'selected' : '' }}>
                                            Dikirim
                                        </option>
                                        <option value="selesai"
                                            {{ old('status', $pesanan->status) == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="dibatalkan"
                                            {{ old('status', $pesanan->status) == 'dibatalkan' ? 'selected' : '' }}>
                                            Dibatalkan
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Status pesanan saat ini
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-credit-card me-1"></i>Metode Bayar <span
                                            class="text-danger"></span>
                                    </label>
                                    <select name="metode_bayar" class="form-select" required>
                                        <option value="transfer"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'transfer' ? 'selected' : '' }}>
                                            Transfer Bank
                                        </option>
                                        <option value="cod"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'cod' ? 'selected' : '' }}>
                                            Cash on Delivery (COD)
                                        </option>
                                        <option value="lainnya"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Metode pembayaran yang digunakan
                                    </small>
                                </div>
                            </div>
                        </div>


                        <!-- Shipping Information Section -->
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
                                <div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-map-marker-alt me-1"></i>Alamat Kirim <span
                                                class="text-danger"></span>
                                        </label>
                                        <textarea name="alamat_kirim" class="form-control" rows="3" required id="alamat">{{ old('alamat_kirim', $pesanan->alamat_kirim) }}</textarea>
                                        <small class="form-text text-muted">
                                            Alamat lengkap pengiriman pesanan
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-hashtag me-1"></i>RT <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="rt" class="form-control"
                                            value="{{ old('rt', $pesanan->rt) }}" required id="rt">
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-hashtag me-1"></i>RW <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="rw" class="form-control"
                                            value="{{ old('rw', $pesanan->rw) }}" required id="rw">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tracking Information Section -->

                        <div class="form-section mb-5">
                            <div class="section-header mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="section-icon">
                                        <i class="fa fa-shipping-fast"></i>
                                    </div>&nbsp;
                                    <h5 class="section-title mb-0 ms-3">Tracking & Bukti</h5>
                                </div>
                                <div class="section-divider"></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <section class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-receipt me-1"></i>Bukti Bayar
                                        </label>
                                        <input type="file" name="bukti_bayar" class="form-control"
                                            accept="image/*" style="width: 550px">
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
                                                value="{{ old('resi_pengiriman', $pesanan->resi_pengiriman) }}"
                                                placeholder="Masukkan nomor resi (jika sudah dikirim)"
                                                style="width: 550px">
                                            <small class="form-text text-muted mt-2">
                                                Nomor resi untuk tracking pengiriman
                                            </small>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Files -->
                        @if ($pesanan->bukti_bayar)
                            <div class="row mb-4">
                                <div class="col-12 mb-3">
                                    <div class="section-header bg-light p-3 rounded">
                                        <h5 class="mb-0">
                                            <i class="fa fa-file-image me-2 text-primary"></i>File Saat Ini
                                        </h5>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold">
                                            <i class="fa fa-image me-1"></i>Bukti Bayar Saat Ini
                                        </label>
                                        <div class="d-flex align-items-start">
                                            <div class="me-3">
                                                <img src="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                                                    alt="Bukti Bayar"
                                                    class="img-thumbnail border border-3 border-primary"
                                                    style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-2">
                                                    <strong>Bukti bayar saat ini</strong>
                                                </p>
                                                <div class="action-buttons">
                                                    <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                                                        target="_blank" class="btn btn-primary">
                                                        <i class="fa fa-expand me-1"></i>Lihat Full
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

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
                                            <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
                                                <i class="fa fa-times me-2"></i>Batal
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save me-2"></i>Simpan Pesanan
                                            </button>
                                        </div>
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
