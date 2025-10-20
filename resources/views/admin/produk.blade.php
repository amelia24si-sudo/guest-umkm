@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h6>Add UMKM</h6>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nama Usaha</label>
                <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha') }}">
            </div>
            <!-- Tambahkan field lainnya: pemilik_warga_id (select), alamat, rt, rw, kategori, kontak, deskripsi -->
            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
