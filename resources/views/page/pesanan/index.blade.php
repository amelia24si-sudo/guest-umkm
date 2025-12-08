<!-- Pesanan Table Start -->
<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Pesanan</h6>
            <a href="{{ route('pesanan.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah Pesanan
            </a>
        </div>

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

        <!-- Filter dan Search Form -->
        <form method="GET" action="{{ route('pesanan.index') }}" class="mb-4">
            <section class="row g-3 justify-content-center">
                <!-- Search -->
                <section class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari no pesanan, nama warga, alamat...">
                        <button type="submit" class="input-group-text">
                            <i class="fa fa-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn-clear ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Status Filter -->
                <section class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                        <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </section>

                <!-- Warga Filter -->
                <section class="col-md-3">
                    <select name="warga_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Warga</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}" {{ request('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </section>

                <!-- Sorting -->
                <section class="col-md-2">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="total_asc" {{ request('sort') == 'total_asc' ? 'selected' : '' }}>Total Terendah</option>
                        <option value="total_desc" {{ request('sort') == 'total_desc' ? 'selected' : '' }}>Total Tertinggi</option>
                    </select>
                </section>
            </section>
        </form>

        <!-- Table View -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No Pesanan</th>
                        <th>Warga</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $p)
                        <tr>
                            <td>
                                <strong>{{ $p->nomor_pesanan }}</strong>
                            </td>
                            <td>
                                {{ $p->warga->nama }}
                                <br>
                                <small class="text-muted">{{ $p->warga->telp }}</small>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">Rp {{ number_format($p->total, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($p->status == 'pending')
                                    <span class="badge bg-warning">Menunggu Pembayaran</span>
                                @elseif($p->status == 'diproses')
                                    <span class="badge bg-info">Sedang Diproses</span>
                                @elseif($p->status == 'dikirim')
                                    <span class="badge bg-primary">Sedang Dikirim</span>
                                @elseif($p->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Dibatalkan</span>
                                @endif
                            </td>
                            <td>
                                {{ Str::limit($p->alamat_kirim, 30) }}
                                <br>
                                <small class="text-muted">RT {{ $p->rt }}/RW {{ $p->rw }}</small>
                            </td>
                            <td>
                                {{ $p->created_at->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">{{ $p->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pesanan.show', $p->pesanan_id) }}"
                                       class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pesanan.edit', $p->pesanan_id) }}"
                                       class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pesanan.update-status', $p->pesanan_id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                            <option value="" disabled>Ubah Status</option>
                                            <option value="pending" {{ $p->status == 'pending' ? 'selected disabled' : '' }}>
                                                Menunggu Pembayaran
                                            </option>
                                            <option value="diproses" {{ $p->status == 'diproses' ? 'selected disabled' : '' }}>
                                                Sedang Diproses
                                            </option>
                                            <option value="dikirim" {{ $p->status == 'dikirim' ? 'selected disabled' : '' }}>
                                                Sedang Dikirim
                                            </option>
                                            <option value="selesai" {{ $p->status == 'selesai' ? 'selected disabled' : '' }}>
                                                Selesai
                                            </option>
                                            <option value="dibatalkan" {{ $p->status == 'dibatalkan' ? 'selected disabled' : '' }}>
                                                Dibatalkan
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum Ada Pesanan</h5>
                                <p class="text-muted">Mulai dengan menambahkan pesanan pertama Anda</p>
                                <a href="{{ route('pesanan.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i>Tambah Pesanan Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($pesanan->hasPages())
            <section class="mt-3">
                {{ $pesanan->links('pagination::bootstrap-5') }}
            </section>
        @else
            <section class="mt-3">
                <small class="text-muted">
                    Menampilkan
                    {{ $pesanan->firstItem() ? $pesanan->firstItem() . ' - ' . $pesanan->lastItem() . ' dari ' . $pesanan->total() : $pesanan->count() }}
                    pesanan
                </small>
            </section>
        @endif
    </section>
</section>
<!-- Pesanan Table End -->
