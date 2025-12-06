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
                                    <a href="{{ route('users.index') }}" class="text-decoration-none">
                                        <i class="fa fa-user-friends me-1"></i>Manajemen User
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </nav>
                        <h4 class="mb-0 fw-bold">
                            <i class="fa fa-user-edit me-2 text-primary"></i>Edit User
                        </h4>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <p class="text-muted mb-0 mt-2">Perbarui data user di bawah ini</p>
            </div>

            <!-- Form Card -->
            <div class="card-body p-4">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="p-4">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Section 1: Informasi Dasar -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle p-2 me-3">
                                            <i class="fa fa-user-circle fa-lg"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold">Informasi Dasar User</h5>
                                    </div>
                                    <hr class="mb-4">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-user me-1"></i>Nama Lengkap <span class="text-danger"></span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                placeholder="Masukkan nama lengkap" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-envelope me-1"></i>Email <span class="text-danger"></span>
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan alamat email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Keamanan Akun -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle p-2 me-3">
                                            <i class="fa fa-shield-alt fa-lg"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold">Keamanan Akun</h5>
                                    </div>
                                    <hr class="mb-4">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-key me-1"></i>Password
                                            </label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Kosongkan jika tidak ingin mengubah">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fa fa-info-circle me-1"></i>
                                                Biarkan kosong jika tidak ingin mengubah password
                                            </small>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="fa fa-key me-1"></i>Konfirmasi Password
                                            </label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation"
                                                placeholder="Konfirmasi password jika diubah">
                                            <small class="form-text text-muted">
                                                <i class="fa fa-check-circle me-1"></i>
                                                Isi jika mengubah password
                                            </small>
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
                                            <a href="{{ route('users.index') }}" class="btn btn-primary">
                                                <i class="fa fa-times me-2"></i>Batal
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save me-2"></i>Update User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
