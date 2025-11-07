
    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('assets-admin/img/o1.jpg') }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Kategori Terbanyak
                                </h5>
                                <h6>
                                    <span> @php
                                    $kategoriTerbanyak = \App\Models\Umkm::select('kategori')
                                        ->groupBy('kategori')
                                        ->orderByRaw('COUNT(*) DESC')
                                        ->value('kategori');
                                @endphp
                                {{ $kategoriTerbanyak ?? 'Belum ada data' }}</span>
                                </h6>
                                <a href="">
                                    Daftar <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('assets-admin/img/o2.jpg') }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Total UMKM
                                </h5>
                                <h6>
                                    <span>{{ \App\Models\Umkm::count() }}</span>
                                </h6>
                                <a href="">
                                    Daftar <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="20" cy="21" r="1"></circle>
                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
