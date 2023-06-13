@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Barang</h2>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Barang</h4>
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
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
                                    Harga Barang
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
                                    Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}
                                </td>
                                <td>
                                    <a href="/daftar-barang/{{ $barang->id }}/edit"
                                        class="btn btn-warning btn-sm">Ubah</a>
                                    <form action="/daftar-barang/{{ $barang->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Anda Yakin?')">Hapus</button>
                                    </form>
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