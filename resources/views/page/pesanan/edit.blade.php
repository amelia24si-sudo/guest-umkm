<style>
    .col-md-2.mb-3 {
        padding-left: 10px;
        padding-right: 10px;
    }

    /* Label styling */
    .col-md-2.mb-3 .form-label {
        font-size: 0.9rem;
        font-weight: 700;
        color: #222831;
        margin-bottom: 0.75rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .col-md-2.mb-3 .form-label .fa {
        color: #ffbe33;
        font-size: 0.9rem;
        margin-right: 6px;
    }

    /* Input Group Container */
    .col-md-2.mb-3 .input-group.input-group-lg {
        height: 60px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .col-md-2.mb-3 .input-group.input-group-lg:hover,
    .col-md-2.mb-3 .input-group.input-group-lg:focus-within {
        border-color: #ffbe33;
        box-shadow: 0 4px 12px rgba(255, 190, 51, 0.15);
        transform: translateY(-2px);
    }

    /* Quantity Controls */
    .col-md-2.mb-3 .input-group.input-group-lg .btn {
        width: 50px;
        background: linear-gradient(135deg, #222831 0%, #1a1e24 100%);
        border: none;
        color: #ffffff;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .btn:hover {
        background: linear-gradient(135deg, #ffbe33 0%, #ffaa00 100%);
        color: #222831;
        transform: scale(1.05);
    }

    .col-md-2.mb-3 .input-group.input-group-lg .btn:active {
        transform: scale(0.95);
    }

    /* Quantity Input Field */
    .col-md-2.mb-3 .input-group.input-group-lg .qty-input {
        height: 56px;
        font-size: 1.4rem;
        font-weight: 800;
        color: #222831;
        text-align: center;
        background: #ffffff;
        border-left: 2px solid #e0e0e0;
        border-right: 2px solid #e0e0e0;
        border-top: none;
        border-bottom: none;
        padding: 0.5rem;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .qty-input:focus {
        background: #fff9f0;
        box-shadow: inset 0 0 0 2px #ffbe33;
        color: #222831;
    }

    /* Harga Satuan Input */
    .col-md-2.mb-3 .input-group.input-group-lg .harga-input {
        height: 56px;
        font-size: 1.3rem;
        font-weight: 700;
        color: #222831;
        padding: 0.75rem 1rem;
        background: #f9f9f9;
        border: none;
        text-align: right;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .harga-input:focus {
        background: #ffffff;
        color: #222831;
        box-shadow: inset 0 0 0 2px #ffbe33;
    }

    /* Harga Satuan Input Group Text */
    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-primary {
        background: linear-gradient(135deg, #ffbe33 0%, #ffaa00 100%) !important;
        border: none;
        color: #222831;
        font-size: 1.1rem;
        font-weight: 700;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-primary .fa {
        font-size: 1.2rem;
    }

    /* Subtotal Input */
    .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
        height: 56px;
        font-size: 1.4rem;
        font-weight: 900;
        color: #222831;
        padding: 0.75rem 1rem;
        background: linear-gradient(135deg, #fff9f0 0%, #fff3e0 100%);
        border: none;
        text-align: right;
        letter-spacing: 0.5px;
    }

    /* Subtotal Input Group Text */
    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-success {
        background: linear-gradient(135deg, #222831 0%, #1a1e24 100%) !important;
        border: none;
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 700;
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-success .fa {
        font-size: 1.2rem;
    }

    /* Small Text Below */
    .col-md-2.mb-3 .form-text {
        font-size: 0.8rem;
        color: #666666;
        margin-top: 0.5rem;
        padding-left: 5px;
        padding-right: 5px;
        font-style: italic;
        line-height: 1.3;
    }

    .col-md-2.mb-3 .form-text .fa {
        color: #ffbe33;
        font-size: 0.8rem;
        margin-right: 5px;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .col-md-2.mb-3 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }

    @media (max-width: 992px) {
        .col-md-2.mb-3 {
            flex: 0 0 50%;
            max-width: 50%;
            margin-bottom: 1.5rem !important;
        }

        .col-md-2.mb-3 .input-group.input-group-lg {
            height: 55px;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .qty-input,
        .col-md-2.mb-3 .input-group.input-group-lg .harga-input,
        .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
            height: 51px;
            font-size: 1.2rem;
        }
    }

    @media (max-width: 768px) {
        .col-md-2.mb-3 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }

        .col-md-2.mb-3 .input-group.input-group-lg {
            height: 52px;
            max-width: 300px;
            margin: 0 auto;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .qty-input,
        .col-md-2.mb-3 .input-group.input-group-lg .harga-input,
        .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
            height: 48px;
            font-size: 1.1rem;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .btn,
        .col-md-2.mb-3 .input-group.input-group-lg .input-group-text {
            width: 45px;
            font-size: 1rem;
        }
    }

    /* Animation for value changes */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .col-md-2.mb-3 .input-group.input-group-lg .qty-input:focus,
    .col-md-2.mb-3 .input-group.input-group-lg .harga-input:focus {
        animation: pulse 0.3s ease;
    }

    /* Remove spin buttons for number inputs */
    .col-md-2.mb-3 input[type="number"]::-webkit-inner-spin-button,
    .col-md-2.mb-3 input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .col-md-2.mb-3 input[type="number"] {
        -moz-appearance: textfield;
    }

    /* Hover effects for entire column */
    .col-md-2.mb-3:hover .form-label {
        color: #ffbe33;
    }

    .col-md-2.mb-3:hover .form-text {
        color: #222831;
    }

    /* Container untuk kolom Quantity, Harga Satuan, dan Subtotal */
    .col-md-2.mb-3 {
        padding-left: 8px;
        padding-right: 8px;
    }

    /* Label styling - match dengan "Pilih Produk" */
    .col-md-2.mb-3 .form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #222831;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
    }

    .col-md-2.mb-3 .form-label .fa {
        color: #ffbe33;
        font-size: 0.85rem;
        margin-right: 6px;
        width: 16px;
        text-align: center;
    }

    /* Input Group Container - match dengan select produk */
    .col-md-2.mb-3 .input-group.input-group-lg {
        height: 48px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
        background-color: #ffffff;
    }

    .col-md-2.mb-3 .input-group.input-group-lg:hover {
        border-color: #ffbe33;
        box-shadow: 0 2px 8px rgba(255, 190, 51, 0.1);
    }

    /* Quantity Controls - remove background color */
    .col-md-2.mb-3 .input-group.input-group-lg .btn {
        width: 45px;
        background: transparent !important;
        border: none;
        color: #222831;
        font-size: 1rem;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .btn:hover {
        color: #ffbe33;
        background-color: #fff9f0 !important;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .btn:active {
        background-color: #f0f0f0 !important;
    }

    /* Quantity Input Field - match dengan select produk */
    .col-md-2.mb-3 .input-group.input-group-lg .qty-input {
        height: 44px;
        font-size: 1rem;
        font-weight: 600;
        color: #222831;
        text-align: center;
        background: #ffffff;
        border: none;
        border-left: 1px solid #e0e0e0;
        border-right: 1px solid #e0e0e0;
        padding: 0.5rem;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .qty-input:focus {
        background: #ffffff;
        box-shadow: none;
        color: #222831;
    }

    /* Harga Satuan Input - match dengan select produk */
    .col-md-2.mb-3 .input-group.input-group-lg .harga-input {
        height: 44px;
        font-size: 1rem;
        font-weight: 600;
        color: #222831;
        padding: 0.5rem 0.75rem;
        background: #ffffff;
        border: none;
        text-align: right;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .harga-input:focus {
        background: #ffffff;
        color: #222831;
        box-shadow: none;
    }

    /* Harga Satuan Input Group Text - match dengan warna tema */
    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-primary {
        background: #222831 !important;
        border: none;
        color: #ffffff !important;
        font-size: 0.9rem;
        font-weight: 600;
        width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-primary .fa {
        font-size: 1rem;
        color: #ffffff !important;
    }

    /* Subtotal Input - match dengan select produk */
    .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
        height: 44px;
        font-size: 1rem;
        font-weight: 700;
        color: #222831;
        padding: 0.5rem 0.75rem;
        background: #ffffff;
        border: none;
        text-align: right;
        letter-spacing: 0.3px;
    }

    /* Subtotal Input Group Text - make white text */
    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-success {
        background: #222831 !important;
        border: none;
        color: #ffffff !important;
        font-size: 0.9rem;
        font-weight: 600;
        width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .input-group-text.bg-success .fa {
        font-size: 1rem;
        color: #ffffff !important;
    }

    /* Small Text Below - match dengan deskripsi produk */
    .col-md-2.mb-3 .form-text {
        font-size: 0.75rem;
        color: #666666;
        margin-top: 0.4rem;
        padding-left: 3px;
        padding-right: 3px;
        line-height: 1.2;
        font-style: normal;
    }

    .col-md-2.mb-3 .form-text .fa {
        color: #ffbe33;
        font-size: 0.75rem;
        margin-right: 4px;
        width: 12px;
        text-align: center;
    }

    /* Match the spacing dengan kolom produk */
    .col-md-5.mb-3 .form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #222831;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .col-md-5.mb-3 .form-select {
        height: 48px;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        font-size: 1rem;
        font-weight: 600;
        color: #222831;
        background-color: #ffffff;
        padding: 0.5rem 0.75rem;
    }

    .col-md-5.mb-3 .form-select:focus {
        border-color: #ffbe33;
        box-shadow: 0 0 0 0.25rem rgba(255, 190, 51, 0.25);
    }

    .col-md-5.mb-3 .form-text {
        font-size: 0.75rem;
        color: #666666;
        margin-top: 0.4rem;
        line-height: 1.2;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .col-md-2.mb-3 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }

    @media (max-width: 992px) {
        .col-md-2.mb-3 {
            flex: 0 0 50%;
            max-width: 50%;
            margin-bottom: 1rem !important;
        }

        .col-md-2.mb-3 .input-group.input-group-lg {
            height: 46px;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .qty-input,
        .col-md-2.mb-3 .input-group.input-group-lg .harga-input,
        .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
            height: 42px;
            font-size: 0.95rem;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .btn,
        .col-md-2.mb-3 .input-group.input-group-lg .input-group-text {
            width: 42px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .col-md-2.mb-3 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
            margin-bottom: 1.25rem !important;
        }

        .col-md-2.mb-3 .input-group.input-group-lg {
            height: 44px;
            max-width: 100%;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .qty-input,
        .col-md-2.mb-3 .input-group.input-group-lg .harga-input,
        .col-md-2.mb-3 .input-group.input-group-lg .subtotal-input {
            height: 40px;
            font-size: 0.9rem;
        }

        .col-md-2.mb-3 .input-group.input-group-lg .btn,
        .col-md-2.mb-3 .input-group.input-group-lg .input-group-text {
            width: 40px;
            font-size: 0.85rem;
        }
    }

    /* Remove number input spinners */
    .col-md-2.mb-3 input[type="number"]::-webkit-inner-spin-button,
    .col-md-2.mb-3 input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .col-md-2.mb-3 input[type="number"] {
        -moz-appearance: textfield;
    }

    /* Focus states */
    .col-md-2.mb-3 .input-group.input-group-lg:focus-within {
        border-color: #ffbe33;
        box-shadow: 0 0 0 0.25rem rgba(255, 190, 51, 0.25);
    }

    /* Border between buttons and input */
    .col-md-2.mb-3 .input-group.input-group-lg .btn-decrement {
        border-right: 1px solid #e0e0e0;
    }

    .col-md-2.mb-3 .input-group.input-group-lg .btn-increment {
        border-left: 1px solid #e0e0e0;
    }

    /* Disabled state for buttons */
    .col-md-2.mb-3 .input-group.input-group-lg .btn:disabled {
        color: #cccccc;
        background-color: #f9f9f9 !important;
        cursor: not-allowed;
    }

    /* Active state for buttons */
    .col-md-2.mb-3 .input-group.input-group-lg .btn:active:not(:disabled) {
        background-color: #f0f0f0 !important;
    }
</style>
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
                                        {{ $pesanan->nomor_pesanan }}
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
                            Mengedit pesanan: <span class="fw-semibold">{{ $pesanan->nomor_pesanan }}</span>
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

                    <!-- Section 1: Informasi Warga -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-user"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Informasi Pemesan</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-user me-1"></i>Warga
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="warga_id" class="form-select form-control-lg" id="inputselect"
                                        required>
                                        <option value="" disabled>-- Pilih Warga --</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                                data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                                data-telp="{{ $w->telp }}"
                                                {{ old('warga_id', $pesanan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-info-circle me-1"></i>
                                        Pilih warga yang melakukan pemesanan
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-wallet me-1"></i>Metode Pembayaran
                                        <span class="text-danger"></span>
                                    </label>
                                    <select name="metode_bayar" class="form-select form-control-lg" required>
                                        <option value="" disabled>-- Pilih Metode --</option>
                                        <option value="transfer"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'transfer' ? 'selected' : '' }}>
                                            Transfer Bank
                                        </option>
                                        <option value="cod"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'cod' ? 'selected' : '' }}>
                                            Cash on Delivery (COD)
                                        </option>
                                        <option value="tunai"
                                            {{ old('metode_bayar', $pesanan->metode_bayar) == 'tunai' ? 'selected' : '' }}>
                                            Tunai
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-lightbulb me-1"></i>
                                        Pilih metode pembayaran yang digunakan
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Alamat Pengiriman -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Alamat Pengiriman</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-home me-1"></i>Alamat Lengkap
                                <span class="text-danger"></span>
                            </label>
                            <textarea name="alamat_kirim" class="form-control" rows="3" id="alamat" required>{{ old('alamat_kirim', $pesanan->alamat_kirim) }}</textarea>
                            <div class="form-text">
                                <i class="fa fa-tips me-1"></i>
                                Alamat lengkap pengiriman
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-map-pin me-1"></i>RT
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="rt" class="form-control form-control-lg"
                                        value="{{ old('rt', $pesanan->rt) }}" id="rt"required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-map-pin me-1"></i>RW
                                        <span class="text-danger"></span>
                                    </label>
                                    <input type="text" name="rw" class="form-control form-control-lg"
                                        value="{{ old('rw', $pesanan->rw) }}" id="rw" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Detail Produk Pesanan - DIPERBAIKI -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Detail Produk Pesanan</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Container untuk produk yang dipilih -->
                        <div id="produk-container">
                            @foreach ($pesanan->detailPesanan as $index => $detail)
                                <div class="produk-item card mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 mb-3">
                                                <label class="form-label fw-semibold">
                                                    <i class="fa fa-box me-1"></i>Produk
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="form-group">
                                                    <select name="produk_id[]" class="form-select produk-select"
                                                        required>
                                                        <option value="" selected disabled>-- Pilih
                                                            Produk --</option>
                                                        @foreach ($produk as $p)
                                                            <option value="{{ $p->produk_id }}"
                                                                data-harga="{{ $p->harga }}"
                                                                data-stok="{{ $p->stok }}"
                                                                data-nama="{{ $p->nama_produk }}"
                                                                {{ $detail->produk_id == $p->produk_id ? 'selected' : '' }}>
                                                                {{ $p->nama_produk }} - Rp
                                                                {{ number_format($p->harga, 0, ',', '.') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- Info Produk -->
                                                <div class="produk-info mt-2 p-2 bg-light rounded">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <small class="text-muted">
                                                                <i class="fa fa-layer-group me-1"></i>
                                                                Stok: <span
                                                                    class="stok-info">{{ $detail->produk->stok ?? 0 }}</span>
                                                            </small>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <small class="text-muted">
                                                                <i class="fa fa-money-bill-wave me-1"></i>
                                                                Harga: <span class="harga-info">Rp
                                                                    {{ number_format($detail->harga_satuan, 0, ',', '.') }}</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label class="form-label fw-semibold">
                                                    <i class="fa fa-hashtag me-1"></i>Quantity
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="input-group input-group-lg">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-decrement">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input type="number" name="qty[]"
                                                        class="form-control text-center qty-input" min="1"
                                                        value="{{ $detail->qty }}" required>
                                                    <button type="button"
                                                        class="btn btn-outline-secondary btn-increment">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                                <small class="form-text text-muted mt-2">
                                                    <i class="fa fa-lightbulb me-1"></i>
                                                    Jmlh barang yang dipesan
                                                </small>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label class="form-label fw-semibold">
                                                    <i class="fa fa-tag me-1"></i>Harga Satuan
                                                    <span class="text-danger"></span>
                                                </label>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="fa fa-rupiah-sign"></i>
                                                    </span>
                                                    <input type="number" name="harga_satuan[]"
                                                        class="form-control harga-input" min="0"
                                                        step="0.01" value="{{ $detail->harga_satuan }}" required>
                                                </div>
                                                <small class="form-text text-muted mt-2">
                                                    <i class="fa fa-lightbulb me-1"></i>
                                                    Harga per unit produk
                                                </small>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label class="form-label fw-semibold">
                                                    <i class="fa fa-calculator me-1"></i>Subtotal
                                                </label>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text bg-success text-white">
                                                        <i class="fa fa-rupiah-sign"></i>
                                                    </span>
                                                    <input type="text" class="form-control subtotal-input"
                                                        value="Rp {{ number_format($detail->subtotal, 0, ',', '.') }}"
                                                        readonly>
                                                </div>
                                                <small class="form-text text-muted mt-2">
                                                    <i class="fa fa-calculator me-1"></i>
                                                    Qty × Harga Satuan
                                                </small>
                                            </div>

                                            <div class="col-md-1 mb-3 text-center">
                                                <label class="form-label fw-semibold">&nbsp;</label>
                                                <button type="button" class="btn btn-danger btn-lg hapus-produk"
                                                    title="Hapus Produk">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <small class="form-text text-muted mt-2 d-block">
                                                    Hapus item
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Template untuk produk baru (hidden) -->
                        <template id="produk-template">
                            <div class="produk-item card mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-box me-1"></i>Produk
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="form-group">
                                                <select name="produk_id[]"
                                                    class="form-select produk-select" required>
                                                    <option value="" selected disabled>-- Pilih Produk --
                                                    </option>
                                                    @foreach ($produk as $p)
                                                        <option value="{{ $p->produk_id }}"
                                                            data-harga="{{ $p->harga }}"
                                                            data-stok="{{ $p->stok }}"
                                                            data-nama="{{ $p->nama_produk }}">
                                                            {{ $p->nama_produk }} - Rp
                                                            {{ number_format($p->harga, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- <span class="input-group-text bg-light">
                                                    <i class="fa fa-info-circle text-primary" id="info-icon-new"></i>
                                                </span> --}}
                                            </div>
                                            <!-- Info Produk (akan diisi oleh JavaScript) -->
                                            <div class="produk-info mt-2 p-2 bg-light rounded" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <small class="text-muted">
                                                            <i class="fa fa-layer-group me-1"></i>
                                                            Stok: <span class="stok-info">0</span>
                                                        </small>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <small class="text-muted">
                                                            <i class="fa fa-money-bill-wave me-1"></i>
                                                            Harga: <span class="harga-info">Rp 0</span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted mt-2">
                                                <i class="fa fa-info-circle me-1"></i>
                                                Pilih produk yang ingin dipesan
                                            </small>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-hashtag me-1"></i>Quantity
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-decrement">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="number" name="qty[]"
                                                    class="form-control text-center qty-input" min="1"
                                                    value="1" required>
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-increment">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <small class="form-text text-muted mt-2">
                                                <i class="fa fa-lightbulb me-1"></i>
                                                Jmlh barang yang dipesan
                                            </small>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-tag me-1"></i>Harga Satuan
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-primary text-white">
                                                    <i class="fa fa-rupiah-sign"></i>
                                                </span>
                                                <input type="number" name="harga_satuan[]"
                                                    class="form-control harga-input" min="0" step="0.01"
                                                    required>
                                            </div>
                                            <small class="form-text text-muted mt-2">
                                                <i class="fa fa-lightbulb me-1"></i>
                                                Harga per unit produk
                                            </small>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-calculator me-1"></i>Subtotal
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="fa fa-rupiah-sign"></i>
                                                </span>
                                                <input type="text" class="form-control subtotal-input" readonly>
                                            </div>
                                            <small class="form-text text-muted mt-2">
                                                <i class="fa fa-calculator me-1"></i>
                                                Qty × Harga Satuan
                                            </small>
                                        </div>

                                        <div class="col-md-1 mb-3 text-center">
                                            <label class="form-label fw-semibold">&nbsp;</label>
                                            <button type="button" class="btn btn-danger btn-lg hapus-produk"
                                                title="Hapus Produk">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <small class="form-text text-muted mt-2 d-block">
                                                Hapus item
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Tombol Tambah Produk -->
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" id="tambah-produk">
                                <i class="fa fa-plus me-2"></i>Tambah Produk
                            </button>
                        </div>

                        <!-- Total Pesanan -->
                        <div class="row mt-4">
                            <div class="col-md-4 offset-md-8">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fa fa-money-bill-wave me-2"></i>Total Pesanan:
                                            </h6>
                                            <h4 class="mb-0" id="total-pesanan">
                                                Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                            </h4>
                                        </div>
                                        <input type="hidden" name="total" id="total-input"
                                            value="{{ $pesanan->total }}">
                                        <div class="mt-2 text-center">
                                            <small>
                                                <i class="fa fa-info-circle me-1"></i>
                                                Total dari semua produk
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Status Pesanan -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-toggle-on"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Status Pesanan</h5>
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
                                        <option value="pending"
                                            {{ old('status', $pesanan->status) == 'pending' ? 'selected' : '' }}>
                                            <span class="badge bg-warning me-2"></span> Menunggu Pembayaran
                                        </option>
                                        <option value="diproses"
                                            {{ old('status', $pesanan->status) == 'diproses' ? 'selected' : '' }}>
                                            <span class="badge bg-info me-2"></span> Sedang Diproses
                                        </option>
                                        <option value="dikirim"
                                            {{ old('status', $pesanan->status) == 'dikirim' ? 'selected' : '' }}>
                                            <span class="badge bg-primary me-2"></span> Sedang Dikirim
                                        </option>
                                        <option value="selesai"
                                            {{ old('status', $pesanan->status) == 'selesai' ? 'selected' : '' }}>
                                            <span class="badge bg-success me-2"></span> Selesai
                                        </option>
                                        <option value="dibatalkan"
                                            {{ old('status', $pesanan->status) == 'dibatalkan' ? 'selected' : '' }}>
                                            <span class="badge bg-danger me-2"></span> Dibatalkan
                                        </option>
                                    </select>
                                    <small class="form-text text-muted">
                                        <i class="fa fa-lightbulb me-1"></i>
                                        Status pesanan saat ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Bukti Bayar -->
                    <div class="form-section mb-5">
                        <div class="section-header mb-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon">
                                    <i class="fa fa-camera"></i>
                                </div>&nbsp;
                                <h5 class="section-title mb-0 ms-3">Bukti Bayar</h5>
                            </div>
                            <div class="section-divider"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-image me-1"></i>Upload Bukti Bayar Baru (Opsional)
                            </label>
                            <input type="file" name="bukti_bayar" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        </div>

                        @if ($pesanan->buktiBayar)
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">
                                        <i class="fa fa-image me-1"></i>Bukti Bayar Saat Ini
                                    </label>
                                    <div class="d-flex align-items-start">
                                        <div class="me-3">
                                            <img src="{{ asset('storage/' . $pesanan->buktiBayar->file_nama) }}"
                                                alt="Bukti Bayar {{ $pesanan->nomor_pesanan }}"
                                                class="img-thumbnail border border-3 border-primary"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-2">
                                                <strong>Bukti bayar saat ini</strong>
                                            </p>
                                            <div class="btn-group">
                                                <a href="{{ asset('storage/' . $pesanan->buktiBayar->file_nama) }}"
                                                    target="_blank" class="btn btn-sm btn-outline-info">
                                                    <i class="fa fa-expand me-1"></i>Lihat Full
                                                </a>
                                                <form action="{{ route('pesanan.hapus-bukti', $pesanan) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="media_id"
                                                        value="{{ $pesanan->buktiBayar->media_id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus bukti bayar ini?')">
                                                        <i class="fa fa-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
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
                                            <strong>Perhatian!</strong> Pesanan ini belum memiliki bukti bayar.
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
                                        <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
                                            <i class="fa fa-times me-2"></i>Batal
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-2"></i>Simpan Perubahan
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
