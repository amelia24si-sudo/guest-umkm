<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-admin/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets-admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets-admin/js/main.js') }}"></script>
<script>
    // UMKM
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const sortFilter = document.getElementById('sortFilter');
        const umkmCards = document.getElementById('umkmCards');
        const cards = Array.from(umkmCards.getElementsByClassName('umkm-card'));

        function filterAndSortCards() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const sortBy = sortFilter.value;

            // Filter cards
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const category = card.getAttribute('data-category');
                const created = card.getAttribute('data-created');

                const matchesSearch = name.includes(searchTerm);
                const matchesCategory = !selectedCategory || category === selectedCategory;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Sort cards
            const visibleCards = cards.filter(card => card.style.display !== 'none');

            visibleCards.sort((a, b) => {
                const aName = a.getAttribute('data-name');
                const bName = b.getAttribute('data-name');
                const aCreated = new Date(a.getAttribute('data-created'));
                const bCreated = new Date(b.getAttribute('data-created'));

                switch (sortBy) {
                    case 'newest':
                        return bCreated - aCreated;
                    case 'oldest':
                        return aCreated - bCreated;
                    case 'name_asc':
                        return aName.localeCompare(bName);
                    case 'name_desc':
                        return bName.localeCompare(aName);
                    default:
                        return 0;
                }
            });

            // Reorder cards in DOM - PERBAIKAN: Hapus dulu semua card yang visible
            // Simpan card yang tidak visible
            const hiddenCards = cards.filter(card => card.style.display === 'none');

            // Hapus semua cards dari container
            while (umkmCards.firstChild) {
                umkmCards.removeChild(umkmCards.firstChild);
            }

            // Tambahkan kembali cards yang sudah diurutkan (visible dulu, kemudian hidden)
            visibleCards.forEach(card => umkmCards.appendChild(card));
            hiddenCards.forEach(card => umkmCards.appendChild(card));
        }

        searchInput.addEventListener('input', filterAndSortCards);
        categoryFilter.addEventListener('change', filterAndSortCards);
        sortFilter.addEventListener('change', filterAndSortCards);
    });

    // Perbaikan script untuk auto-fill data warga
    document.addEventListener('DOMContentLoaded', function() {
        const pemilikSelect = document.getElementById('inputselect');
        const alamatField = document.getElementById('alamat');
        const rtField = document.getElementById('rt');
        const rwField = document.getElementById('rw');
        const kontakField = document.getElementById('telp');

        function fillWargaData() {
            const selectedOption = pemilikSelect.options[pemilikSelect.selectedIndex];

            if (selectedOption.value && selectedOption.value !== '') {
                // Ambil data dari atribut data-*
                const alamat = selectedOption.getAttribute('data-alamat') || '';
                const rt = selectedOption.getAttribute('data-rt') || '';
                const rw = selectedOption.getAttribute('data-rw') || '';
                const telp = selectedOption.getAttribute('data-telp') || '';

                console.log('Data warga:', {
                    alamat,
                    rt,
                    rw,
                    telp
                }); // Debug log

                // Isi field dengan data warga
                alamatField.value = alamat;
                rtField.value = rt;
                rwField.value = rw;
                kontakField.value = telp;
            } else {
                // Kosongkan field jika tidak ada yang dipilih
                alamatField.value = '';
                rtField.value = '';
                rwField.value = '';
                kontakField.value = '';
            }
        }

        // Event listener untuk perubahan select
        pemilikSelect.addEventListener('change', fillWargaData);

        // Trigger change event jika sudah ada value dari old() atau default
        setTimeout(() => {
            if (pemilikSelect.value !== '') {
                fillWargaData();
            }
        }, 100);

        // Debug: Log semua options untuk memastikan data ada
        console.log('Options count:', pemilikSelect.options.length);
        Array.from(pemilikSelect.options).forEach((option, index) => {
            console.log(`Option ${index}:`, {
                value: option.value,
                alamat: option.getAttribute('data-alamat'),
                rt: option.getAttribute('data-rt'),
                rw: option.getAttribute('data-rw'),
                telp: option.getAttribute('data-telp')
            });
        });
    });


    // UMKM

    // WARGA
    document.addEventListener('DOMContentLoaded', function() {
        const searchWarga = document.getElementById('searchWarga');
        const genderFilter = document.getElementById('genderFilter');
        const pekerjaanFilter = document.getElementById('pekerjaanFilter');
        const umkmFilter = document.getElementById('umkmFilter');
        const wargaCards = document.getElementById('wargaCards');

        // If this page doesn't include warga elements, skip this block to avoid JS errors
        if (!wargaCards || !searchWarga) {
            return;
        }

        const cards = Array.from(wargaCards.getElementsByClassName('warga-card'));

        function filterWargaCards() {
            const searchTerm = (searchWarga.value || '').toLowerCase();
            const selectedGender = genderFilter ? genderFilter.value : '';
            const selectedPekerjaan = pekerjaanFilter ? pekerjaanFilter.value : '';
            const selectedUmkm = umkmFilter ? umkmFilter.value : '';

            let visibleCards = [];

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const gender = card.getAttribute('data-gender') || '';
                const pekerjaan = card.getAttribute('data-pekerjaan') || '';
                const umkmStatus = card.getAttribute('data-umkm') || '';

                const matchesSearch = !searchTerm || name.includes(searchTerm);
                const matchesGender = !selectedGender || gender === selectedGender;
                const matchesPekerjaan = !selectedPekerjaan || pekerjaan === selectedPekerjaan;
                const matchesUmkm = !selectedUmkm || umkmStatus === selectedUmkm;

                if (matchesSearch && matchesGender && matchesPekerjaan && matchesUmkm) {
                    card.style.display = '';
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });

            updateWargaCountDisplay(visibleCards.length);
        }

        function updateWargaCountDisplay(count) {
            const existingCount = document.getElementById('filteredWargaCount');
            if (existingCount) {
                existingCount.remove();
            }

            const countDisplay = document.createElement('div');
            countDisplay.id = 'filteredWargaCount';
            countDisplay.className = 'mt-3';
            countDisplay.innerHTML =
                `<small class="text-muted">Menampilkan ${count} dari ${cards.length} warga</small>`;

            const infoSection = wargaCards.nextElementSibling;
            if (infoSection) {
                infoSection.before(countDisplay);
            }
        }

        searchWarga.addEventListener('input', filterWargaCards);
        if (genderFilter) genderFilter.addEventListener('change', filterWargaCards);
        if (pekerjaanFilter) pekerjaanFilter.addEventListener('change', filterWargaCards);
        if (umkmFilter) umkmFilter.addEventListener('change', filterWargaCards);

        updateWargaCountDisplay(cards.length);
    });
    // WARGA

    // USER
    document.addEventListener('DOMContentLoaded', function() {
        const searchUser = document.getElementById('searchUser');
        const sortUser = document.getElementById('sortUser');
        const monthFilter = document.getElementById('monthFilter');
        const userCards = document.getElementById('userCards');
        const cards = userCards ? Array.from(userCards.getElementsByClassName('user-card')) : [];

        function filterAndSortUserCards() {
            const searchTerm = searchUser.value.toLowerCase();
            const sortBy = sortUser.value;
            const selectedMonth = monthFilter.value;

            let visibleCards = [];
            const currentMonth = new Date().toISOString().slice(0, 7);
            const lastMonth = new Date(new Date().setMonth(new Date().getMonth() - 1)).toISOString().slice(0,
                7);

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const email = card.getAttribute('data-email');
                const month = card.getAttribute('data-month');

                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                let matchesMonth = true;

                if (selectedMonth === 'this_month') {
                    matchesMonth = month === currentMonth;
                } else if (selectedMonth === 'last_month') {
                    matchesMonth = month === lastMonth;
                }

                if (matchesSearch && matchesMonth) {
                    card.style.display = 'block';
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });

            // Sort cards
            visibleCards.sort((a, b) => {
                const aName = a.getAttribute('data-name');
                const bName = b.getAttribute('data-name');
                const aCreated = new Date(a.getAttribute('data-created'));
                const bCreated = new Date(b.getAttribute('data-created'));

                switch (sortBy) {
                    case 'newest':
                        return bCreated - aCreated;
                    case 'oldest':
                        return aCreated - bCreated;
                    case 'name_asc':
                        return aName.localeCompare(bName);
                    case 'name_desc':
                        return bName.localeCompare(aName);
                    default:
                        return 0;
                }
            });

            // Reorder cards in DOM
            visibleCards.forEach(card => {
                userCards.appendChild(card);
            });

            updateUserCountDisplay(visibleCards.length);
        }

        function updateUserCountDisplay(count) {
            const existingCount = document.getElementById('filteredUserCount');
            if (existingCount) {
                existingCount.remove();
            }

            const countDisplay = document.createElement('div');
            countDisplay.id = 'filteredUserCount';
            countDisplay.className = 'mt-3';
            countDisplay.innerHTML =
                `<small class="text-muted">Menampilkan ${count} dari ${cards.length} user</small>`;

            const infoSection = userCards.nextElementSibling;
            if (infoSection) {
                infoSection.before(countDisplay);
            }
        }

        if (searchUser && sortUser && monthFilter) {
            searchUser.addEventListener('input', filterAndSortUserCards);
            sortUser.addEventListener('change', filterAndSortUserCards);
            monthFilter.addEventListener('change', filterAndSortUserCards);

            updateUserCountDisplay(cards.length);
        }
    });
    // USER

     document.addEventListener('DOMContentLoaded', function() {
            const produkContainer = document.getElementById('produk-container');
            const produkTemplate = document.getElementById('produk-template');
            const tambahProdukBtn = document.getElementById('tambah-produk');
            const totalPesananElem = document.getElementById('total-pesanan');
            const totalInput = document.getElementById('total-input');
            let produkCounter = 0;

            // Format rupiah
            function formatRupiah(angka) {
                return 'Rp ' + angka.toLocaleString('id-ID');
            }

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
                const btnDecrement = produkItem.querySelector('.btn-decrement');
                const btnIncrement = produkItem.querySelector('.btn-increment');
                const produkInfo = produkItem.querySelector('.produk-info');
                const stokInfo = produkItem.querySelector('.stok-info');
                const hargaInfo = produkItem.querySelector('.harga-info');
                const infoIcon = produkItem.querySelector('[id^="info-icon-"]');

                // Update ID info icon
                if (infoIcon) {
                    infoIcon.id = `info-icon-${produkCounter}`;
                }

                // Event ketika produk dipilih (SAMA SEPERTI Warga)
                produkSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption && selectedOption.value) {
                        const harga = selectedOption.dataset.harga || 0;
                        const stok = selectedOption.dataset.stok || 0;
                        const nama = selectedOption.dataset.nama || '';

                        // Set nilai
                        hargaInput.value = harga;
                        qtyInput.max = stok;
                        qtyInput.value = 1;

                        // Tampilkan info produk
                        produkInfo.style.display = 'block';
                        stokInfo.textContent = stok;
                        hargaInfo.textContent = formatRupiah(harga);

                        // Update warna stok
                        if (stok > 10) {
                            stokInfo.className = 'text-success fw-bold';
                        } else if (stok > 0) {
                            stokInfo.className = 'text-warning fw-bold';
                        } else {
                            stokInfo.className = 'text-danger fw-bold';
                        }

                        // Tampilkan icon info
                        if (infoIcon) {
                            infoIcon.style.display = 'inline-block';
                        }

                        // Hitung subtotal
                        hitungSubtotal(produkItem);
                        hitungTotal();
                    } else {
                        produkInfo.style.display = 'none';
                        if (infoIcon) {
                            infoIcon.style.display = 'none';
                        }
                    }
                });

                // Event untuk tombol decrement
                btnDecrement.addEventListener('click', function() {
                    let currentValue = parseInt(qtyInput.value) || 1;
                    if (currentValue > 1) {
                        qtyInput.value = currentValue - 1;
                        hitungSubtotal(produkItem);
                        hitungTotal();
                    }
                });

                // Event untuk tombol increment
                btnIncrement.addEventListener('click', function() {
                    let currentValue = parseInt(qtyInput.value) || 1;
                    const maxStok = parseInt(qtyInput.max) || 999;
                    if (currentValue < maxStok) {
                        qtyInput.value = currentValue + 1;
                        hitungSubtotal(produkItem);
                        hitungTotal();
                    } else {
                        alert(`Jumlah melebihi stok tersedia (${maxStok})`);
                    }
                });

                // Event ketika quantity berubah manual
                qtyInput.addEventListener('input', function() {
                    const maxStok = parseInt(this.max) || 999;
                    const stok = parseInt(this.max) || 0;
                    let value = parseInt(this.value) || 1;

                    if (value > maxStok) {
                        value = maxStok;
                        this.value = maxStok;
                        alert(`Jumlah melebihi stok tersedia (${stok})`);
                    } else if (value < 1) {
                        value = 1;
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
                    if (confirm('Apakah Anda yakin ingin menghapus produk ini dari pesanan?')) {
                        produkItem.remove();
                        hitungTotal();
                        updateProdukIndex();
                        if (produkCounter > 0) produkCounter--;
                    }
                });

                // Tambahkan ke container
                produkContainer.appendChild(produkItem);

                // Jika ada data old (dari validation error), set nilai
                if (window.oldProdukData && window.oldProdukData[produkCounter - 1]) {
                    const oldData = window.oldProdukData[produkCounter - 1];
                    setTimeout(() => {
                        if (produkSelect.querySelector(`option[value="${oldData.produk_id}"]`)) {
                            produkSelect.value = oldData.produk_id;
                            produkSelect.dispatchEvent(new Event('change'));

                            if (oldData.qty) {
                                qtyInput.value = oldData.qty;
                            }
                            if (oldData.harga_satuan) {
                                hargaInput.value = oldData.harga_satuan;
                            }

                            hitungSubtotal(produkItem);
                            hitungTotal();
                        }
                    }, 100);
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

            // Fungsi update index produk (setelah hapus)
            function updateProdukIndex() {
                const items = document.querySelectorAll('.produk-item');
                items.forEach((item, index) => {
                    item.dataset.index = index + 1;
                    const infoIcon = item.querySelector('[id^="info-icon-"]');
                    if (infoIcon) {
                        infoIcon.id = `info-icon-${index + 1}`;
                    }
                });
            }

            // Event listener untuk tombol tambah produk
            tambahProdukBtn.addEventListener('click', tambahProduk);
            // Validasi form sebelum submit
            const form = document.querySelector('.pesanan-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const produkItems = document.querySelectorAll('.produk-item');
                    if (produkItems.length === 0) {
                        e.preventDefault();
                        alert('Silakan tambahkan minimal satu produk ke dalam pesanan!');
                        tambahProdukBtn.focus();
                        return false;
                    }

                    // Validasi setiap produk
                    let isValid = true;
                    let errorMessage = '';

                    produkItems.forEach((item, index) => {
                        const produkSelect = item.querySelector('.produk-select');
                        const qtyInput = item.querySelector('.qty-input');
                        const hargaInput = item.querySelector('.harga-input');

                        if (!produkSelect.value) {
                            isValid = false;
                            errorMessage = `Produk ke-${index + 1} belum dipilih!`;
                            produkSelect.focus();
                        } else if (parseInt(qtyInput.value) < 1) {
                            isValid = false;
                            errorMessage = `Quantity produk ke-${index + 1} minimal 1!`;
                            qtyInput.focus();
                        } else if (parseFloat(hargaInput.value) <= 0) {
                            isValid = false;
                            errorMessage = `Harga produk ke-${index + 1} tidak valid!`;
                            hargaInput.focus();
                        }

                        // Cek stok
                        const selectedOption = produkSelect.options[produkSelect.selectedIndex];
                        const stok = parseInt(selectedOption?.dataset.stok) || 0;
                        const qty = parseInt(qtyInput.value) || 0;

                        if (qty > stok) {
                            isValid = false;
                            errorMessage =
                                `Stok ${selectedOption?.dataset.nama} tidak mencukupi! Stok tersedia: ${stok}`;
                            qtyInput.focus();
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        alert(errorMessage);
                        return false;
                    }
                });
            }

            // Tambah produk pertama saat halaman dimuat
            tambahProduk();

            // Handle old data dari validation error
            window.oldProdukData = @json(old('produk_id', [])).map((produkId, index) => ({
                produk_id: produkId,
                qty: @json(old('qty', []))[index],
                harga_satuan: @json(old('harga_satuan', []))[index]
            }));
        });
</script>
