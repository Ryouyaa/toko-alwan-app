<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Lost;
use App\Models\Barang;
use App\Http\Requests\LostRequest;

class LostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $losts = Lost::with('barang')->latest('created_at')->paginate(15);
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
        return view('barang.hilang.form-tambah', [
            "barang" => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LostRequest $request)
    {
        // Simpan data ke database
        Lost::create($request->validated());

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
        return view('barang.hilang.form-ubah', [
            'lost' => $lost
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LostRequest $request, Lost $lost)
    {
        $this->authorize('update', $lost);

        // Simpan data ke database
        $lost->update($request->validated());

        // Redirect atau kembalikan response yang sesuai
        return redirect('/daftar-hilang')->with('success', 'Data berhasil disimpan');
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
