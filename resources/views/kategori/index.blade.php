@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Kategori</h2>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tabel Kategori</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Nama Kategori
                                            </th>
                                            <th>
                                                Kode Kategori
                                            </th>
                                            <th>
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoris as $kategori)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>
                                                {{ $kategori->name }}
                                            </td>
                                            <td>
                                                {{ $kategori->kode_kategori }}
                                            </td>
                                            <td>
                                                <a href="/kategori/{{ $kategori->id }}/edit"
                                                    class="btn btn-warning btn-sm">Ubah</a>
                                                <form action="/kategori/{{ $kategori->id }}" method="post"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Anda Yakin?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Kategori</h4>
                            <form class="forms-sample" method="POST" action="/kategori">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid  @enderror"
                                        id="name" placeholder="Nama" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kode_kategori">Kode Kategori</label>
                                    <input name="kode_kategori" type="text"
                                        class="form-control @error('kode_kategori') is-invalid  @enderror"
                                        id="kode_kategori" placeholder="Wajib 3 karakter" value="{{ old('kode_kategori') }}">
                                    @error('kode_kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a class="btn btn-light" href="/kategori">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection