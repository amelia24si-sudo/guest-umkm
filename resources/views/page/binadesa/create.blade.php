@extends('layout.dashboard.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tambah UMKM/Binadesa</h6>
                <a href="{{ route('binadesa.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('binadesa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha') }}"
                            required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pemilik Usaha <span class="text-danger">*</span></label>
                        <select name="pemilik_warga_id" id="pemilik_warga_id" class="form-control" required>
                            <option value="">Pilih Warga</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}" data-alamat="{{ $w->alamat }}"
                                    data-rt="{{ $w->rt }}" data-rw="{{ $w->rw }}"
                                    data-telp="{{ $w->telp }}">
                                    {{ $w->nama }} - {{ $w->no_ktp }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Usaha <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">RT <span class="text-danger">*</span></label>
                            <input type="text" name="rt" id="rt" class="form-control"
                                value="{{ old('rt') }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">RW <span class="text-danger">*</span></label>
                            <input type="text" name="rw" id="rw" class="form-control"
                                value="{{ old('rw') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori Usaha <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Makanan & Minuman"
                                    {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman
                                </option>
                                <option value="Kerajinan Tangan"
                                    {{ old('kategori') == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                <option value="Pertanian" {{ old('kategori') == 'Pertanian' ? 'selected' : '' }}>Pertanian
                                </option>
                                <option value="Peternakan" {{ old('kategori') == 'Peternakan' ? 'selected' : '' }}>
                                    Peternakan</option>
                                <option value="Jasa" {{ old('kategori') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                <option value="Perdagangan" {{ old('kategori') == 'Perdagangan' ? 'selected' : '' }}>
                                    Perdagangan</option>
                                <option value="Industri Kecil" {{ old('kategori') == 'Industri Kecil' ? 'selected' : '' }}>
                                    Industri Kecil</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kontak <span class="text-danger">*</span></label>
                            <input type="text" name="kontak" id="kontak" class="form-control"
                                value="{{ old('kontak') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Logo Usaha</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Usaha</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('binadesa.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times me-2"></i>Batal
                        </a>
                    </div>
            </form>
        </div>
    </div>
@endsection
