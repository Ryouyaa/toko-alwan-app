@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Barang Hilang</h2>
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
                                    Jumlah Hilang
                                </th>
                                <th>
                                    Detail
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($losts as $lost)    
                            <tr>
                                <td>
                                    {{ $losts->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    {{ $lost->barang?->name }}
                                </td>
                                <td>
                                    {{ $lost->jumlah_stok }}
                                </td>
                                <td style="width: 110px; word-wrap: break-word;">
                                    {{ $lost->detail }}
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
                    {{ $losts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection