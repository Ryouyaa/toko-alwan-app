@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Barang</h2>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Barang</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nama Barang
                                </th>
                                <th>
                                    Stok Barang
                                </th>
                                <th>
                                    Stok Minimum
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Spidol Hitam Permanent
                                </td>
                                <td>
                                    33
                                </td>
                                <td>
                                    15
                                </td>
                                <td class="py-0">
                                    <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Spidol Hitam Permanent
                                </td>
                                <td>
                                    33
                                </td>
                                <td>
                                    15
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    Spidol Hitam Permanent
                                </td>
                                <td>
                                    33
                                </td>
                                <td>
                                    15
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection