<section class="container-fluid pt-4 px-4">
    <section class="bg-light rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Edit UMKM/Binadesa</h6>
            <a href="{{ route('binadesa.index') }}" class="btn btn-primary">
                <i class="fa fa-arrow-left me-2"></i>Kembali
            </a>
        </section>

        @if (session('success'))
            <section class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </section>
        @endif

        @if ($errors->any())
            <section class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <form action="{{ route('binadesa.update', $binadesa) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <section class="row">
                <section class="col-md-6 mb-3">
                    <label class="form-label">Nama Usaha <span class="text-danger"></span></label>
                    <input type="text" name="nama_usaha" class="form-control"
                        value="{{ old('nama_usaha', $binadesa->nama_usaha) }}" placeholder="Nama Usaha" required>
                </section>

                <section class="col-md-6 mb-3">
                    <label class="form-label">Pemilik Warga <span class="text-danger"></span></label>
                    <select name="pemilik_warga_id" id="pemilik_warga_id" class="form-control" required>
                        <option value="">Pilih Pemilik</option>
                        @foreach ($warga as $w)
                            <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                data-telp="{{ $w->telp }}">
                                {{ $w->nama }} - {{ $w->no_ktp }}
                            </option>
                        @endforeach
                    </select>
                </section>
            </section>

            <section class="mb-3">
                <label class="form-label">Alamat Usaha <span class="text-danger"></span></label>
                <textarea name="alamat" id= "alamat" class="form-control" rows="3" placeholder="Alamat" required>{{ old('alamat', $binadesa->alamat) }}</textarea>
            </section>

            <section class="row">
                <section class="col-md-3 mb-3">
                    <label class="form-label">RT <span class="text-danger"></span></label>
                    <input type="text" name="rt" id="rt" class="form-control" value="{{ old('rt', $binadesa->rt) }}"
                        placeholder="RT" required>
                </section>
                <section class="col-md-3 mb-3">
                    <label class="form-label">RW <span class="text-danger"></span></label>
                    <input type="text" name="rw" id="rw" class="form-control" value="{{ old('rw', $binadesa->rw) }}"
                        placeholder="RW" required>
                </section>
                <section class="col-md-6 mb-3">
                    <label class="form-label">Kategori Usaha <span class="text-danger"></span></label>
                    <select name="kategori" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Makanan & Minuman"
                            {{ old('kategori', $binadesa->kategori) == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan
                            & Minuman</option>
                        <option value="Kerajinan Tangan"
                            {{ old('kategori', $binadesa->kategori) == 'Kerajinan Tangan' ? 'selected' : '' }}>
                            Kerajinan Tangan</option>
                        <option value="Pertanian"
                            {{ old('kategori', $binadesa->kategori) == 'Pertanian' ? 'selected' : '' }}>Pertanian
                        </option>
                        <option value="Peternakan"
                            {{ old('kategori', $binadesa->kategori) == 'Peternakan' ? 'selected' : '' }}>Peternakan
                        </option>
                        <option value="Jasa" {{ old('kategori', $binadesa->kategori) == 'Jasa' ? 'selected' : '' }}>
                            Jasa</option>
                        <option value="Perdagangan"
                            {{ old('kategori', $binadesa->kategori) == 'Perdagangan' ? 'selected' : '' }}>Perdagangan
                        </option>
                        <option value="Industri Kecil"
                            {{ old('kategori', $binadesa->kategori) == 'Industri Kecil' ? 'selected' : '' }}>Industri
                            Kecil</option>
                        <option value="Lainnya"
                            {{ old('kategori', $binadesa->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </section>
            </section>

            <section class="row">
                <section class="col-md-6 mb-3">
                    <label class="form-label">Kontak <span class="text-danger"></span></label>
                    <input type="text" name="kontak" id="kontak" class="form-control"
                        value="{{ old('kontak', $binadesa->kontak) }}" placeholder="Nomor HP/WhatsApp" required>
                </section>
                <section class="col-md-6 mb-3">
                    <label class="form-label">Logo Usaha</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</small>

                    @if ($binadesa->media->count() > 0)
                        <section class="mt-2">
                            <p class="mb-1">Logo Saat Ini:</p>
                            <img src="{{ asset('storage/' . $binadesa->media->first()->file_url) }}"
                                alt="Logo {{ $binadesa->nama_usaha }}" style="max-width: 150px; max-height: 150px;"
                                class="img-thumbnail">
                        </section>
                    @endif
                </section>
            </section>

            <section class="mb-3">
                <label class="form-label">Deskripsi Usaha</label>
                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi">{{ old('deskripsi', $binadesa->deskripsi) }}</textarea>
            </section>

            <section class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-2"></i>Update
                </button>
                <a href="{{ route('binadesa.index') }}" class="btn btn-primary">
                    <i class="fa fa-times me-2"></i>Batal
                </a>
            </section>
        </form>
    </section>
</section>
