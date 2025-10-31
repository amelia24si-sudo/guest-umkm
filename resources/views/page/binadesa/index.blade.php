@extends('layout.dashboard.app')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-store fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total UMKM</p>
                    <h6 class="mb-0">{{ $totalUsaha }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Usaha Aktif</p>
                    <h6 class="mb-0">{{ $usahaAktif }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-tags fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Kategori Terbanyak</p>
                    <h6 class="mb-0">{{ $kategoriTerbanyak }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-plus-circle fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Usaha Baru (Bulan Ini)</p>
                    <h6 class="mb-0">{{ $usahaBaru }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- UMKM List Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar UMKM/Binadesa</h6>
            <a href="{{ route('binadesa.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah UMKM
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
                        <th scope="col" style="width: 5%">No</th>
                        <th scope="col" style="width: 20%">Nama Usaha</th>
                        <th scope="col" style="width: 15%">Pemilik</th>
                        <th scope="col" style="width: 15%">Kategori</th>
                        <th scope="col" style="width: 15%">Kontak</th>
                        <th scope="col" style="width: 20%">Alamat</th>
                        <th scope="col" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($binadesa as $index => $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $b->nama_usaha }}</td>
                        <td>{{ $b->pemilik->nama }}</td>
                        <td>
                            <span class="badge bg-info">{{ $b->kategori }}</span>
                        </td>
                        <td>{{ $b->kontak }}</td>
                        <td>{{ $b->alamat }}, RT {{ $b->rt }}/RW {{ $b->rw }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('binadesa.show', $b) }}" class="btn btn-primary" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('binadesa.edit', $b) }}" class="btn btn-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('binadesa.destroy', $b) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-primary" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data UMKM</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- UMKM List End -->
@endsection
