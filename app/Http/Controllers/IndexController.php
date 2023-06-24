<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Mengambil jumlah transaksi per bulan per tahun
        $monthlyTransactions = Penjualan::selectRaw('YEAR(tanggal_transaksi) as year, MONTH(tanggal_transaksi) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->get();

        // Mengambil data karyawan
        $karyawan = User::all();

        // Menyusun data tahun
        $years = $monthlyTransactions->pluck('year')->unique()->toArray();

        // Menyusun data bulan
        $months = [
            'JAN',
            'FEB',
            'MAR',
            'APR',
            'MEI',
            'JUN',
            'JUL',
            'AUG',
            'SEP',
            'OKT',
            'NOV',
            'DES'
        ];

        // Menyusun data jumlah transaksi per bulan per tahun
        $transactionsPerYearMonth = [];
        foreach ($monthlyTransactions as $transaction) {
            $year = $transaction->year;
            $month = $transaction->month;
            $count = $transaction->count;

            if (!isset($transactionsPerYearMonth[$year])) {
                $transactionsPerYearMonth[$year] = array_fill(1, 12, 0);
            }

            $transactionsPerYearMonth[$year][$month] = $count;
        }

        return view('index', compact('years', 'months', 'transactionsPerYearMonth', 'karyawan'));
    }
}
