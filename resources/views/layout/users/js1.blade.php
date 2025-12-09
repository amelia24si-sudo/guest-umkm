<!-- jQery -->
<script src="{{ asset('assets-admin/js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script src="{{ asset('assets-admin/js/bootstrap.js') }}"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- isotope js -->
<script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<!-- custom js -->
<script src="{{ asset('assets-admin/js/custom.js') }}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Inisialisasi Isotope filter
    $(document).ready(function() {
        // Init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.all',
            layoutMode: 'fitRows'
        });

        // Filter items on button click
        $('.filters_menu li').click(function() {
            $('.filters_menu li').removeClass('active');
            $(this).addClass('active');

            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    });

    $(document).ready(function() {
        $('#inputselect').select2() {
            placeholder: "Pilih UMKM",
            allowClear: true
        };
    });

    document.addEventListener('DOMContentLoaded', function() {
        const produkContainer = document.getElementById('produk-container');
        const produkTemplate = document.getElementById('produk-template');
        const tambahProdukBtn = document.getElementById('tambah-produk');
        const totalPesananElem = document.getElementById('total-pesanan');
        const totalInput = document.getElementById('total-input');
        let produkCounter = 0;

        // Fungsi untuk menambah produk
        function tambahProduk() {
            produkCounter++;
            const clone = produkTemplate.content.cloneNode(true);
            const produkItem = clone.querySelector('.produk-item');
            produkItem.dataset.index = produkCounter;

            // Atur event untuk elemen baru
            const produkSelect = produkItem.querySelector('.produk-select');
            const qtyInput = produkItem.querySelector('.qty-input');
            const hargaInput = produkItem.querySelector('.harga-input');
            const subtotalInput = produkItem.querySelector('.subtotal-input');
            const hapusBtn = produkItem.querySelector('.hapus-produk');

            produkSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.dataset.harga || 0;
                const stok = selectedOption.dataset.stok || 0;

                hargaInput.value = harga;
                qtyInput.max = stok;
                qtyInput.value = 1;

                // Update stok info
                const stokInfo = produkItem.querySelector('.stok-info');
                stokInfo.textContent = `Stok tersedia: ${stok}`;

                hitungSubtotal(produkItem);
                hitungTotal();
            });

            qtyInput.addEventListener('input', function() {
                const maxStok = parseInt(this.max) || 999;
                if (parseInt(this.value) > maxStok) {
                    this.value = maxStok;
                    alert(`Jumlah melebihi stok tersedia (${maxStok})`);
                }
                hitungSubtotal(produkItem);
                hitungTotal();
            });

            hargaInput.addEventListener('input', function() {
                hitungSubtotal(produkItem);
                hitungTotal();
            });

            hapusBtn.addEventListener('click', function() {
                produkItem.remove();
                hitungTotal();
            });

            produkContainer.appendChild(produkItem);
        }

        // Fungsi hitung subtotal per item
        function hitungSubtotal(produkItem) {
            const qty = parseFloat(produkItem.querySelector('.qty-input').value) || 0;
            const harga = parseFloat(produkItem.querySelector('.harga-input').value) || 0;
            const subtotal = qty * harga;

            produkItem.querySelector('.subtotal-input').value = formatRupiah(subtotal);
            return subtotal;
        }

        // Fungsi hitung total semua item
        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(item => {
                total += hitungSubtotal(item);
            });

            totalPesananElem.textContent = formatRupiah(total);
            totalInput.value = total;
        }

        // Fungsi format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        // Event listener untuk tombol tambah produk
        tambahProdukBtn.addEventListener('click', tambahProduk);

        // Auto-fill alamat berdasarkan warga yang dipilih
        const wargaSelect = document.querySelector('#inputselect');
        const alamatTextarea = document.querySelector('#alamat');
        const rtInput = document.querySelector('#rt');
        const rwInput = document.querySelector('#rw');

        wargaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption) {
                alamatTextarea.value = selectedOption.dataset.alamat || '';
                rtInput.value = selectedOption.dataset.rt || '';
                rwInput.value = selectedOption.dataset.rw || '';
            }
        });

        // Tambah produk pertama saat halaman dimuat
        tambahProduk();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const produkContainer = document.getElementById('produk-container');
        const produkTemplate = document.getElementById('produk-template');
        const tambahProdukBtn = document.getElementById('tambah-produk');
        const totalPesananElem = document.getElementById('total-pesanan');
        const totalInput = document.getElementById('total-input');
        let produkCounter = 0;

        // Inisialisasi produk yang sudah ada
        document.querySelectorAll('.produk-item').forEach(item => {
            produkCounter++;
            item.dataset.index = produkCounter;

            const produkSelect = item.querySelector('.produk-select');
            const qtyInput = item.querySelector('.qty-input');
            const hargaInput = item.querySelector('.harga-input');
            const subtotalInput = item.querySelector('.subtotal-input');
            const hapusBtn = item.querySelector('.hapus-produk');

            produkSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.dataset.harga || 0;
                const stok = selectedOption.dataset.stok || 0;

                hargaInput.value = harga;
                qtyInput.max = stok;

                // Update stok info
                const stokInfo = item.querySelector('.stok-info');
                stokInfo.textContent = `Stok tersedia: ${stok}`;

                hitungSubtotal(item);
                hitungTotal();
            });

            qtyInput.addEventListener('input', function() {
                const maxStok = parseInt(this.max) || 999;
                if (parseInt(this.value) > maxStok) {
                    this.value = maxStok;
                    alert(`Jumlah melebihi stok tersedia (${maxStok})`);
                }
                hitungSubtotal(item);
                hitungTotal();
            });

            hargaInput.addEventListener('input', function() {
                hitungSubtotal(item);
                hitungTotal();
            });

            hapusBtn.addEventListener('click', function() {
                item.remove();
                hitungTotal();
            });

            // Inisialisasi stok info untuk produk yang sudah ada
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            if (selectedOption) {
                const stok = selectedOption.dataset.stok || 0;
                const stokInfo = item.querySelector('.stok-info');
                stokInfo.textContent = `Stok tersedia: ${stok}`;
            }

            // Hitung subtotal awal untuk produk yang sudah ada
            hitungSubtotal(item);
        });

        // Fungsi untuk menambah produk baru
        function tambahProduk() {
            produkCounter++;
            const clone = produkTemplate.content.cloneNode(true);
            const produkItem = clone.querySelector('.produk-item');
            produkItem.dataset.index = produkCounter;

            const produkSelect = produkItem.querySelector('.produk-select');
            const qtyInput = produkItem.querySelector('.qty-input');
            const hargaInput = produkItem.querySelector('.harga-input');
            const subtotalInput = produkItem.querySelector('.subtotal-input');
            const hapusBtn = produkItem.querySelector('.hapus-produk');

            produkSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.dataset.harga || 0;
                const stok = selectedOption.dataset.stok || 0;

                hargaInput.value = harga;
                qtyInput.max = stok;

                const stokInfo = produkItem.querySelector('.stok-info');
                stokInfo.textContent = `Stok tersedia: ${stok}`;

                hitungSubtotal(produkItem);
                hitungTotal();
            });

            qtyInput.addEventListener('input', function() {
                const maxStok = parseInt(this.max) || 999;
                if (parseInt(this.value) > maxStok) {
                    this.value = maxStok;
                    alert(`Jumlah melebihi stok tersedia (${maxStok})`);
                }
                hitungSubtotal(produkItem);
                hitungTotal();
            });

            hargaInput.addEventListener('input', function() {
                hitungSubtotal(produkItem);
                hitungTotal();
            });

            hapusBtn.addEventListener('click', function() {
                produkItem.remove();
                hitungTotal();
            });

            produkContainer.appendChild(produkItem);
        }

        // Fungsi hitung subtotal per item
        function hitungSubtotal(produkItem) {
            const qty = parseFloat(produkItem.querySelector('.qty-input').value) || 0;
            const harga = parseFloat(produkItem.querySelector('.harga-input').value) || 0;
            const subtotal = qty * harga;

            produkItem.querySelector('.subtotal-input').value = formatRupiah(subtotal);
            return subtotal;
        }

        // Fungsi hitung total semua item
        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(item => {
                total += hitungSubtotal(item);
            });

            totalPesananElem.textContent = formatRupiah(total);
            totalInput.value = total;
        }

        // Fungsi format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        // Event listener untuk tombol tambah produk
        tambahProdukBtn.addEventListener('click', tambahProduk);

        // Auto-fill alamat berdasarkan warga yang dipilih
        const wargaSelect = document.querySelector('#inputselect');
        const alamatTextarea = document.querySelector('#alamat');
        const rtInput = document.querySelector('#rt');
        const rwInput = document.querySelector('#rw');

        wargaSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption) {
                alamatTextarea.value = selectedOption.dataset.alamat || '';
                rtInput.value = selectedOption.dataset.rt || '';
                rwInput.value = selectedOption.dataset.rw || '';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const produkContainer = document.getElementById('produk-container');
        const produkTemplate = document.getElementById('produk-template');
        const tambahProdukBtn = document.getElementById('tambah-produk');
        const totalPesananElem = document.getElementById('total-pesanan');
        const totalInput = document.getElementById('total-input');
        let produkCounter = 0;

        // Fungsi untuk menambah produk
        function tambahProduk() {
            produkCounter++;
            const clone = produkTemplate.content.cloneNode(true);
            const produkItem = clone.querySelector('.produk-item');
            produkItem.dataset.index = produkCounter;

            // Atur event untuk elemen baru
            const produkSelect = produkItem.querySelector('.produk-select');
            const qtyInput = produkItem.querySelector('.qty-input');
            const hargaInput = produkItem.querySelector('.harga-input');
            const subtotalInput = produkItem.querySelector('.subtotal-input');
            const hapusBtn = produkItem.querySelector('.hapus-produk');

            // Event ketika produk dipilih
            produkSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.dataset.harga || 0;
                const stok = selectedOption.dataset.stok || 0;

                hargaInput.value = harga;
                qtyInput.max = stok;
                qtyInput.value = 1;

                // Update stok info
                const stokInfo = produkItem.querySelector('.stok-info');
                stokInfo.textContent = `Stok tersedia: ${stok}`;
                stokInfo.className = stok > 0 ? 'text-muted' : 'text-danger';

                hitungSubtotal(produkItem);
                hitungTotal();
            });

            // Event ketika quantity berubah
            qtyInput.addEventListener('input', function() {
                const maxStok = parseInt(this.max) || 999;
                const stok = parseInt(this.max) || 0;
                const value = parseInt(this.value) || 0;

                if (value > maxStok) {
                    this.value = maxStok;
                    alert(`Jumlah melebihi stok tersedia (${stok})`);
                } else if (value < 1) {
                    this.value = 1;
                }

                hitungSubtotal(produkItem);
                hitungTotal();
            });

            // Event ketika harga diubah manual
            hargaInput.addEventListener('input', function() {
                hitungSubtotal(produkItem);
                hitungTotal();
            });

            // Event hapus produk
            hapusBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    produkItem.remove();
                    hitungTotal();
                    updateProdukIndex();
                }
            });

            produkContainer.appendChild(produkItem);

            // Trigger change event untuk produk pertama
            if (produkSelect.options.length > 1) {
                produkSelect.dispatchEvent(new Event('change'));
            }
        }

        // Fungsi hitung subtotal per item
        function hitungSubtotal(produkItem) {
            const qty = parseFloat(produkItem.querySelector('.qty-input').value) || 0;
            const harga = parseFloat(produkItem.querySelector('.harga-input').value) || 0;
            const subtotal = qty * harga;

            produkItem.querySelector('.subtotal-input').value = formatRupiah(subtotal);
            return subtotal;
        }

        // Fungsi hitung total semua item
        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(item => {
                total += hitungSubtotal(item);
            });

            totalPesananElem.textContent = formatRupiah(total);
            totalInput.value = total;
        }

        // Fungsi format rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        // Fungsi update index produk (setelah hapus)
        function updateProdukIndex() {
            const items = document.querySelectorAll('.produk-item');
            items.forEach((item, index) => {
                item.dataset.index = index + 1;
            });
        }

        // Event listener untuk tombol tambah produk
        tambahProdukBtn.addEventListener('click', tambahProduk);

        // Auto-fill alamat berdasarkan warga yang dipilih
        const wargaSelect = document.querySelector('#inputselect');
        const alamatTextarea = document.querySelector('#alamat');
        const rtInput = document.querySelector('#rt');
        const rwInput = document.querySelector('#rw');

        if (wargaSelect) {
            wargaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption) {
                    alamatTextarea.value = selectedOption.dataset.alamat || '';
                    rtInput.value = selectedOption.dataset.rt || '';
                    rwInput.value = selectedOption.dataset.rw || '';
                }
            });
        }

        // Tambah produk pertama saat halaman dimuat
        tambahProduk();

        // Validasi form sebelum submit
        const form = document.querySelector('.pesanan-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const produkItems = document.querySelectorAll('.produk-item');
                if (produkItems.length === 0) {
                    e.preventDefault();
                    alert('Silakan tambahkan minimal satu produk!');
                    return false;
                }

                // Validasi setiap produk
                let isValid = true;
                produkItems.forEach(item => {
                    const produkSelect = item.querySelector('.produk-select');
                    const qtyInput = item.querySelector('.qty-input');

                    if (!produkSelect.value) {
                        isValid = false;
                        produkSelect.focus();
                    }

                    if (parseInt(qtyInput.value) < 1) {
                        isValid = false;
                        qtyInput.focus();
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Pastikan semua produk telah dipilih dan quantity minimal 1!');
                    return false;
                }
            });
        }
    });

    document.querySelector('input[name="logo"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Buat preview
            let preview = document.querySelector('.logo-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.className = 'logo-preview mt-3 text-center';
                e.target.parentNode.appendChild(preview);
            }
            preview.innerHTML = `
                <img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">
                <p class="text-muted mt-2">Preview logo</p>
            `;
        }
        reader.readAsDataURL(file);
    }
});

// Auto-fill alamat dari pemilik yang dipilih
document.getElementById('inputselect').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        document.getElementById('alamat').value = selectedOption.dataset.alamat || '';
        document.getElementById('rt').value = selectedOption.dataset.rt || '';
        document.getElementById('rw').value = selectedOption.dataset.rw || '';
        document.getElementById('telp').value = selectedOption.dataset.telp || '';
    }
});
</script>
