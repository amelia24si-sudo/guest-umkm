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

            // Reorder cards in DOM
            visibleCards.forEach(card => {
                umkmCards.appendChild(card);
            });
        }

        searchInput.addEventListener('input', filterAndSortCards);
        categoryFilter.addEventListener('change', filterAndSortCards);
        sortFilter.addEventListener('change', filterAndSortCards);
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
