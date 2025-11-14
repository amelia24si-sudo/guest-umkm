<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Tambah User Baru</h6>
            <a href="{{ route('users.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left me-2"></i>Kembali
            </a>
        </section>

        <section class="row justify-content-center">
            <section class="col-sm-12 col-xl-8">
                <section class="bg-light rounded h-100 p-4">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <section class="row mb-3">
                            <section class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap<span
                                        class="text-danger"></span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <section class="invalid-feedback">{{ $message }}</section>
                                @enderror
                            </section>

                            <section class="col-md-6">
                                <label for="email" class="form-label">Email<span
                                        class="text-danger"></span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required
                                    placeholder="Masukkan email">
                                @error('email')
                                    <section class="invalid-feedback">{{ $message }}</section>
                                @enderror
                            </section>
                        </section>

                        <section class="row mb-3">
                            <section class="col-md-6">
                                <label for="password" class="form-label">Password<span
                                        class="text-danger"></span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required placeholder="Masukkan password">
                                @error('password')
                                    <section class="invalid-feedback">{{ $message }}</section>
                                @enderror
                            </section>

                            <section class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password<span
                                        class="text-danger"></span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required placeholder="Konfirmasi password">
                            </section>
                        </section>

                        <section class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i>Simpan User
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">
                               <i class="fa fa-times me-2"></i>Batal
                            </a>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
</section>
