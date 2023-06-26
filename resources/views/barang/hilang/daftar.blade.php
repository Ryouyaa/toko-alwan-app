@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Barang Hilang / Rusak</h2>
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <form class="search-form input-group rounded" action="/daftar-hilang">
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
                                    Jumlah
                                </th>
                                <th>
                                    Kategori
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
                                <td>
                                    {{ $lost->kategori }}
                                </td>
                                <td style="white-space: normal;">
                                    {{ $lost->detail }}
                                </td>
                                <td>
                                    <a href="/losts/{{ $lost->id }}/edit" class="btn btn-warning btn-sm">Ubah</a>
                                    <form action="/losts/{{ $lost->id }}" method="post" class="d-inline">
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
                    {{ $losts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection