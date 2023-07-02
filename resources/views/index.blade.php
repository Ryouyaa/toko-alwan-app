@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
  <main class="flex-shrink-0">
    <div class="container">
      @auth
      <h2 class="welcome-text pb-2">Selamat Datang, <span class="text-black fw-bold">{{ auth()->user()->name }}</span>
      </h2>
      @endauth
      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <div class="row">
        <div class="col-lg-8 d-flex flex-column">
          <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Jumlah Transaksi per Bulan</h4>
                  <canvas id="transactions-per-year-month-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex flex-column">
          <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kirim Daftar Barang</h4>
                  <p class="card-description">Mengirim daftar barang yang sudah dibawah stok minimum ke Google Task.</p>
                  <form action="{{ route('send.task.list') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info btn-lg btn-block">Kirim Daftar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Shortcut Penjualan/Pembelian</h4>
                  <a href="/barang-keluar" type="button" class="btn btn-primary btn-lg btn-block">
                    Transaksi Penjualan
                  </a>
                  <a href="/barang-masuk" type="button" class="btn btn-dark btn-lg btn-block mt-2">
                    Transaksi Pembelian
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Tetapkan warna untuk tahun pertama dan tahun kedua
  var warnaTetap = '#00eddb';
  var warnaPertama = '#ed9e00';
  var warnaKedua = '#9eed00';
  var warnaKetiga = '#0071e3';

  // Jumlah transaksi per bulan per tahun
  var datasets = [];
  @foreach ($years as $index => $year)
      console.log("Index:", {{ $index }}); // Tampilkan nilai index di konsol browser

      var data{{ $year }} = {!! json_encode(array_values($transactionsPerYearMonth[$year] ?? [])) !!};
      var backgroundColor;

      if ({{ $index }} == 0) {
          backgroundColor = warnaPertama;
      } else if ({{ $index }} == 1) {
          backgroundColor = warnaKedua;
      } else if ({{ $index }} == 2) {
          backgroundColor = warnaKetiga;
      } else {
          backgroundColor = warnaTetap;
      }

      datasets.push({
          label: 'Tahun {{ $year }}',
          data: data{{ $year }},
          backgroundColor: backgroundColor,
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
      });
  @endforeach

  var transactionsPerYearMonthChart = new Chart(document.getElementById('transactions-per-year-month-chart'), {
      type: 'bar',
      data: {
          labels: {!! json_encode($months) !!},
          datasets: datasets
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true,
                  precision: 0
              }
          }
      }
  });
</script>


@endsection