
    <section class="offer_section layout_padding-bottom">
        <div class="offer_container">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('assets-admin/img/traditional-japanese-food-court.jpg') }}" alt="">
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
                                    Daftar <i class="fas fa-user ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  ">
                        <div class="box ">
                            <div class="img-box">
                                <img src="{{ asset('assets-admin/img/sales-assistant-handing-out-shopping-bag-customer.jpg') }}" alt="">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    Total UMKM
                                </h5>
                                <h6>
                                    <span>{{ \App\Models\Umkm::count() }}</span>
                                </h6>
                                <a href="">
                                    Daftar <i class="fas fa-user ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
