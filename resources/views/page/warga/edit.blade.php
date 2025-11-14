<section class="container-fluid pt-4 px-4">
    <section class="bg-light rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Edit Data Warga</h6>
            <a href="{{ route('warga.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left me-2"></i>Kembali
            </a>
        </section>

        @if ($errors->any())
            <section class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <form action="{{ route('warga.update', $warga) }}" method="POST">
            @csrf
            @method('PUT')

            <section class="row">
                <section class="col-md-6 mb-3">
                    <label class="form-label">NIK<span class="text-danger"></span></label>
                    <input type="text" name="no_ktp" class="form-control"
                        value="{{ old('no_ktp', $warga->no_ktp) }}" required maxlength="16" pattern="[0-9]{16}"
                        title="NIK harus 16 digit angka">
                    <small class="text-muted">16 digit angka</small>
                </section>

                <section class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap<span class="text-danger"></span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $warga->nama) }}"
                        required>
                </section>
            </section>

            <section class="row">
                <section class="col-md-4 mb-3">
                    <label class="form-label">Jenis Kelamin<span class="text-danger"></span></label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L"
                            {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P"
                            {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </section>

                <section class="col-md-4 mb-3">
                    <label class="form-label">Agama<span class="text-danger"></span></label>
                    <select name="agama" class="form-control" required>
                        <option value="">Pilih Agama</option>
                        <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam
                        </option>
                        <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen
                        </option>
                        <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik
                        </option>
                        <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                        </option>
                        <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha
                        </option>
                        <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>
                            Konghucu</option>
                    </select>
                </section>

                <section class="col-md-4 mb-3">
                    <label class="form-label">Pekerjaan<span class="text-danger"></span></label>
                    <input type="text" name="pekerjaan" class="form-control"
                        value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                </section>
            </section>

            <section class="row">
                <section class="col-md-6 mb-3">
                    <label class="form-label">Nomor Telepon<span class="text-danger"></span></label>
                    <input type="text" name="telp" class="form-control" value="{{ old('telp', $warga->telp) }}"
                        required pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                </section>

                <section class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $warga->email) }}" required>
                </section>
            </section>

            <section class="mb-3">
                <label class="form-label">Alamat<span class="text-danger"></span></label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $warga->alamat) }}</textarea>
            </section>

            <section class="row">
                <section class="col-md-6 mb-3">
                    <label class="form-label">RT<span class="text-danger"></span></label>
                    <input type="text" name="rt" class="form-control" value="{{ old('rt', $warga->rt) }}"
                        required pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                </section>

                <section class="col-md-6 mb-3">
                    <label class="form-label">RW<span class="text-danger"></span></label>
                    <input type="text" name="rw" class="form-control" value="{{ old('rw', $warga->rw) }}"
                        required pattern="[0-9]+" title="Hanya angka yang diperbolehkan">
                </section>
            </section>

            <section class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i>Update
                </button>
                <a href="{{ route('warga.index') }}" class="btn btn-primary">
                    <i class="fa fa-times me-2"></i>Batal
                </a>
            </section>
        </form>
    </section>
</section>
