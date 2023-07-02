@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Ubah Data Kategori</h2>
    <div class="row justify-content-center">
        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ubah Kategori</h4>
                    <form class="forms-sample" method="POST" action="/kategori/{{ $kategori->id }}">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid  @enderror"
                                id="name" placeholder="Nama" value="{{ $kategori->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_kategori">Kode Kategori</label>
                            <input name="kode_kategori" type="text"
                                class="form-control @error('kode_kategori') is-invalid  @enderror" id="kode_kategori"
                                placeholder="Maksimal 3 karakter" value="{{ $kategori->kode_kategori }}">
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

@endsection