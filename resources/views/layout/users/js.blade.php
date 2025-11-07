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

    document.addEventListener('DOMContentLoaded', function() {
        const pemilikSelect = document.getElementById('pemilik_warga_id');
        const alamatField = document.getElementById('alamat');
        const rtField = document.getElementById('rt');
        const rwField = document.getElementById('rw');
        const kontakField = document.getElementById('kontak');

        pemilikSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value !== '') {
                // Ambil data dari atribut data-*
                const alamat = selectedOption.getAttribute('data-alamat');
                const rt = selectedOption.getAttribute('data-rt');
                const rw = selectedOption.getAttribute('data-rw');
                const telp = selectedOption.getAttribute('data-telp');

                // Isi field dengan data warga
                alamatField.value = alamat || '';
                rtField.value = rt || '';
                rwField.value = rw || '';
                kontakField.value = telp || '';
            } else {
                // Kosongkan field jika tidak ada yang dipilih
                alamatField.value = '';
                rtField.value = '';
                rwField.value = '';
                kontakField.value = '';
            }
        });

        // Untuk edit form, jika ada data lama, isi otomatis
        @if (old('pemilik_warga_id'))
            const oldPemilikId = "{{ old('pemilik_warga_id') }}";
            const oldOption = pemilikSelect.querySelector(`option[value="${oldPemilikId}"]`);
            if (oldOption) {
                pemilikSelect.value = oldPemilikId;

                // Trigger change event untuk mengisi field
                const event = new Event('change');
                pemilikSelect.dispatchEvent(event);
            }
        @endif
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
</script>
