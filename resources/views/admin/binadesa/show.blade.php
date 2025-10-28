@extends('layout.admin.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail UMKM/Binadesa</h6>
            <div>
                <a href="{{ route('binadesa.edit', $binadesa) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <form action="{{ route('binadesa.destroy', $binadesa) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?')">
                        <i class="fa fa-trash me-2"></i>Hapus
                    </button>
                </form>
                <a href="{{ route('binadesa.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Informasi UMKM</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama Usaha</strong></td>
                                <td>{{ $binadesa->nama_usaha }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pemilik</strong></td>
                                <td>
                                    {{ $binadesa->pemilik->nama }}
                                    @if($binadesa->pemilik->no_ktp)
                                        <br><small class="text-muted">NIK: {{ $binadesa->pemilik->no_ktp }}</small>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ $binadesa->kategori }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Kontak</strong></td>
                                <td>{{ $binadesa->kontak }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat Usaha</strong></td>
                                <td>{{ $binadesa->alamat }}, RT {{ $binadesa->rt }}/RW {{ $binadesa->rw }}</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>{{ $binadesa->deskripsi ?: '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Dibuat</strong></td>
                                <td>{{ $binadesa->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Terakhir Diupdate</strong></td>
                                <td>{{ $binadesa->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Logo Usaha</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($binadesa->media->count() > 0)
                            <img src="{{ asset('storage/' . $binadesa->media->first()->file_url) }}"
                                 alt="Logo {{ $binadesa->nama_usaha }}"
                                 style="max-width: 100%; max-height: 200px;"
                                 class="img-fluid rounded">
                        @else
                            <div class="text-muted">
                                <i class="fa fa-image fa-3x mb-2"></i>
                                <p>Tidak ada logo</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">Informasi Pemilik</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>{{ $binadesa->pemilik->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>
                                    @if($binadesa->pemilik->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">Laki-laki</span>
                                    @else
                                        <span class="badge bg-success">Perempuan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Agama</strong></td>
                                <td>{{ $binadesa->pemilik->agama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Pekerjaan</strong></td>
                                <td>{{ $binadesa->pemilik->pekerjaan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>{{ $binadesa->pemilik->telp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>{{ $binadesa->alamat }}, RT {{ $binadesa->rt }}/RW {{ $binadesa->rw }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
