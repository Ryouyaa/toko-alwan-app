@extends('layout.mainlayout')

@section('content-wrapper')
<div class="content-wrapper">
    <h2 class="welcome-text mb-3">Laporan Karyawan</h2>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title my-3">Jumlah Transaksi per Karyawan</h4>
                <canvas id="karyawanTransactionsChart"></canvas>

                <h4 class="card-title my-3">Jumlah Barang yang Dijual per Karyawan</h4>
                <canvas id="karyawanSoldItemsChart"></canvas>

                <h4 class="card-title my-3">Kinerja Karyawan</h4>
                <canvas id="karyawanPerformanceChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mengambil data dari controller
    var karyawanTransactions = {!! $karyawanTransactions !!};
    var karyawanSoldItems = {!! $karyawanSoldItems !!};
    var karyawanPerformance = {!! $karyawanPerformance !!};

    // Membuat chart jumlah transaksi per karyawan
    var karyawanTransactionsChart = new Chart(document.getElementById('karyawanTransactionsChart'), {
        type: 'bar',
        data: {
            labels: karyawanTransactions.map(data => data.name),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: karyawanTransactions.map(data => data.count),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });

    // Membuat chart jumlah barang yang terjual per karyawan
    var karyawanSoldItemsChart = new Chart(document.getElementById('karyawanSoldItemsChart'), {
        type: 'bar',
        data: {
            labels: karyawanSoldItems.map(data => data.name),
            datasets: [{
                label: 'Jumlah Barang Terjual',
                data: karyawanSoldItems.map(data => data.total),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });

    // Membuat chart kinerja karyawan
    var karyawanPerformanceChart = new Chart(document.getElementById('karyawanPerformanceChart'), {
        type: 'horizontalBar',
        data: {
            labels: karyawanPerformance.map(data => data.name),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: karyawanPerformance.map(data => data.count),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endsection
