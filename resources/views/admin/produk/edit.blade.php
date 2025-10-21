@extends('admin.dashboard')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Edit Produk</h6>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">UMKM <span class="text-danger">*</span></label>
                        <select name="umkm_id" class="form-control" required>
                            <option value="">Pilih UMKM</option>
                            @foreach ($umkm as $u)
                                <option value="{{ $u->umkm_id }}"
                                    {{ old('umkm_id', $produk->umkm_id) == $u->umkm_id ? 'selected' : '' }}>
                                    {{ $u->nama_usaha }} - {{ $u->pemilik->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk" class="form-control"
                            value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Harga <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="harga" class="form-control"
                                value="{{ old('harga', $produk->harga) }}" min="0" step="0.01" required>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok', $produk->stok) }}"
                            min="0" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="aktif" {{ old('status', $produk->status ?? '') == 'aktif' ? 'selected' : '' }}>
                                Aktif</option>
                            <option value="nonaktif"
                                {{ old('status', $produk->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Produk</label>
                    <input type="file" name="foto_produk" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, JPEG, GIF. Maksimal 2MB</small>

                    @if ($produk->media->count() > 0)
                        <div class="mt-2">
                            <p class="mb-1">Foto Saat Ini:</p>
                            <img src="{{ asset('storage/' . $produk->media->first()->file_url) }}"
                                alt="{{ $produk->nama_produk }}" style="max-width: 150px; max-height: 150px;"
                                class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-2"></i>Update
                    </button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
