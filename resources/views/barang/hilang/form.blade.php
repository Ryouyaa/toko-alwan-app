@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Barang Hilang</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Barang Hilang</h4>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="namaBarang">Nama</label>
                            <input readonly type="text" class="form-control" id="namaBarang" placeholder="Nama" value="Spidol Hitam Permanent" />
                        </div>
                        <div class="form-group">
                            <label for="jumlahStok">Jumlah Stok</label>
                            <input type="number" class="form-control" id="jumlahStok" placeholder="Jumlah Stok" />
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <textarea class="form-control" name="detail" id="detail" cols="30" rows="7" style="height: unset;"></textarea>
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