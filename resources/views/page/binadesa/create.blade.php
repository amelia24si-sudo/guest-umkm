<section class="py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('binadesa.index') }}" class="text-decoration-none">
                                        <i class="fa fa-building me-1"></i>UMKM/Binadesa
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Tambah UMKM/Binadesa
                                </li>
                            </ol>
                        </nav>
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fa fa-plus-circle me-2 text-primary"></i>Tambah UMKM/Binadesa Baru
                        </h4>
                    </div>
                    <a href="{{ route('binadesa.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <p class="text-muted mb-0 mt-1">Lengkapi form di bawah untuk menambahkan UMKM/Binadesa baru</p>
            </div>

            <!-- Form Card -->
            <div class="card-body p-4">
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

                <form action="{{ route('binadesa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Section 1: Informasi Dasar UMKM -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-info-circle fa-lg"></i>
                            </div>&nbsp;
                            <h5 class="mb-0 fw-bold text-dark">Informasi Dasar UMKM/Binadesa</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-store me-1"></i>Nama Usaha
                                    <span class="text-danger"></span>
                                </label>
                                <input type="text" name="nama_usaha" class="form-control"
                                    value="{{ old('nama_usaha') }}" placeholder="Masukkan nama usaha" required>
                                <small class="form-text text-muted">
                                    <i class="fa fa-lightbulb me-1"></i>
                                    Masukkan nama usaha atau bisnis yang akan didaftarkan
                                </small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user me-1"></i>Pemilik Warga
                                    <span class="text-danger"></span>
                                </label>
                                <select name="pemilik_warga_id" class="form-select" id="inputselect" required>
                                    <option value="" selected disabled>-- Pilih Pemilik --</option>
                                    <!-- Di bagian select option -->
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                            data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                            data-telp="{{ $w->telp }}""
                                            {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} - {{ $w->no_ktp }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    <i class="fa fa-info-circle me-1"></i>
                                    Pilih warga yang menjadi pemilik usaha
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Alamat Usaha -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-map-marker-alt fa-lg"></i>
                            </div>&nbsp;
                            <h5 class="mb-0 fw-bold text-dark">Alamat Usaha</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-map me-1"></i>Alamat Lengkap
                                    <span class="text-danger"></span>
                                </label>
                                <textarea name="alamat" class="form-control" rows="3" required placeholder="Masukkan alamat lengkap usaha"
                                    id="alamat">{{ old('alamat') }}</textarea>
                                <small class="form-text text-muted">
                                    <i class="fa fa-tips me-1"></i>
                                    Masukkan alamat lengkap lokasi usaha
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-home me-1"></i>RT
                                    <span class="text-danger"></span>
                                </label>
                                <input type="text" name="rt" class="form-control" value="{{ old('rt') }}"
                                    placeholder="RT" id="rt" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-home me-1"></i>RW
                                    <span class="text-danger"></span>
                                </label>
                                <input type="text" name="rw" class="form-control"
                                    value="{{ old('rw') }}" placeholder="RW" id="rw" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-tags me-1"></i>Kategori Usaha
                                    <span class="text-danger"></span>
                                </label>
                                <select name="kategori" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Kategori --</option>
                                    <option value="Makanan & Minuman"
                                        {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>
                                        Makanan & Minuman
                                    </option>
                                    <option value="Kerajinan Tangan"
                                        {{ old('kategori') == 'Kerajinan Tangan' ? 'selected' : '' }}>
                                        Kerajinan Tangan
                                    </option>
                                    <option value="Pertanian" {{ old('kategori') == 'Pertanian' ? 'selected' : '' }}>
                                        Pertanian
                                    </option>
                                    <option value="Peternakan"
                                        {{ old('kategori') == 'Peternakan' ? 'selected' : '' }}>
                                        Peternakan
                                    </option>
                                    <option value="Jasa" {{ old('kategori') == 'Jasa' ? 'selected' : '' }}>
                                        Jasa
                                    </option>
                                    <option value="Perdagangan"
                                        {{ old('kategori') == 'Perdagangan' ? 'selected' : '' }}>
                                        Perdagangan
                                    </option>
                                    <option value="Industri Kecil"
                                        {{ old('kategori') == 'Industri Kecil' ? 'selected' : '' }}>
                                        Industri Kecil
                                    </option>
                                    <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya
                                    </option>
                                </select>
                                <small class="form-text text-muted">
                                    Pilih kategori yang sesuai dengan usaha
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Kontak & Logo -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-phone-alt fa-lg"></i>
                            </div>&nbsp;
                            <h5 class="mb-0 fw-bold text-dark">Kontak & Identitas</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-phone me-1"></i>Kontak
                                    <span class="text-danger"></span>
                                </label>
                                <input type="text" name="kontak" class="form-control"
                                    value="{{ old('kontak') }}" placeholder="Nomor HP/WhatsApp" required
                                    id="telp">
                                <small class="form-text text-muted">
                                    Masukkan nomor kontak yang dapat dihubungi
                                </small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-camera me-1"></i>Logo Usaha
                                </label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <small class="form-text text-muted">
                                    <i class="fa fa-info-circle me-1"></i>
                                    Format: JPG, PNG, JPEG, GIF. Maksimal 2MB
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Deskripsi -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-file-alt fa-lg"></i>
                            </div>&nbsp;
                            <h5 class="mb-0 fw-bold text-dark">Deskripsi Usaha</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-align-left me-1"></i>Deskripsi Usaha
                            </label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan usaha secara detail...">{{ old('deskripsi') }}</textarea>
                            <small class="form-text text-muted">
                                <i class="fa fa-tips me-1"></i>
                                Jelaskan jenis usaha, produk/jasa yang ditawarkan, dan keunggulan usaha
                            </small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0">
                                    <i class="fa fa-exclamation-circle me-1"></i>
                                    Field dengan tanda <span class="text-danger">*</span> wajib diisi
                                </p>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('binadesa.index') }}" class="btn btn-primary">
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
