@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Tambah Barang</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Tambah Barang</h4>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="namaBarang">Nama</label>
                            <input type="text" class="form-control" id="namaBarang" placeholder="Nama" />
                        </div>
                        <div class="form-group">
                            <label for="jumlahStok">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlahStok" placeholder="Jumlah Stok" />
                        </div>
                        <div class="form-group">
                            <label for="stokMinimum">Stok Minimum</label>
                            <input type="number" class="form-control" id="stokMinimum" placeholder="Jumlah Minimum" />
                        </div>
                        <div class="form-group">
                            <label for="hargaBeli">Harga Beli (per PCS)</label>
                            <input type="number" class="form-control" id="hargaBeli" placeholder="Harga Beli" />
                        </div>
                        <div class="form-group">
                            <label for="hargaJual">Harga Jual (per PCS)</label>
                            <input type="number" class="form-control" id="hargaJual" placeholder="Harga Jual" />
                        </div>
                        <div class="form-group">
                            <label for="hargaJual">Harga Jual (per Satuan)</label>
                            <input type="number" class="form-control" id="hargaJual" placeholder="Harga Jual" />
                        </div>
                        <div class="form-group">
                            <label for="satuanBarang" class="form-label">Satuan Barang</label>
                            <select id="satuanBarang" class="form-select">
                                <option selected>Pilih satuan barang</option>
                                <option value="">pcs</option>
                                <option value="">lusin</option>
                                <option value="">pack</option>
                                <option value="">karton</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
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
                            <td>: 200 Pcs (lembar)</td>
                        </tr>
                    </table>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection