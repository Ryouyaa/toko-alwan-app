<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;

class PenjualanBarangController extends Controller
{
    public function keluarView(Request $request)
    {
        // Ambil barang yang dipilih dari sesi
        $selectedItemsPenjualan = session('selectedItemsPenjualan', []);
        $search = $request->input('search');

        $barangs = Barang::query();

        if ($search) {
            $barangs->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        $barangs = $barangs->paginate(5);

        $barangs->appends(['search' => $search]); // Menambahkan parameter pencarian ke URL pagination

        return view('barang.barang-keluar', compact('barangs', 'search', 'selectedItemsPenjualan'));
    }

    public function tambahBarang(Request $request)
    {
        $barangId = $request->input('barangId');

        // Dapatkan barang yang dipilih dari sesi
        $selectedItemsPenjualan = session('selectedItemsPenjualan', []);

        // Cek apakah barang sudah ada dalam array barang yang dipilih
        if (!in_array($barangId, $selectedItemsPenjualan)) {
            // Tambahkan barang baru ke dalam array barang yang dipilih
            $selectedItemsPenjualan[] = $barangId;

            // Simpan array barang yang dipilih yang telah diperbarui ke dalam sesi
            session(['selectedItemsPenjualan' => $selectedItemsPenjualan]);

            // Kembalikan respons yang menandakan keberhasilan
            return response()->json(['success' => true]);
        } else {
            // Barang sudah ada dalam array barang yang dipilih, kembalikan respons dengan pesan error
            return response()->json(['success' => false, 'message' => 'Barang sudah ada dalam daftar']);
        }
    }


    public function deleteBarang(Request $request)
    {
        $barangId = $request->input('barangId');

        // Temukan dan hapus barang dari daftar yang ditampilkan
        $selectedItemsPenjualan = session()->get('selectedItemsPenjualan', []);

        // Cari indeks barang yang akan dihapus
        $index = array_search($barangId, $selectedItemsPenjualan);

        if ($index !== false) {
            // Hapus barang dari daftar yang ditampilkan
            unset($selectedItemsPenjualan[$index]);

            // Simpan kembali daftar barang yang ditampilkan ke dalam session
            session()->put('selectedItemsPenjualan', $selectedItemsPenjualan);

            return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus dari tampilan.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus barang dari tampilan.']);
        }
    }

    public function updateBarang(Request $request)
    {
        $updateStok = $request->input('updateStok');
        $diskon = $request->input('diskon');
        $selectedItemsPenjualan = session()->get('selectedItemsPenjualan', []);

        // Menghapus semua elemen dari array $selectedItemsPenjualan
        $request->session()->forget('selectedItemsPenjualan');

        $updateStok = $request->input('updateStok');

        // Membuat data penjualan
        $penjualan = new Penjualan();
        $penjualan->user_id = auth()->user()->id; // Menggunakan user yang sedang login
        $penjualan->tanggal_transaksi = now(); // Menggunakan tanggal dan waktu saat ini
        $penjualan->total_harga = 0; // Inisialisasi total harga dengan 0
        $penjualan->save();

        // Membuat data detail penjualan
        $totalHarga = 0; // Variabel untuk menghitung total harga penjualan
        foreach ($updateStok as $barangId => $jumlahStok) {
            $barang = \App\Models\Barang::findOrFail($barangId);
            $barang->jumlah_stok -= $jumlahStok;
            $barang->save();

            $detailPenjualan = new DetailPenjualan();
            $detailPenjualan->penjualan_id = $penjualan->id;
            $detailPenjualan->barang_id = $barangId;
            $detailPenjualan->jumlah = $jumlahStok;
            $detailPenjualan->jumlah_harga = $barang->harga_jual * $jumlahStok;
            $detailPenjualan->save();

            $totalHarga += $detailPenjualan->jumlah_harga;
        }

        // Mengupdate total harga pada data penjualan
        $penjualan->total_harga = $totalHarga - $diskon; // Mengurangi total dengan diskon
        $penjualan->save();

        return redirect('/barang-keluar')->with('success', 'Data berhasil disimpan');
    }
}
