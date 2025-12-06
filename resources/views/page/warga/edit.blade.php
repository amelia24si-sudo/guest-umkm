<section class="py-4">
    <div class="container-fluid">
        <div class="card border-0 shadow-lg">
            <!-- Header Card -->
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('warga.index') }}" class="text-decoration-none">
                                        <i class="fa fa-users me-1"></i>Data Warga
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Edit Warga</li>
                            </ol>
                        </nav>
                        <h4 class="mb-0 fw-bold">
                            <i class="fa fa-user-edit me-2 text-primary"></i>Edit Data Warga
                        </h4>
                    </div>
                    <a href="{{ route('warga.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <p class="text-muted mb-0 mt-2">Perbarui data warga di bawah ini</p>
            </div>

            <!-- Form Card -->
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
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

                <form action="{{ route('warga.update', $warga) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Identitas Dasar -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-id-card fa-lg"></i>
                            </div>
                            &nbsp;
                            <h5 class="mb-0 fw-bold">Identitas Dasar</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-hashtag me-1"></i>NIK <span class="text-danger"></span>
                                </label>
                                <input type="text" name="no_ktp" class="form-control"
                                    value="{{ old('no_ktp', $warga->no_ktp) }}" placeholder="Masukkan 16 digit NIK"
                                    required maxlength="16" pattern="[0-9]{16}" title="NIK harus 16 digit angka">
                                <small class="form-text text-muted">
                                    <i class="fa fa-info-circle me-1"></i>16 digit angka
                                </small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-user me-1"></i>Nama Lengkap <span class="text-danger"></span>
                                </label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $warga->nama) }}" placeholder="Masukkan nama lengkap"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Pribadi -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-user-circle fa-lg"></i>
                            </div>
                            &nbsp;
                            <h5 class="mb-0 fw-bold">Data Pribadi</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-venus-mars me-1"></i>Jenis Kelamin <span class="text-danger"></span>
                                </label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="" disabled>Pilih Jenis Kelamin</option>
                                    <option value="L"
                                        {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-pray me-1"></i>Agama <span class="text-danger"></span>
                                </label>
                                <select name="agama" class="form-select" required>
                                    <option value="" disabled>Pilih Agama</option>
                                    <option value="Islam"
                                        {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen"
                                        {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik"
                                        {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu"
                                        {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha"
                                        {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu"
                                        {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-briefcase me-1"></i>Pekerjaan <span class="text-danger"></span>
                                </label>
                                <input type="text" name="pekerjaan" class="form-control"
                                    value="{{ old('pekerjaan', $warga->pekerjaan) }}" placeholder="Masukkan pekerjaan"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Kontak -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-address-book fa-lg"></i>
                            </div>
                            &nbsp;
                            <h5 class="mb-0 fw-bold">Kontak</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-phone me-1"></i>Nomor Telepon <span class="text-danger"></span>
                                </label>
                                <input type="text" name="telp" class="form-control"
                                    value="{{ old('telp', $warga->telp) }}" placeholder="Masukkan nomor telepon"
                                    required pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                                <small class="form-text text-muted">
                                    <i class="fa fa-whatsapp me-1"></i>Dapat digunakan untuk WhatsApp
                                </small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-envelope me-1"></i>Email <span class="text-danger"></span>
                                </label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $warga->email) }}" placeholder="Masukkan alamat email"
                                    required>
                                <small class="form-text text-muted">
                                    <i class="fa fa-at me-1"></i>Email aktif yang dapat dihubungi
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Alamat -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary text-white rounded-circle p-2 me-3">
                                <i class="fa fa-home fa-lg"></i>
                            </div>
                            &nbsp;
                            <h5 class="mb-0 fw-bold">Alamat Tempat Tinggal</h5>
                        </div>
                        <hr class="mb-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fa fa-map-marker-alt me-1"></i>Alamat Lengkap <span
                                    class="text-danger"></span>
                            </label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $warga->alamat) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-hashtag me-1"></i>RT <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="rt" class="form-control"
                                    value="{{ old('rt', $warga->rt) }}" placeholder="Masukkan nomor RT" required
                                    pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fa fa-hashtag me-1"></i>RW <span class="text-danger"></span>
                                </label>
                                <input type="text" name="rw" class="form-control"
                                    value="{{ old('rw', $warga->rw) }}" placeholder="Masukkan nomor RW" required
                                    pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                            </div>
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
                            <div class="d-flex gap-2">
                                <a href="{{ route('warga.index') }}" class="btn btn-primary">
                                    <i class="fa fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
