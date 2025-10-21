@extends('admin.dashboard')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-box fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Produk</p>
                    <h6 class="mb-0">{{ $totalProduk }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Produk Aktif</p>
                    <h6 class="mb-0">{{ $produkAktif }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-cubes fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Stok</p>
                    <h6 class="mb-0">{{ $totalStok }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Produk Baru (Bulan Ini)</p>
                    <h6 class="mb-0">{{ $produkBaru }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- Produk List Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Produk</h6>
            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" style="width: 5%">#</th>
                        <th scope="col" style="width: 15%">Foto</th>
                        <th scope="col" style="width: 20%">Nama Produk</th>
                        <th scope="col" style="width: 15%">UMKM</th>
                        <th scope="col" style="width: 10%">Harga</th>
                        <th scope="col" style="width: 10%">Stok</th>
                        <th scope="col" style="width: 10%">Status</th>
                        <th scope="col" style="width: 15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $index => $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($p->media->count() > 0)
                                <img src="{{ asset('storage/' . $p->media->first()->file_url) }}"
                                     alt="{{ $p->nama_produk }}"
                                     style="width: 60px; height: 60px; object-fit: cover;"
                                     class="rounded">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px;">
                                    <i class="fa fa-image text-white"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>{{ $p->umkm->nama_usaha }}</td>
                        <td>{{ $p->harga_formatted }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>
                            <span class="badge bg-{{ $p->status_badge }}">
                                {{ $p->status_text }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('produk.show', $p) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('produk.edit', $p) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('produk.destroy', $p) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Produk List End -->
@endsection
