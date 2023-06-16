@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Barang Hilang</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Barang Hilang</h4>
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form class="forms-sample" method="POST" action="/losts/{{ $lost->id }}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $lost->barang->id }}">
                        <div class="form-group">
                            <label for="namaBarang">Nama</label>
                            <input readonly type="text" class="form-control @error('namaBarang') is-invalid  @enderror" id="namaBarang" placeholder="Nama" value="{{ $lost->barang->name }}">
                            @error('namaBarang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlahStok">Jumlah Stok</label>
                            <input type="number" class="form-control @error('jumlah_stok') is-invalid  @enderror" id="jumlahStok" name="jumlah_stok" placeholder="Jumlah Stok" value="{{ $lost->jumlah_stok }}">
                            @error('jumlah_stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <textarea class="form-control @error('detail') is-invalid  @enderror" name="detail" id="detail" cols="30" rows="7" style="height: unset;" placeholder="Maksimal 80 karakter">{{ $lost->detail }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection