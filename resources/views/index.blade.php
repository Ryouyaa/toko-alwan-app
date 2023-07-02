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
  // Jumlah transaksi per bulan per tahun
  var datasets = [];
  @foreach ($years as $year)
      var data{{ $year }} = {!! json_encode(array_values($transactionsPerYearMonth[$year] ?? [])) !!};
      datasets.push({
          label: 'Tahun {{ $year }}',
          data: data{{ $year }},
          backgroundColor: getRandomColor(),
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
  // Fungsi untuk mendapatkan warna acak
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }
</script>

@endsection