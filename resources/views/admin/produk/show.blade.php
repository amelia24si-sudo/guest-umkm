@extends('admin.dashboard')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Produk</h6>
            <div>
                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-edit me-2"></i>Edit
                </a>
                <form action="{{ route('produk.destroy', $produk) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                        <i class="fa fa-trash me-2"></i>Hapus
                    </button>
                </form>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm">
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
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Foto Produk</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($produk->media->count() > 0)
                            <img src="{{ asset('storage/' . $produk->media->first()->file_url) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 style="max-width: 100%; max-height: 300px;"
                                 class="img-fluid rounded">
                        @else
                            <div class="text-muted py-4">
                                <i class="fa fa-image fa-4x mb-3"></i>
                                <p>Tidak ada foto</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Informasi Produk</h6>
                    </div>
                    <div class="card-body">
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
                                <td class="h5 text-primary">{{ $produk->harga_formatted }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stok</strong></td>
                                <td>
                                    <span class="h5 {{ $produk->stok > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $produk->stok }}
                                    </span>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
