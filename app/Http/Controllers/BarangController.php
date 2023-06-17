<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Http\Requests\BarangRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $barangs = Barang::query();

        if ($search) {
            $barangs->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('id', $search);
            });
        }

        $barangs = $barangs->paginate(15);

        $barangs->appends(['search' => $search]); // Menambahkan parameter pencarian ke URL pagination

        return view('barang.daftar-barang', compact('barangs'));
    }


    public function tambahView(Request $request)
    {
        // Ambil barang yang dipilih dari sesi
        $selectedItems = session('selectedItems', []);
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

        return view('barang.barang-masuk', compact('barangs', 'search', 'selectedItems'));
    }

    public function tambahBarang(Request $request)
    {
        $barangId = $request->input('barangId');

        // Dapatkan barang yang dipilih dari sesi
        $selectedItems = session('selectedItems', []);

        // Tambahkan barang baru ke dalam array barang yang dipilih
        $selectedItems[] = $barangId;

        // Simpan array barang yang dipilih yang telah diperbarui ke dalam sesi
        session(['selectedItems' => $selectedItems]);

        // Kembalikan respons yang menandakan keberhasilan
        return response()->json(['success' => true]);
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


    public function keluarView()
    {
        return view('barang.barang-keluar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.tambah-barang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        // Simpan data ke database
        Barang::create($request->validated());

        // Redirect atau kembalikan response yang sesuai
        return redirect('/daftar-barang')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.form-ubah', [
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        // Simpan data ke database
        $barang->update($request->validated());

        // Redirect atau kembalikan response yang sesuai
        return redirect('/daftar-barang')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the data based on the ID
        $data = Barang::findOrFail($id);

        // Delete the data from the database
        $data->delete();

        // Redirect or return an appropriate response
        return redirect('/daftar-barang')->with('success', 'Data berhasil dihapus');
    }
}
