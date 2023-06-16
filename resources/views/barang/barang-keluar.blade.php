@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Update Barang Keluar</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <form class="search-form input-group rounded" action="/barang-masuk">
                <input name="search" type="search" class="form-control" placeholder="Search Here" title="Search here">
                <button style="height: 2rem" class="btn btn-outline-secondary justify-content-center py-0" type="submit" id="button-addon2" class="p-0">
                    <i class="icon-search"></i>
                </button>                
            </form>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Hasil Pencarian</h4>
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
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">Tambahkan ke list</a>
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
                                    <a href="" class="btn btn-primary btn-sm">Tambahkan ke list</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr class="pt-1">

    <div class="col-md-2 mb-2">
        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
            </span>
            <input type="text" class="form-control">
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Tabel Barang</h4>
                <code>*List barang yang ingin diupdate</code>
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
                                    Update Jumlah Stok
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
                                <td>
                                    <input type="number" name="updateStok" id="updateStok">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-rounded btn-icon">
                                        <i class="mdi mdi-trash-can text-danger"></i>
                                    </button>
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
                                    <input type="number" name="updateStok" id="updateStok">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-rounded btn-icon">
                                        <i class="mdi mdi-trash-can text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-3">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-flex justify-content-end">
                    <form action="" class=" mt-3">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection