<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Contact Us
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="{{ route('kirim.pesan') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                id="nama" name="nama" value="{{ old('nama') }}" 
                                placeholder="Nama Lengkap">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">Email </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}"
                                placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="subjek" class="form-label fw-bold">Subjek </label>
                        <input type="text" class="form-control @error('subjek') is-invalid @enderror" id="subjek"
                            name="subjek" value="{{ old('subjek') }}"
                            placeholder="Subject">
                        @error('subjek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pesan" class="form-label fw-bold">Pesan </label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" rows="6"
                             placeholder="Pesan">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn1">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                        &nbsp;
                        <button type="submit" class="btn1">
                            <a href="https://wa.me/6281234567890?text=Halo%20UMKM%20Desa%2C%20saya%20ingin%20bertanya%20tentang%3A%0A%0A"
                                 target="_blank">
                                <i class="fab fa-whatsapp me-2 "></i>WhatsApp
                            </a>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map_container ">
                    <div id="googleMap"></div>
                </div>
            </div>
        </div>
    </div>
</section>
