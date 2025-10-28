@extends('layout.admin.app')

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
                    <i class="fa fa-user-shield fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Admin</p>
                        <h6 class="mb-0">{{ $users->where('role', 'admin')->count() }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">User Biasa</p>
                        <h6 class="mb-0">{{ $users->where('role', 'user')->count() }}</h6>
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

    <!-- User List Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Semua User</h6>
                <a href="{{ route('user.create') }}" class="btn btn-primary">
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

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 25%">Nama</th>
                            <th scope="col" style="width: 25%">Email</th>
                            <th scope="col" style="width: 15%">Role</th>
                            <th scope="col" style="width: 20%">Tanggal Dibuat</th>
                            <th scope="col" style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($users) && $users->count() > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                style="width: 35px; height: 35px; font-size: 14px;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            <span class="badge bg-danger">
                                                <i class="fa fa-user-shield me-1"></i>Admin
                                            </span>
                                        @else
                                            <span class="badge bg-primary">
                                                <i class="fa fa-user me-1"></i>User
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <i class="fa fa-calendar me-1"></i>
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fa fa-clock me-1"></i>
                                            {{ $user->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit User" data-bs-toggle="tooltip">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus User"
                                                    data-bs-toggle="tooltip"
                                                    {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fa fa-users fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Data User</h5>
                                        <p class="text-muted mb-4">Mulai dengan menambahkan user pertama Anda</p>
                                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus me-2"></i>Tambah User Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- User List End -->
@endsection
