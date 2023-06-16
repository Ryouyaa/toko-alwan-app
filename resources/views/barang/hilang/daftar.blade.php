@extends('layout.mainlayout')

@section('content-wrapper')

<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Daftar Barang Hilang</h2>
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
                                <td>
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