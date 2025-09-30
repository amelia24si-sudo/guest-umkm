@extends('layouts.app')

@section('title', $umkm['nama_usaha'])

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/umkm">Semua UMKM</a></li>
        <li class="breadcrumb-item active">{{ $umkm['nama_usaha'] }}</li>
    </ol>
</nav>

<div class="row">
    <!-- Gambar dan Info Utama -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($umkm['gambar'])
                <img src="https://via.placeholder.com/400x300/667eea/white?text={{ urlencode($umkm['nama_usaha']) }}"
                     class="img-fluid rounded"
                     alt="{{ $umkm['nama_usaha'] }}">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="height: 200px;">
                    <span class="text-muted">No Image</span>
                </div>
                @endif

                <h3 class="mt-3">{{ $umkm['nama_usaha'] }}</h3>
                <span class="badge bg-primary">{{ $umkm['kategori'] }}</span>
            </div>
        </div>

        <!-- Info Kontak -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <strong>Informasi Kontak</strong>
            </div>
            <div class="card-body">
                <p><strong>Pemilik:</strong><br>{{ $umkm['pemilik'] }}</p>
                <p><strong>Alamat:</strong><br>{{ $umkm['alamat'] }}</p>
                <p><strong>Kontak:</strong><br>{{ $umkm['kontak'] }}</p>
                <button class="btn btn-success w-100">Hubungi Sekarang</button>
            </div>
        </div>
    </div>

    <!-- Detail Informasi -->
    <div class="col-md-8">
        <!-- Deskripsi -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>Deskripsi Usaha</strong>
            </div>
            <div class="card-body">
                <p>{{ $umkm['deskripsi'] }}</p>
            </div>
        </div>

        <!-- Produk Unggulan -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>Produk Unggulan</strong>
            </div>
            <div class="card-body">
                <p>{{ $umkm['produk_unggulan'] }}</p>
            </div>
        </div>

        <!-- Testimoni (Contoh) -->
        <div class="card">
            <div class="card-header bg-light">
                <strong>Testimoni Pelanggan</strong>
            </div>
            <div class="card-body">
                <div class="border p-3 mb-2 rounded">
                    <p>"Pelayanan sangat memuaskan, produk berkualitas!"</p>
                    <small class="text-muted">- Rina, Pelanggan</small>
                </div>
                <div class="border p-3 rounded">
                    <p>"Harga terjangkau dan kualitas terjamin."</p>
                    <small class="text-muted">- Andi, Pelanggan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UMKM Lainnya -->
<div class="row mt-5">
    <div class="col-12">
        <h4>UMKM Lainnya</h4>
        <div class="row">
            @php
            $umkm_lain = [
                ['id' => 1, 'nama' => 'Toko Bangunan Maju Jaya', 'kategori' => 'Perdagangan'],
                ['id' => 2, 'nama' => 'Warung Makan Sederhana', 'kategori' => 'Kuliner'],
                ['id' => 3, 'nama' => 'Toko Elektronik Sejahtera', 'kategori' => 'Elektronik'],
                ['id' => 4, 'nama' => 'Butik Cantik', 'kategori' => 'Fashion']
            ];
            @endphp

            @foreach($umkm_lain as $item)
            @if($item['id'] != $umkm['id'])
            <div class="col-md-3">
                <div class="card card-umkm">
                    <div class="card-body">
                        <h6 class="card-title">{{ $item['nama'] }}</h6>
                        <span class="badge bg-secondary">{{ $item['kategori'] }}</span>
                        <a href="/umkm/detail/{{ $item['id'] }}" class="btn btn-outline-primary btn-sm mt-2 w-100">Lihat</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
