<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Tasks;
use Google\Service\Tasks\Task;
use Google\Service\Tasks\TaskList;
use Illuminate\Support\Facades\Storage;

use Illuminate\Contracts\Exceptions\Exception;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Mengambil 3 tahun terakhir
        $years = array_slice($years, -3);

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

            // Hanya memproses data untuk 3 tahun terakhir
            if (!in_array($year, $years)) {
                continue;
            }

            $transactionsPerYearMonth[$year][$month] = $count;
        }

        return view('index', compact('years', 'months', 'transactionsPerYearMonth', 'karyawan'));
    }

    public function sendTaskList(Request $request)
    {
        // Membaca file kunci service account
        $keyFile = Storage::path('google-task/toko-alwan-9aec17f34176.json');

        // Membuat instance Google_Client dan mengatur autentikasi menggunakan kredensial akun layanan
        $client = new Client();
        $client->setApplicationName("Toko_Alwan");
        $client->setDeveloperKey("base64:jnl5gZHCBS6yK6w2tJIAzKr8h00epOXfYr5q3rqM99g=");
        $client->setAuthConfig($keyFile);
        $client->addScope(Tasks::TASKS);

        $redirect_uri = 'http://localhost:8000/callback';
        $client->setRedirectUri($redirect_uri);

        // Jika terjadi kesalahan dalam mendapatkan token akses, lempar pengecualian
        if ($request->has('code')) {
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->input('code'));
            if (isset($accessToken['access_token'])) {
                $client->setAccessToken($accessToken['access_token']);
            } else {
                throw new \Exception('Gagal mendapatkan token akses Google Task.');
            }
        } else {
            // Redirect untuk mendapatkan token akses
            $authUrl = $client->createAuthUrl();
            return redirect()->away($authUrl);
        }

        // Membuat instance Google_Service_Tasks
        $service = new Tasks($client);

        // Membaca daftar barang dengan jumlah_stok di bawah stok_minimum
        $barangs = Barang::whereColumn('jumlah_stok', '<', 'stok_minimum')->get();

        // Membuat task list baru
        $taskList = new TaskList();

        // Membuat nama title
        $title = Carbon::now()->isoFormat('dddd, D MMM Y');
        $taskList->setTitle($title);
        $newTaskList = $service->tasklists->insert($taskList);

        // Mendapatkan ID dari daftar tugas baru
        $newTaskListId = $newTaskList->getId();

        // Membuat task baru untuk setiap barang
        foreach ($barangs as $barang) {
            $task = new Task();
            $task->setTitle($barang->name);

            // Menambahkan detail stok jumlah dan stok minimum ke deskripsi task
            $task->setNotes('Stok Jumlah: ' . $barang->jumlah_stok . ', Stok Minimum: ' . $barang->stok_minimum);

            // Menambahkan task ke daftar tugas
            $service->tasks->insert($newTaskListId, $task);
        }

        return redirect()->back()->with('success', 'Daftar barang telah berhasil dikirim ke Google Task.');
    }
}
