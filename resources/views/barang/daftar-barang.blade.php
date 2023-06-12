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
                                    No
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
                            @foreach ($barangs as $barang)    
                            <tr>
                                <td>
                                    {{ $barangs->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    {{ $barang->name }}
                                </td>
                                <td>
                                    {{ $barang->jumlah_stok }}
                                </td>
                                <td>
                                    {{ $barang->stok_minimum }}
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $barangs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection