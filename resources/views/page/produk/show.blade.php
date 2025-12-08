<section class="container-fluid pt-4 px-4">
    <section class="bg-light rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Produk</h6>
            <section>
                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-primary">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <form action="{{ route('produk.destroy', $produk) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                        <i class="fa fa-trash me-2"></i>Hapus
                    </button>
                </form>
                <a href="{{ route('produk.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </section>
        </section>

        @if (session('success'))
            <section class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </section>
        @endif

        <section class="row">
            <section class="col-md-8">
                <section class="card mb-4">
                    <section class="card-header bg-primary text-white">
                        <h6 class="mb-0">Informasi Produk</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama Produk</strong></td>
                                <td>{{ $produk->nama_produk }}</td>
                            </tr>
                            <tr>
                                <td><strong>UMKM</strong></td>
                                <td>
                                    {{ $produk->umkm->nama_usaha }}
                                    <br><small class="text-muted">Pemilik: {{ $produk->umkm->pemilik->nama }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <span class="badge bg-success">{{ $produk->harga_formatted }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Stok</strong></td>
                                <td>
                                    @if($produk->stok > 0)
                                        <span class="badge bg-success">{{ $produk->stok }} tersedia</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <span class="badge bg-{{ $produk->status_badge }}">
                                        {{ $produk->status_text }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>{{ $produk->deskripsi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat</strong></td>
                                <td>{{ $produk->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>{{ $produk->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </section>
                </section>

                <!-- Statistik Produk -->
                <section class="card mb-4">
                    <section class="card-header bg-info text-white">
                        <h6 class="mb-0">Statistik Produk</h6>
                    </section>
                    <section class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fa fa-eye fa-2x text-info mb-2"></i>
                                    <h5 class="mb-1">0</h5>
                                    <p class="text-muted small mb-0">Dilihat</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fa fa-shopping-cart fa-2x text-success mb-2"></i>
                                    <h5 class="mb-1">0</h5>
                                    <p class="text-muted small mb-0">Terjual</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fa fa-star fa-2x text-warning mb-2"></i>
                                    <h5 class="mb-1">0</h5>
                                    <p class="text-muted small mb-0">Rating</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fa fa-heart fa-2x text-danger mb-2"></i>
                                    <h5 class="mb-1">0</h5>
                                    <p class="text-muted small mb-0">Favorit</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </section>

            <section class="col-md-4">
                <!-- Foto Produk -->
                <section class="card mb-4">
                    <section class="card-header bg-success text-white">
                        <h6 class="mb-0">Foto Produk</h6>
                    </section>
                    <section class="card-body text-center">
                        @if ($produk->media->count() > 0)
                            <img src="{{ asset('storage/' . $produk->media->first()->file_nama) }}"
                                alt="{{ $produk->nama_produk }}" style="max-width: 100%; max-height: 200px;"
                                class="img-fluid rounded mb-3">
                            <p class="text-muted small mb-0">
                                <i class="fa fa-info-circle me-1"></i>
                                Gambar produk utama
                            </p>
                        @else
                            <section class="text-muted py-4">
                                <i class="fa fa-image fa-3x mb-3"></i>
                                <p>Tidak ada foto produk</p>
                                <small class="text-muted">Unggah foto melalui menu edit</small>
                            </section>
                        @endif
                    </section>
                </section>

                <!-- Informasi UMKM -->
                <section class="card">
                    <section class="card-header bg-warning text-white">
                        <h6 class="mb-0">Informasi UMKM</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Nama Usaha</strong></td>
                                <td>{{ $produk->umkm->nama_usaha }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pemilik</strong></td>
                                <td>{{ $produk->umkm->pemilik->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ $produk->umkm->kategori }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Kontak</strong></td>
                                <td>{{ $produk->umkm->kontak }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>
                                    {{ $produk->umkm->alamat }},
                                    RT {{ $produk->umkm->rt }}/RW {{ $produk->umkm->rw }}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status UMKM</strong></td>
                                <td>
                                    @if($produk->umkm->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Non-Aktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('binadesa.show', $produk->umkm) }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                            <i class="fa fa-external-link-alt me-1"></i>Lihat Detail UMKM
                        </a>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
