@extends('admin.dashboard')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Data Warga</h6>
            <div>
                <a href="{{ route('warga.edit', $warga) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Data Pribadi</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>NIK</strong></td>
                                <td>{{ $warga->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>{{ $warga->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>
                                    @if($warga->jenis_kelamin == 'L')
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Agama</strong></td>
                                <td>{{ $warga->agama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan</strong></td>
                                <td>{{ $warga->pekerjaan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Kontak & Alamat</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Telepon</strong></td>
                                <td>{{ $warga->telp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>{{ $warga->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $warga->alamat }}</td>
                            </tr>
                            <tr>
                                <td><strong>RT/RW</strong></td>
                                <td>{{ $warga->rt }}/{{ $warga->rw }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data UMKM yang dimiliki -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0">UMKM yang Dimiliki</h6>
            </div>
            <div class="card-body">
                @if($warga->umkm->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Usaha</th>
                                    <th>Kategori</th>
                                    <th>Kontak</th>
                                    <th>Alamat Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($warga->umkm as $umkm)
                                <tr>
                                    <td>{{ $umkm->nama_usaha }}</td>
                                    <td>{{ $umkm->kategori }}</td>
                                    <td>{{ $umkm->kontak }}</td>
                                    <td>{{ $umkm->alamat }}, RT {{ $umkm->rt }}/RW {{ $umkm->rw }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">Warga ini belum memiliki UMKM.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
