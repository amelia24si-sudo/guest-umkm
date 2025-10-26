@extends('layouts.app')

@section('title', $umkm->nama_usaha)

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('umkm.index') }}">Semua UMKM</a></li>
        <li class="breadcrumb-item active">{{ $umkm->nama_usaha }}</li>
    </ol>
</nav>

<div class="row">
    <!-- Gambar dan Info Utama -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($umkm->media->count() > 0)
                <img src="{{ asset('storage/' . $umkm->media->first()->file_url) }}"
                     class="img-fluid rounded"
                     alt="{{ $umkm->nama_usaha }}"
                     style="max-height: 300px; object-fit: cover;">
                @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="height: 200px;">
                    <span class="text-muted">Tidak ada gambar</span>
                </div>
                @endif

                <h3 class="mt-3">{{ $umkm->nama_usaha }}</h3>
                <span class="badge bg-primary">{{ $umkm->kategori }}</span>
            </div>
        </div>

        <!-- Info Kontak -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <strong>Informasi Kontak</strong>
            </div>
            <div class="card-body">
                <p><strong>Pemilik:</strong><br>{{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                <p><strong>Alamat Usaha:</strong><br>{{ $umkm->alamat }}, RT {{ $umkm->rt }}/RW {{ $umkm->rw }}</p>
                <p><strong>Kontak:</strong><br>{{ $umkm->kontak }}</p>
                @php
                    // Bersihkan nomor telepon dari karakter non-digit
                    $clean_phone = preg_replace('/[^0-9]/', '', $umkm->kontak);
                    // Jika nomor diawali dengan 0, ganti dengan 62
                    if (substr($clean_phone, 0, 1) === '0') {
                        $clean_phone = '62' . substr($clean_phone, 1);
                    }
                @endphp
                <a href="https://wa.me/{{ $clean_phone }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20usaha%20Anda"
                   class="btn btn-success w-100" target="_blank">
                    Hubungi via WhatsApp
                </a>
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
                <p>{{ $umkm->deskripsi ?: 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <!-- Layanan/Jasa yang Ditawarkan -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>Layanan/Jasa yang Ditawarkan</strong>
            </div>
            <div class="card-body">
                <p class="text-muted">{{$umkm->kategori}}</p>
                <!-- Anda bisa menambahkan field tambahan di database nanti jika diperlukan -->
            </div>
        </div>

        <!-- Informasi Pemilik -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <strong>Informasi Pemilik</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama:</strong> {{ $umkm->pemilik->nama ?? 'Tidak diketahui' }}</p>
                        <p><strong>Jenis Kelamin:</strong>
                            @if(isset($umkm->pemilik->jenis_kelamin))
                                @if($umkm->pemilik->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @else
                                    <span class="badge bg-success">Perempuan</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                        <p><strong>Agama:</strong> {{ $umkm->pemilik->agama ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Pekerjaan:</strong> {{ $umkm->pemilik->pekerjaan ?? '-' }}</p>
                        <p><strong>Telepon:</strong> {{ $umkm->pemilik->telp ?? '-' }}</p>
                        <p><strong>Alamat Tempat Tinggal:</strong> {{ $umkm->alamat ?? '-' }},
                            RT {{ $umkm->rt ?? '-' }}/RW {{ $umkm->rw ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UMKM Lainnya -->
@if($umkmLainnya->count() > 0)
<div class="row mt-5">
    <div class="col-12">
        <h4>UMKM Lainnya</h4>
        <div class="row">
            @foreach($umkmLainnya as $umkmLain)
            <div class="col-md-3 mb-3">
                <div class="card card-umkm h-100">
                    @if($umkmLain->media->count() > 0)
                        <img src="{{ asset('storage/' . $umkmLain->media->first()->file_url) }}"
                             class="card-img-top"
                             alt="{{ $umkmLain->nama_usaha }}"
                             style="height: 120px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                             style="height: 120px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($umkmLain->nama_usaha, 30) }}</h6>
                        <span class="badge bg-secondary">{{ $umkmLain->kategori }}</span>
                        <a href="{{ route('umkm.show', $umkmLain->umkm_id) }}" class="btn btn-outline-primary btn-sm mt-2 w-100">Lihat</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
