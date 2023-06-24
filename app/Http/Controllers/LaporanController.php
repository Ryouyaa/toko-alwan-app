<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

use App\Models\User;
use App\Models\Penjualan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil tahun dan bulan yang dipilih dari input request
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');

        // Menyimpan tahun dan bulan yang dipilih ke dalam session
        if ($tahun && $bulan) {
            Session::put('laporan_tahun', $tahun);
            Session::put('laporan_bulan', $bulan);
        }

        // Mengecek apakah ada filter tahun dan bulan yang disimpan di session
        $filterTahun = Session::get('laporan_tahun');
        $filterBulan = Session::get('laporan_bulan');

        $query = Penjualan::with('user');

        if ($filterTahun) {
            $query->whereYear('tanggal_transaksi', $filterTahun);
        }

        if ($filterBulan) {
            $query->whereMonth('tanggal_transaksi', $filterBulan);
        }

        $penjualans = $query->get();

        // Mendapatkan daftar tahun unik dari tabel penjualan
        $tahunList = DB::table('penjualans')
            ->select(DB::raw('YEAR(tanggal_transaksi) AS tahun'))
            ->distinct()
            ->pluck('tahun');

        return view('laporan.keuangan', compact('penjualans', 'tahunList', 'filterTahun', 'filterBulan'));
    }

    public function export(Request $request)
    {
        $filterTahun = $request->input('tahun');
        $filterBulan = $request->input('bulan');

        $query = Penjualan::with('user');

        if ($filterTahun) {
            $query->whereYear('tanggal_transaksi', $filterTahun);
        }

        if ($filterBulan) {
            $query->whereMonth('tanggal_transaksi', $filterBulan);
        }

        $penjualans = $query->get();

        $filename = 'laporan_keuangan_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($penjualans) {
            $file = fopen('php://output', 'w');

            // Header kolom
            fputcsv($file, ['No', 'Tanggal Transaksi', 'User', 'Jumlah Barang', 'Total Harga']);

            // Data penjualan
            foreach ($penjualans as $index => $penjualan) {
                fputcsv($file, [
                    $index + 1,
                    $penjualan->tanggal_transaksi,
                    $penjualan->user->name,
                    $penjualan->detailPenjualan->sum('jumlah'),
                    $penjualan->total_harga,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function karyawan()
    {
        // Mengambil jumlah transaksi yang dilakukan oleh setiap karyawan
        $karyawanTransactions = User::select('name', DB::raw('COUNT(*) as count'))
            ->join('penjualans', 'users.id', '=', 'penjualans.user_id')
            ->groupBy('name')
            ->get();

        // Mengambil jumlah barang yang terjual oleh masing-masing karyawan
        $karyawanSoldItems = User::select('name', DB::raw('SUM(detail_penjualans.jumlah) as total'))
            ->join('penjualans', 'users.id', '=', 'penjualans.user_id')
            ->join('detail_penjualans', 'penjualans.id', '=', 'detail_penjualans.penjualan_id')
            ->groupBy('name')
            ->get();

        // Mengambil kinerja karyawan berdasarkan jumlah transaksi yang dilakukan
        $karyawanPerformance = User::select('name', DB::raw('COUNT(*) as count'))
            ->join('penjualans', 'users.id', '=', 'penjualans.user_id')
            ->groupBy('name')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return view('laporan.karyawan', compact('karyawanTransactions', 'karyawanSoldItems', 'karyawanPerformance'));
    }
}
