<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lost;
use App\Models\Barang;
use App\Http\Requests;
use App\Http\Requests\StoreLostRequest;
use App\Http\Requests\UpdateLostRequest;

class LostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $losts = Lost::with('barang')->paginate(15);
        return view('barang.hilang.daftar', compact('losts'));
    }

    public function cari()
    {
        return view('barang.hilang.cari', [
            "barangs" => DB::table('barangs')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Barang $barang)
    {
        return view('barang.hilang.form', [
            "barang" => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_stok' => 'required|integer',
            'detail' => 'required|string|max:80',
        ]);

        // Simpan data ke database
        Lost::create($validatedData);

        // Redirect atau kembalikan response yang sesuai
        return redirect('/daftar-hilang')->with('success', 'Data berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(Lost $lost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lost $lost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLostRequest $request, Lost $lost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Lost::findOrFail($id);

        // Delete the data from the database
        $data->delete();

        // Redirect or return an appropriate response
        return redirect('/daftar-hilang')->with('success', 'Data berhasil dihapus');
    }
}
