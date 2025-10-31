@extends('layout.guest.app')
@section('title', 'About')
@section('content')
    <!-- Introduction Section -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <h2 class="gradient-text mb-4">Siapa Kami?</h2>
            <p class="lead">UMKM Bina Desa adalah platform yang didedikasikan untuk memberdayakan Usaha Mikro, Kecil,
                dan Menengah (UMKM) di pedesaan Indonesia.</p>
            <p class='lead'>Kami percaya bahwa setiap desa memiliki potensi ekonomi yang luar biasa, dan dengan dukungan
                yang tepat,
                UMKM desa dapat menjadi penggerak utama perekonomian lokal.</p>
            <p class='lead'>Sejak didirikan pada tahun 2020, kami telah membantu lebih dari 500 UMKM untuk berkembang dan
                menjangkau
                pasar yang lebih luas melalui digitalisasi dan pendampingan berkelanjutan.</p>
        </div>
        <div class="col-lg-6">
            <div class="card h-100 border-0 overflow-hidden">
                <div class="card-body p-0 position-relative">
                    <img src= "/img/young-woman-arranging-her-cake-shop.jpg"
                        alt="Produk UMKM Desa" class="img-fluid w-100 h-100" style="object-fit: cover; min-height: 300px;">
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="background: linear-gradient(135deg, rgba(40, 159, 183, 0.2) 0%, rgba(20, 107, 140, 0.2) 100%);">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
