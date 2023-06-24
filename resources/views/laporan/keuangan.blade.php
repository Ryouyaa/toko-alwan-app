@extends('layout.mainlayout')

@section('css')
<style>
    @media print {
        /* Sembunyikan tombol Print dan Export saat mencetak */
        .btn-hide {
            display: none !important;
        }

        .sidebar {
            display: none !important;
        }

        #profile {
            display: none !important;
        }
    }
</style>

@endsection

@section('content-wrapper')
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <a href="#" class="btn btn-outline-dark d-inline py-2 px-3 btn-hide" onclick="printLaporan()"><i
                            class="icon-printer"></i> Print</a>
                    <a href="{{ route('laporan.export', ['bulan' => $filterBulan, 'tahun' => $filterTahun]) }}"
                        class="btn btn-primary text-white me-0 d-inline py-2 px-3 btn-hide"><i
                            class="icon-download"></i> Export</a>
                </div>
                <h4 class="card-title">Laporan Keuangan</h4>
                <form action="/laporan-keuangan" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-2 py-2">
                            <select name="bulan" class="form-select">
                                <option value="">Pilih Bulan</option>
                                @foreach (range(1, 12) as $bulanItem)
                                <option value="{{ $bulanItem }}" @if ($bulanItem==$filterBulan) selected @endif>{{
                                    date('F', mktime(0, 0, 0, $bulanItem, 1)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 py-2">
                            <select name="tahun" class="form-select">
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahunList as $tahunItem)
                                <option value="{{ $tahunItem }}" @if ($tahunItem==$filterTahun) selected @endif>{{
                                    $tahunItem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 py-2 my-auto">
                            <button class="btn btn-primary btn-sm btn-hide">Tampil</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Transaksi</th>
                                <th>User</th>
                                <th>Jumlah Barang</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualans as $penjualan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penjualan->tanggal_transaksi }}</td>
                                <td>{{ $penjualan->user->name }}</td>
                                <td>{{ $penjualan->detailPenjualan->sum('jumlah') }}</td>
                                <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    // Print laporan
  function printLaporan() {
    window.print();
  }
</script>
@endsection