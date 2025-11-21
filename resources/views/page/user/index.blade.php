<section class="container-fluid pt-4 px-4">
    <section class="row g-4">
        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">Total User</p>
                    <h6 class="mb-0">{{ $users->total() }}</h6>
                </section>
            </section>
        </section>

        <section class="col-sm-6 col-xl-3">
            <section class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-calendar-plus fa-3x text-primary"></i>
                <section class="ms-3">
                    <p class="mb-2">User Baru (Bulan Ini)</p>
                    <h6 class="mb-0">{{ \App\Models\User::where('created_at', '>=', now()->startOfMonth())->count() }}
                    </h6>
                </section>
            </section>
        </section>
    </section>
</section>
<!-- Statistics End -->

<!-- User Card View Start -->
<section class="container-fluid pt-4 px-4">
    <section class="bg-light text-center rounded p-4">
        <section class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Daftar Semua User</h6>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Tambah User
            </a>
        </section>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <div class="flex-grow-1 text-center">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                    style="background: transparent; border: none; font-size: 1.5rem; line-height: 1; padding: 0.5rem; color: inherit;">
                    ×
                </button>
            </div>
        @endif

        @if (session('error'))
            <section class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </section>
        @endif

        <!-- Filter dan Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-4">
            <section class="row g-3 justify-content-center">
                <!-- Search -->
                <section class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama atau email...">
                        <button type="submit" class="input-group-text">
                            <i class="fa fa-search"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn-clear ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </section>

                <!-- Sorting -->
                <section class="col-md-3">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z
                        </option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A
                        </option>
                    </select>
                </section>

                <!-- Month Filter -->
                <section class="col-md-3">
                    <select name="month" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Bulan</option>
                        <option value="this_month" {{ request('month') == 'this_month' ? 'selected' : '' }}>Bulan Ini
                        </option>
                        <option value="last_month" {{ request('month') == 'last_month' ? 'selected' : '' }}>Bulan Lalu
                        </option>
                    </select>
                </section>
            </section>
        </form>

        <!-- Card View -->
        <section class="row" id="userCards">
            @forelse($users as $user)
                <section class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <section class="card h-100 shadow-sm">
                        <section class="card-body d-flex flex-column">
                            <!-- Header dengan Avatar -->
                            <section class="text-center mb-3">
                                <section
                                    class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width: 80px; height: 80px; font-size: 30px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </section>
                                <h5 class="card-title mb-1">{{ $user->name }}</h5>
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </section>

                            <!-- Informasi User -->
                            <section class="mb-4">
                                <section class="row text-center">
                                    <section class="col-6">
                                        <small class="text-muted d-block">Status</small>
                                        @if (auth()->id() == $user->id)
                                            <span class="badge bg-success">Anda</span>
                                        @else
                                            <span class="badge bg-primary">Aktif</span>
                                        @endif
                                    </section>
                                    <section class="col-6">
                                        <small class="text-muted d-block">Role</small>
                                        <span class="badge bg-info">User</span>
                                    </section>
                                </section>
                            </section>

                            <!-- Tanggal Bergabung -->
                            <section class="mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fa fa-calendar me-1"></i>
                                        Bergabung:
                                    </small>
                                    <small class="text-muted">
                                        {{ $user->created_at->format('d M Y') }}
                                    </small>
                                </section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fa fa-clock me-1"></i>
                                        Pukul:
                                    </small>
                                    <small class="text-muted">
                                        {{ $user->created_at->format('H:i') }}
                                    </small>
                                </section>
                            </section>

                            <!-- Tombol Aksi -->
                            <section class="mt-auto">
                                <section class="btn-group w-100" role="group">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-primary btn-sm" title="Edit User">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-primary btn-sm"
                                            title="Hapus User" {{ auth()->id() == $user->id ? 'disabled' : '' }}
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            @empty
                <section class="col-12">
                    <section class="text-center py-5">
                        <i class="fa fa-users fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Data User</h5>
                        <p class="text-muted mb-4">Mulai dengan menambahkan user pertama Anda</p>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Tambah User Pertama
                        </a>
                    </section>
                </section>
            @endforelse
        </section>

        <!-- Pagination -->
        @if ($users->hasPages())
            <section class="mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </section>
        @else
            <section class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $users->count() }} user
                </small>
            </section>
        @endif
    </section>
</section>
