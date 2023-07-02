@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Barang Hilang</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <form class="search-form input-group rounded" action="/barang-hilang">
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
                                <th class="d-none d-sm-table-cell">
                                    No
                                </th>
                                <th>
                                    Kode Barang
                                </th>
                                <th>
                                    Nama Barang
                                </th>
                                <th class="d-none d-sm-table-cell">
                                    Stok Barang
                                </th>
                                <th class="d-none d-sm-table-cell">
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
                                <td class="d-none d-sm-table-cell">
                                    {{ $barangs->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    {{ $barang->kode_barang }}
                                </td>
                                <td>
                                    {{ $barang->name }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $barang->jumlah_stok }}
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    {{ $barang->stok_minimum }}
                                </td>
                                <td>
                                    <a href="/barang-hilang/form/{{ $barang->id }}" class="btn btn-primary btn-sm">Pilih</a>
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