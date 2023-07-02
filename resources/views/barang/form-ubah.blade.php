@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Ubah Data Barang</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Ubah Barang</h4>
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form class="forms-sample" method="post" action="/barangs/{{ $barang->id }}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid  @enderror"
                                id="name" placeholder="Nama" value="{{ $barang->name }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jumlah_stok">Jumlah Stok</label>
                            <input name="jumlah_stok" type="number"
                                class="form-control @error('jumlah_stok') is-invalid  @enderror" id="jumlah_stok"
                                placeholder="Jumlah Stok" min="0" value="{{ $barang->jumlah_stok }}">
                            @error('jumlah_stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stok_minimum">Stok Minimum</label>
                            <input name="stok_minimum" type="number"
                                class="form-control @error('stok_minimum') is-invalid  @enderror" id="stok_minimum"
                                placeholder="Jumlah Minimum" min="0" value="{{ $barang->stok_minimum }}">
                            @error('stok_minimum')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli (per PCS)</label>
                            <input name="harga_beli" type="number"
                                class="form-control @error('harga_beli') is-invalid  @enderror" id="harga_beli"
                                placeholder="Harga Beli" min="0" value="{{ $barang->harga_beli }}">
                            @error('harga_beli')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual (per PCS)</label>
                            <input name="harga_jual" type="number"
                                class="form-control @error('harga_jual') is-invalid  @enderror" id="harga_jual"
                                placeholder="Harga Jual" min="0" value="{{ $barang->harga_jual }}">
                            @error('harga_jual')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori_id" class="form-label">Kategori Barang</label>
                            <select name="kategori_id" id="kategori_id"
                                class="form-select @error('kategori_id') is-invalid @enderror">
                                <option value="">Pilih kategori barang</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kategori->id == $barang->kategori_id ?
                                    'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a class="btn btn-light" href="/daftar-barang">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Standar Satuan</h4>
                    <table>
                        <tr>
                            <td>1 Lusin</td>
                            <td>: 12 Pcs</td>
                        </tr>
                        <tr>
                            <td>1 Kodi</td>
                            <td>: 20 Pcs</td>
                        </tr>
                        <tr>
                            <td>1 Gross</td>
                            <td>: 144 Pcs</td>
                        </tr>
                        <tr>
                            <td>1 Rim</td>
                            <td>: 500 Pcs (lembar)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection