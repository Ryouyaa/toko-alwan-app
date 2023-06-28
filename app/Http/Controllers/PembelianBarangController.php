<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PembelianBarangController extends Controller
{
    public function tambahView(Request $request)
    {
        // Ambil barang yang dipilih dari sesi
        $selectedItems = session('selectedItems', []);
        $search = $request->input('search');

        $barangs = Barang::query();

        if ($search) {
            $barangs->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('kode_barang', 'LIKE', "%{$search}%");
            });
        }

        $barangs = $barangs->paginate(5);

        $barangs->appends(['search' => $search]); // Menambahkan parameter pencarian ke URL pagination

        return view('barang.barang-masuk', compact('barangs', 'search', 'selectedItems'));
    }

    public function tambahBarang(Request $request)
    {
        $barangId = $request->input('barangId');

        // Dapatkan barang yang dipilih dari sesi
        $selectedItems = session('selectedItems', []);

        // Cek apakah barang sudah ada dalam array barang yang dipilih
        if (!in_array($barangId, $selectedItems)) {
            // Tambahkan barang baru ke dalam array barang yang dipilih
            $selectedItems[] = $barangId;

            // Simpan array barang yang dipilih yang telah diperbarui ke dalam sesi
            session(['selectedItems' => $selectedItems]);

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
        $selectedItems = session()->get('selectedItems', []);

        // Cari indeks barang yang akan dihapus
        $index = array_search($barangId, $selectedItems);

        if ($index !== false) {
            // Hapus barang dari daftar yang ditampilkan
            unset($selectedItems[$index]);

            // Simpan kembali daftar barang yang ditampilkan ke dalam session
            session()->put('selectedItems', $selectedItems);

            return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus dari tampilan.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus barang dari tampilan.']);
        }
    }

    public function updateBarang(Request $request)
    {
        $selectedItems = session()->get('selectedItems', []);

        // Menghapus semua elemen dari array $selectedItems
        $request->session()->forget('selectedItems');

        $updateStok = $request->input('updateStok');

        foreach ($updateStok as $barangId => $jumlahStok) {
            $barang = \App\Models\Barang::findOrFail($barangId);
            $barang->jumlah_stok += $jumlahStok;
            $barang->save();
        }

        return redirect('/barang-masuk')->with('success', 'Data pembelian berhasil disimpan');
    }
}
