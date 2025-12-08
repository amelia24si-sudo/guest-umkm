<section class="container-fluid pt-4 px-4">
    <section class="bg-light rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Pesanan</h6>
            <section>
                <a href="{{ route('pesanan.edit', $pesanan) }}" class="btn btn-primary">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </section>
        </section>

       @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <div class="flex-grow-1 text-center">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    style="background: transparent; border: none; font-size: 1.5rem; line-height: 1; padding: 0.5rem; color: inherit;">
                    ×
                </button>
            </div>
        @endif

        <section class="row">
            <section class="col-md-8">
                <!-- Informasi Pesanan -->
                <section class="card mb-4">
                    <section class="card-header bg-primary text-white">
                        <h6 class="mb-0">Informasi Pesanan</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>No Pesanan</strong></td>
                                <td>{{ $pesanan->nomor_pesanan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Warga</strong></td>
                                <td>
                                    {{ $pesanan->warga->nama }}
                                    <br><small class="text-muted">Telp: {{ $pesanan->warga->telp }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td>
                                    <span class="badge bg-success">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    @if($pesanan->status == 'pending')
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @elseif($pesanan->status == 'diproses')
                                        <span class="badge bg-info">Sedang Diproses</span>
                                    @elseif($pesanan->status == 'dikirim')
                                        <span class="badge bg-primary">Sedang Dikirim</span>
                                    @elseif($pesanan->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Alamat Pengiriman</strong></td>
                                <td>{{ $pesanan->alamat_kirim }}</td>
                            </tr>
                            <tr>
                                <td><strong>RT/RW</strong></td>
                                <td>RT {{ $pesanan->rt }}/RW {{ $pesanan->rw }}</td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <td>
                                    @if($pesanan->metode_bayar == 'transfer')
                                        <span class="badge bg-info">Transfer Bank</span>
                                    @elseif($pesanan->metode_bayar == 'cod')
                                        <span class="badge bg-success">Cash on Delivery (COD)</span>
                                    @else
                                        <span class="badge bg-primary">Tunai</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pesanan</strong></td>
                                <td>{{ $pesanan->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>{{ $pesanan->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </section>
                </section>

                <!-- Detail Produk Pesanan -->
                <section class="card mb-4">
                    <section class="card-header bg-secondary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Detail Produk Pesanan</h6>
                            <span class="badge bg-light text-dark">
                                {{ $pesanan->detailPesanan->count() }} Produk
                            </span>
                        </div>
                    </section>
                    <section class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Harga Satuan</th>
                                        <th class="text-end">Subtotal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pesanan->detailPesanan as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $detail->produk->nama_produk }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ Str::limit($detail->produk->deskripsi, 50) }}
                                            </small>
                                            <br>
                                            <small class="text-info">
                                                <i class="fa fa-store"></i> {{ $detail->produk->umkm->nama_umkm ?? 'Tidak ada UMKM' }}
                                            </small>
                                        </td>
                                        <td class="text-center">{{ $detail->qty }}</td>
                                        <td class="text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('pesanan.hapus-item', $pesanan) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="detail_id" value="{{ $detail->detail_id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Hapus item ini dari pesanan?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- Total -->
                                    <tr class="table-primary">
                                        <td colspan="3"></td>
                                        <td class="text-end fw-bold">Total:</td>
                                        <td class="text-end fw-bold fs-5">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </section>

                <!-- Ubah Status -->
                <section class="card mb-4">
                    <section class="card-header bg-info text-white">
                        <h6 class="mb-0">Ubah Status Pesanan</h6>
                    </section>
                    <section class="card-body">
                        <form action="{{ route('pesanan.update-status', $pesanan) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                        <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                        <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                                        <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-sync me-1"></i>Update Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </section>
                </section>
            </section>

            <section class="col-md-4">
                <!-- Foto Bukti Bayar -->
                <section class="card mb-4">
                    <section class="card-header bg-success text-white">
                        <h6 class="mb-0">Bukti Bayar</h6>
                    </section>
                    <section class="card-body text-center">
                        @if ($pesanan->buktiBayar)
                            <img src="{{ asset('storage/' . $pesanan->buktiBayar->file_nama) }}"
                                alt="Bukti Bayar {{ $pesanan->nomor_pesanan }}"
                                style="max-width: 100%; max-height: 200px;"
                                class="img-fluid rounded mb-3">
                            <p class="text-muted small mb-0">
                                <i class="fa fa-info-circle me-1"></i>
                                Bukti pembayaran pesanan
                            </p>
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $pesanan->buktiBayar->file_nama) }}"
                                   target="_blank" class="btn btn-sm btn-outline-info me-2">
                                    <i class="fa fa-expand me-1"></i>Lihat Full
                                </a>
                                <form action="{{ route('pesanan.hapus-bukti', $pesanan) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="media_id" value="{{ $pesanan->buktiBayar->media_id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus bukti bayar ini?')">
                                        <i class="fa fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        @else
                            <section class="text-muted py-4">
                                <i class="fa fa-image fa-3x mb-3"></i>
                                <p>Tidak ada bukti bayar</p>
                                <small class="text-muted">Upload bukti bayar melalui menu edit</small>
                            </section>
                        @endif
                    </section>
                </section>

                <!-- Informasi Warga -->
                <section class="card">
                    <section class="card-header bg-warning text-white">
                        <h6 class="mb-0">Informasi Warga</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $pesanan->warga->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>No KTP</strong></td>
                                <td>{{ $pesanan->warga->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>{{ $pesanan->warga->telp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $pesanan->warga->email ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan</strong></td>
                                <td>{{ $pesanan->warga->pekerjaan ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $pesanan->warga->alamat }}</td>
                            </tr>
                        </table>
                        <a href="#" class="btn btn-outline-primary btn-sm w-100 mt-2">
                            <i class="fa fa-external-link-alt me-1"></i>Lihat Detail Warga
                        </a>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
