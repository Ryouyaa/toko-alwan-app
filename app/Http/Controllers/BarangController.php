<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang.daftar-barang', [
            "barangs" => DB::table('barangs')->paginate(15)
        ]);
    }

    public function tambahView()
    {
        return view('barang.barang-masuk');
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
    public function store(StoreBarangRequest $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'jumlah_stok' => 'required|integer',
            'stok_minimum' => 'required|integer',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'satuan_barang' => 'required',
        ]);

        // Simpan data ke database
        Barang::create($validatedData);

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
            'barangs' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        //
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
