@extends('layout.guest.app')
@section('title', 'Kontak UMKM Desa')

@section('content')
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="gradient-text">Hubungi Kami</h2>
            <p class="lead text-muted">Kami siap membantu Anda dalam pengembangan UMKM desa</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Informasi Kontak -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 custom-shadow">
                <div class="card-body">
                    <h4 class="card-title mb-4 gradient-text">Informasi Kontak</h4>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-container bg-custom-light rounded-circle p-3 me-3">
                            <i class="fas fa-map-marker-alt text-custom-dark fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Alamat Kantor</h6>
                            <p class="text-muted mb-0">
                                Kantor Desa<br>
                                Jl. Desa No. 123<br>
                                Kecamatan Contoh, Kabupaten Sample<br>
                                Kode Pos: 12345
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-container bg-custom-light rounded-circle p-3 me-3">
                            <i class="fas fa-phone text-custom-dark fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Telepon</h6>
                            <p class="text-muted mb-0">
                                (021) 1234-5678<br>
                                (021) 8765-4321
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-container bg-custom-light rounded-circle p-3 me-3">
                            <i class="fas fa-envelope text-custom-dark fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Email</h6>
                            <p class="text-muted mb-0">
                                info@umkmdesa.id<br>
                                umkm.desa@gmail.com
                            </p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="icon-container bg-custom-light rounded-circle p-3 me-3">
                            <i class="fas fa-clock text-custom-dark fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold">Jam Operasional</h6>
                            <p class="text-muted mb-0">
                                Senin - Jumat: 08.00 - 16.00 WIB<br>
                                Sabtu: 08.00 - 14.00 WIB<br>
                                Minggu: Tutup
                            </p>
                        </div>
                    </div>

                    <!-- Tombol WhatsApp -->
                    <div class="mt-4 pt-3 border-top">
                        <a href="https://wa.me/6281234567890?text=Halo%20UMKM%20Desa%2C%20saya%20ingin%20bertanya%20tentang%20layanan%20UMKM"
                            class="btn btn-success w-100 py-3 fw-bold hover-lift" target="_blank">
                            <i class="fab fa-whatsapp fa-lg me-2"></i>
                            Chat via WhatsApp
                        </a>
                        <small class="text-muted d-block mt-2 text-center">
                            Respons cepat dalam 1x24 jam
                        </small>
                        {{-- <div class="whatsapp-icon mb-3">
                            <i class="fab fa-whatsapp fa-3x text-success"></i>
                        </div> --}}
                        <h5 class="gradient-text">Butuh Bantuan Cepat?</h5>
                        <p class="text-muted small mb-3">
                            Gunakan WhatsApp untuk konsultasi langsung dengan tim kami
                        </p>

                        <!-- Multiple WhatsApp Buttons -->
                        <div class="d-grid gap-2">
                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20konsultasi%20tentang%20pendaftaran%20UMKM"
                                class="btn btn-outline-success btn-sm hover-lift" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Konsultasi UMKM
                            </a>

                            <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20tanya%20tentang%20bantuan%20modal%20usaha"
                                class="btn btn-outline-success btn-sm hover-lift" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Bantuan Modal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Kontak -->
        <div class="col-md-8">
            <div class="card border-0 custom-shadow">
                <div class="card-body">
                    <h4 class="card-title mb-4 gradient-text">Kirim Pesan</h4>
                    <form action="{{ route('kirim.pesan') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-bold">Nama Lengkap *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}" required
                                    placeholder="Masukkan nama lengkap Anda">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subjek" class="form-label fw-bold">Subjek *</label>
                            <input type="text" class="form-control @error('subjek') is-invalid @enderror" id="subjek"
                                name="subjek" value="{{ old('subjek') }}" required
                                placeholder="Apa yang ingin Anda tanyakan?">
                            @error('subjek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pesan" class="form-label fw-bold">Pesan *</label>
                            <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" rows="6"
                                required placeholder="Tuliskan pesan lengkap Anda di sini...">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg px-4 hover-lift">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>

                            <a href="https://wa.me/6281234567890?text=Halo%20UMKM%20Desa%2C%20saya%20ingin%20bertanya%20tentang%3A%0A%0A"
                                class="btn btn-success btn-lg px-4 hover-lift" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Lokasi -->
            <div class="card mt-4 border-0 custom-shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="gradient-text mb-3">Lokasi Kantor Desa</h5>
                            <div class="bg-light rounded custom-shadow" style="height: 200px;">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-map-marker-alt fa-2x mb-3 text-custom-dark"></i>
                                        <p>Peta lokasi kantor desa</p>
                                        <small>Integrasikan dengan Google Maps API</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="gradient-text mb-3">Media Sosial</h5>
                            <div class="d-flex gap-2 mb-3">
                                <a href="#" class="btn btn-outline-primary hover-lift">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary hover-lift">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary hover-lift">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary hover-lift">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 custom-shadow">
                <div class="card-body">
                    <h4 class="text-center gradient-text mb-4">Pertanyaan yang Sering Diajukan</h4>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <i class="fas fa-question-circle me-2 text-custom-dark"></i>
                                    Bagaimana cara mendaftarkan UMKM?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Untuk mendaftarkan UMKM, silakan datang ke kantor desa dengan membawa dokumen
                                    yang diperlukan atau hubungi kami melalui form kontak di atas untuk informasi lebih
                                    lanjut.
                                    <div class="mt-2">
                                        <a href="https://wa.me/6281234567890?text=Halo%2C%20saya%20ingin%20tanya%20tentang%20syarat%20pendaftaran%20UMKM"
                                            class="btn btn-success btn-sm hover-lift" target="_blank">
                                            <i class="fab fa-whatsapp me-1"></i>Tanya via WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    <i class="fas fa-question-circle me-2 text-custom-dark"></i>
                                    Apa saja syarat mendapatkan bantuan modal?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Syarat utama adalah memiliki usaha yang sudah berjalan minimal 6 bulan,
                                    berdomisili di desa kami, dan memiliki proposal usaha yang jelas.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
