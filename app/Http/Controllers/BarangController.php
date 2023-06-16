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
