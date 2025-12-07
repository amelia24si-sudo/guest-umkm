<section class="container-fluid pt-4 px-4">
    <section class="bg-light rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Pesanan</h6>
            <section>
                <a href="{{ route('pesanan.edit', $pesanan) }}" class="btn btn-primary">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <form action="{{ route('pesanan.destroy', $pesanan) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                        <i class="fa fa-trash me-2"></i>Hapus
                    </button>
                </form>
                <a href="{{ route('pesanan.index') }}" class="btn btn-primary">
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
                <!-- Informasi Pesanan -->
                <section class="card mb-4">
                    <section class="card-header bg-primary text-white">
                        <h6 class="mb-0">Informasi Pesanan</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Nomor Pesanan</strong></td>
                                <td class="fw-bold">#{{ $pesanan->nomor_pesanan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>
                                    <span class="badge bg-{{ $pesanan->status == 'selesai' ? 'success' : ($pesanan->status == 'dibatalkan' ? 'danger' : ($pesanan->status == 'diproses' ? 'warning' : ($pesanan->status == 'dikirim' ? 'info' : 'secondary'))) }}">
                                        {{ $pesanan->status_lengkap }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td>
                                    <h5 class="mb-0 text-primary fw-bold">
                                        Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                    </h5>
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

                <!-- Informasi Pengiriman -->
                <section class="card mb-4">
                    <section class="card-header bg-info text-white">
                        <h6 class="mb-0">Informasi Pengiriman</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Alamat Kirim</strong></td>
                                <td>{{ $pesanan->alamat_kirim }}</td>
                            </tr>
                            <tr>
                                <td><strong>RT/RW</strong></td>
                                <td>RT {{ $pesanan->rt }}/RW {{ $pesanan->rw }}</td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran</strong></td>
                                <td>{{ $pesanan->metode_bayar_lengkap }}</td>
                            </tr>
                            @if($pesanan->resi_pengiriman)
                            <tr>
                                <td><strong>Resi Pengiriman</strong></td>
                                <td class="fw-medium">{{ $pesanan->resi_pengiriman }}</td>
                            </tr>
                            @endif
                        </table>
                    </section>
                </section>
            </section>

            <section class="col-md-4">
                <!-- Informasi Pelanggan -->
                <section class="card mb-4">
                    <section class="card-header bg-success text-white">
                        <h6 class="mb-0">Informasi Pelanggan</h6>
                    </section>
                    <section class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $pesanan->warga->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td>{{ $pesanan->warga->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>{{ $pesanan->warga->telp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $pesanan->warga->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>
                                    {{ $pesanan->warga->alamat }},
                                    RT {{ $pesanan->warga->rt }}/RW {{ $pesanan->warga->rw }}
                                </td>
                            </tr>
                        </table>
                        <a href="{{ route('warga.show', $pesanan->warga) }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                            <i class="fa fa-external-link-alt me-1"></i>Lihat Detail Pelanggan
                        </a>
                    </section>


                </section>

                <!-- Bukti Bayar -->
                @if($pesanan->bukti_bayar)
                <section class="card">
                    <section class="card-header bg-warning text-white">
                        <h6 class="mb-0">Bukti Bayar</h6>
                    </section>
                    <section class="card-body text-center">
                        <img src="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                            alt="Bukti Bayar" style="max-width: 100%; max-height: 200px;"
                            class="img-fluid rounded mb-3">
                        <a href="{{ asset('storage/' . $pesanan->bukti_bayar) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm w-100">
                            <i class="fa fa-expand me-1"></i>Lihat Full Size
                        </a>
                    </section>
                </section>
                @endif
            </section>
        </section>

        <!-- Aksi Status -->
        <section class="row mt-4">
            <section class="col-12">
                <section class="card">
                    <section class="card-header bg-secondary text-white">
                        <h6 class="mb-0">Perbarui Status Pesanan</h6>
                    </section>
                    <section class="card-body">
                        <form action="{{ route('pesanan.update-status', $pesanan) }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-8">
                                <select name="status" class="form-select">
                                    <option value="menunggu_pembayaran" {{ $pesanan->status == 'menunggu_pembayaran' ? 'selected' : '' }}>
                                        Menunggu Pembayaran
                                    </option>
                                    <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>
                                        Dikirim
                                    </option>
                                    <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa fa-sync-alt me-1"></i>Update Status
                                </button>
                            </div>
                        </form>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
