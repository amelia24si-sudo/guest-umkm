<!-- jQuery (Gunakan 1 versi jQuery saja di paling atas) -->
<script src="{{ asset('assets-admin/js/jquery-3.4.1.min.js') }}"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('assets-admin/js/bootstrap.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Isotope JS -->
<script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>

<!-- ImagesLoaded (Tambahan penting agar Isotope menghitung layout setelah gambar ter-load) -->
<script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>

<!-- Nice Select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script src="{{ asset('assets-admin/js/custom.js') }}"></script>

<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>

<script>
    $(document).ready(function() {
        // 1. Inisialisasi Isotope setelah semua gambar selesai dimuat (mencegah layout tumpuk)
        var $grid = $('.grid').imagesLoaded(function() {
            $grid.isotope({
                itemSelector: '.all',
                layoutMode: 'fitRows'
            });
        });

        // Event listener klik Filter Kategori
        $('.filters_menu li').on('click', function() {
            $('.filters_menu li').removeClass('active');
            $(this).addClass('active');

            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });

        // 2. Inisialisasi Select2 (Perbaikan sintaksis objek)
        if ($('#inputselect').length) {
            $('#inputselect').select2({
                placeholder: "Pilih UMKM",
                allowClear: true
            });
        }
    });

    // 3. Modul Manajemen Dinamis Produk & Auto-fill
    document.addEventListener('DOMContentLoaded', function() {
        const produkContainer = document.getElementById('produk-container');
        const produkTemplate = document.getElementById('produk-template');
        const tambahProdukBtn = document.getElementById('tambah-produk');
        const totalPesananElem = document.getElementById('total-pesanan');
        const totalInput = document.getElementById('total-input');
        let produkCounter = 0;

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        function hitungSubtotal(produkItem) {
            const qtyInput = produkItem.querySelector('.qty-input');
            const hargaInput = produkItem.querySelector('.harga-input');
            const subtotalInput = produkItem.querySelector('.subtotal-input');

            const qty = parseFloat(qtyInput ? qtyInput.value : 0) || 0;
            const harga = parseFloat(hargaInput ? hargaInput.value : 0) || 0;
            const subtotal = qty * harga;

            if (subtotalInput) subtotalInput.value = formatRupiah(subtotal);
            return subtotal;
        }

        function hitungTotal() {
            if (!totalPesananElem || !totalInput) return;
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(item => {
                total += hitungSubtotal(item);
            });
            totalPesananElem.textContent = formatRupiah(total);
            totalInput.value = total;
        }

        function updateProdukIndex() {
            document.querySelectorAll('.produk-item').forEach((item, index) => {
                item.dataset.index = index + 1;
            });
        }

        function initItemEvents(produkItem) {
            const produkSelect = produkItem.querySelector('.produk-select');
            const qtyInput = produkItem.querySelector('.qty-input');
            const hargaInput = produkItem.querySelector('.harga-input');
            const hapusBtn = produkItem.querySelector('.hapus-produk');
            const stokInfo = produkItem.querySelector('.stok-info');

            if (produkSelect) {
                produkSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const harga = selectedOption.dataset.harga || 0;
                    const stok = selectedOption.dataset.stok || 0;

                    if (hargaInput) hargaInput.value = harga;
                    if (qtyInput) {
                        qtyInput.max = stok;
                        qtyInput.value = 1;
                    }
                    if (stokInfo) {
                        stokInfo.textContent = `Stok tersedia: ${stok}`;
                        stokInfo.className = stok > 0 ? 'stok-info text-muted' : 'stok-info text-danger';
                    }

                    hitungSubtotal(produkItem);
                    hitungTotal();
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener('input', function() {
                    const maxStok = parseInt(this.max) || 999;
                    const value = parseInt(this.value) || 0;

                    if (value > maxStok) {
                        this.value = maxStok;
                        alert(`Jumlah melebihi stok tersedia (${maxStok})`);
                    } else if (value < 1) {
                        this.value = 1;
                    }

                    hitungSubtotal(produkItem);
                    hitungTotal();
                });
            }

            if (hargaInput) {
                hargaInput.addEventListener('input', function() {
                    hitungSubtotal(produkItem);
                    hitungTotal();
                });
            }

            if (hapusBtn) {
                hapusBtn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                        produkItem.remove();
                        hitungTotal();
                        updateProdukIndex();
                    }
                });
            }
        }

        function tambahProduk() {
            if (!produkTemplate || !produkContainer) return;
            produkCounter++;
            const clone = produkTemplate.content.cloneNode(true);
            const produkItem = clone.querySelector('.produk-item');
            produkItem.dataset.index = produkCounter;

            initItemEvents(produkItem);
            produkContainer.appendChild(produkItem);

            const produkSelect = produkItem.querySelector('.produk-select');
            if (produkSelect && produkSelect.options.length > 1) {
                produkSelect.dispatchEvent(new Event('change'));
            }
        }

        // Inisialisasi item produk yang sudah ada di HTML
        document.querySelectorAll('.produk-item').forEach(item => {
            produkCounter++;
            item.dataset.index = produkCounter;
            initItemEvents(item);
            hitungSubtotal(item);
        });

        if (tambahProdukBtn) {
            tambahProdukBtn.addEventListener('click', tambahProduk);
            if (document.querySelectorAll('.produk-item').length === 0) {
                tambahProduk();
            }
        }

        // Auto-fill Data Pemilik/Warga
        const wargaSelect = document.querySelector('#inputselect');
        if (wargaSelect) {
            wargaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const alamatTextarea = document.querySelector('#alamat');
                const rtInput = document.querySelector('#rt');
                const rwInput = document.querySelector('#rw');
                const telpInput = document.querySelector('#telp');

                if (selectedOption) {
                    if (alamatTextarea) alamatTextarea.value = selectedOption.dataset.alamat || '';
                    if (rtInput) rtInput.value = selectedOption.dataset.rt || '';
                    if (rwInput) rwInput.value = selectedOption.dataset.rw || '';
                    if (telpInput) telpInput.value = selectedOption.dataset.telp || '';
                }
            });
        }

        // Preview Logo
        const logoInput = document.querySelector('input[name="logo"]');
        if (logoInput) {
            logoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        let preview = document.querySelector('.logo-preview');
                        if (!preview) {
                            preview = document.createElement('div');
                            preview.className = 'logo-preview mt-3 text-center';
                            e.target.parentNode.appendChild(preview);
                        }
                        preview.innerHTML = `
                            <img src="${evt.target.result}" class="img-thumbnail" style="max-height: 150px;">
                            <p class="text-muted mt-2">Preview logo</p>
                        `;
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
