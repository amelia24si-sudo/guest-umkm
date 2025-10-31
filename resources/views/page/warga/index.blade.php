@extends('layout.dashboard.app')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Warga</p>
                    <h6 class="mb-0">{{ $warga->count() }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-male fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Laki-laki</p>
                    <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'L')->count() }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-female fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Perempuan</p>
                    <h6 class="mb-0">{{ $warga->where('jenis_kelamin', 'P')->count() }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-store fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pemilik UMKM</p>
                    <h6 class="mb-0">{{ $warga->filter(function($w) { return $w->umkm->count() > 0; })->count() }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<!-- Warga List Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Warga</h6>
            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah Warga
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" style="width: 5%">No</th>
                        <th scope="col" style="width: 15%">NIK</th>
                        <th scope="col" style="width: 20%">Nama</th>
                        <th scope="col" style="width: 20%">Jenis Kelamin</th>
                        <th scope="col" style="width: 10%">Agama</th>
                        <th scope="col" style="width: 15%">Pekerjaan</th>
                        <th scope="col" style="width: 15%">Kontak</th>
                        <th scope="col" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warga as $index => $w)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $w->no_ktp }}</td>
                        <td>{{ $w->nama }}</td>
                        <td>
                            @if($w->jenis_kelamin == 'L')
                                <span class="badge bg-primary">Laki-laki</span>
                            @else
                                <span class="badge bg-success">Perempuan</span>
                            @endif
                        </td>
                        <td>{{ $w->agama }}</td>
                        <td>{{ $w->pekerjaan }}</td>
                        <td>
                            @if($w->telp)
                                <i class="fa fa-phone me-1"></i>{{ $w->telp }}
                            @endif
                            @if($w->email)
                                <br><i class="fa fa-envelope me-1"></i>{{ $w->email }}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('warga.show', $w) }}" class="btn btn-info btn-sm" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('warga.edit', $w) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $w) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-primary" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data warga</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Warga List End -->
@endsection
