@extends('layout.dashboard.app')

@section('content')
<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Warga</h6>
                <a href="{{ url('warga/create') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-2"></i>Tambah Warga
                </a>
            </div>

            <!-- Card grid -->
            @if(isset($wargas) && $wargas->count())
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($wargas as $warga)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-start">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="card-title mb-0">{{ $warga->nama }}</h5>
                                    <small class="text-muted">NIK: {{ $warga->nik }}</small>
                                </div>
                                <div>
                                    <span class="badge @if(strtolower($warga->jenis_kelamin) == 'perempuan') bg-success @else bg-primary @endif">{{ $warga->jenis_kelamin }}</span>
                                </div>
                            </div>

                            <p class="mb-1"><strong>Agama:</strong> {{ $warga->agama ?? '-' }}</p>
                            <p class="mb-1"><strong>Pekerjaan:</strong> {{ $warga->pekerjaan ?? '-' }}</p>
                            <p class="mb-2 mb-md-3">
                                <i class="fa fa-phone me-1"></i>{{ $warga->telepon ?? '-' }}<br>
                                <i class="fa fa-envelope me-1"></i>{{ $warga->email ?? '-' }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ url('warga/'.$warga->id) }}" class="btn btn-sm btn-primary" title="View"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('warga/'.$warga->id.'/edit') }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                <form action="{{ url('warga/'.$warga->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info mb-0">Belum ada data warga. <a href="{{ url('warga/create') }}">Tambah Warga</a></div>
            @endif
        </div>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" style="width: 5%">No</th>
                        <th scope="col" style="width: 15%">NIK</th>
                        <th scope="col" style="width: 20%">Nama</th>
                        <th scope="col" style="width: 20%">Jenis Kelamin</th>
                        <th scope="col" style="width: 10%">Agama</th>
                        <th scope="col" style="width: 15%">Pekerjaan</th>
                        <th scope="col" style="width: 15%">Kontak</th>
                        <th scope="col" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warga as $index => $w)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $w->no_ktp }}</td>
                        <td>{{ $w->nama }}</td>
                        <td>
                            @if($w->jenis_kelamin == 'L')
                                <span class="badge bg-primary">Laki-laki</span>
                            @else
                                <span class="badge bg-success">Perempuan</span>
                            @endif
                        </td>
                        <td>{{ $w->agama }}</td>
                        <td>{{ $w->pekerjaan }}</td>
                        <td>
                            @if($w->telp)
                                <i class="fa fa-phone me-1"></i>{{ $w->telp }}
                            @endif
                            @if($w->email)
                                <br><i class="fa fa-envelope me-1"></i>{{ $w->email }}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('warga.show', $w) }}" class="btn btn-primary" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('warga.edit', $w) }}" class="btn btn-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $w) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-primary" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data warga</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Warga List End -->
@endsection
