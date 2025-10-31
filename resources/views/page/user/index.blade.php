@extends('layout.dashboard.app')

@section('content')
    <!-- Statistics Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total User</p>
                        <h6 class="mb-0">{{ $users->count() }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-plus fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">User Baru (Bulan Ini)</p>
                        <h6 class="mb-0">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistics End -->

    <!-- User Card View Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Semua User</h6>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-2"></i>Tambah User
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Options -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" id="searchUser" class="form-control" placeholder="Cari nama user...">
                </div>
                <div class="col-md-3">
                    <select id="sortUser" class="form-select">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="name_asc">Nama A-Z</option>
                        <option value="name_desc">Nama Z-A</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="monthFilter" class="form-select">
                        <option value="">Semua Bulan</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                    </select>
                </div>
            </div>

            <!-- Card View -->
            <div class="row" id="userCards">
                @if (isset($users) && $users->count() > 0)
                    @foreach ($users as $user)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4 user-card" data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}" data-created="{{ $user->created_at }}"
                            data-month="{{ $user->created_at->format('Y-m') }}">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <!-- Header dengan Avatar -->
                                    <div class="text-center mb-3">
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                                            style="width: 80px; height: 80px; font-size: 30px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <h5 class="card-title mb-1">{{ $user->name }}</h5>
                                        <p class="text-muted mb-0">{{ $user->email }}</p>
                                    </div>

                                    <!-- Informasi User -->
                                    <div class="mb-4">
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Status</small>
                                                @if (auth()->id() == $user->id)
                                                    <span class="badge bg-success">Anda</span>
                                                @else
                                                    <span class="badge bg-primary">Aktif</span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Role</small>
                                                <span class="badge bg-info">User</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Bergabung -->
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fa fa-calendar me-1"></i>
                                                Bergabung:
                                            </small>
                                            <small class="text-muted">
                                                {{ $user->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fa fa-clock me-1"></i>
                                                Pukul:
                                            </small>
                                            <small class="text-muted">
                                                {{ $user->created_at->format('H:i') }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="mt-auto">
                                        <div class="btn-group w-100" role="group">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fa fa-users fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Data User</h5>
                            <p class="text-muted mb-4">Mulai dengan menambahkan user pertama Anda</p>
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus me-2"></i>Tambah User Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Info Jumlah Data -->
            <div class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ $users->count() ?? 0 }} user
                </small>
            </div>
        </div>
    </div>
    <!-- User Card View End -->
@endsection
