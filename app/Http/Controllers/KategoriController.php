<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();

        return view('kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        // Simpan data kategori ke database
        Kategori::create($request->validated());

        // Redirect ke halaman index kategori dengan pesan sukses
        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.ubah', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->name = $request->name;
        $kategori->kode_kategori = strtoupper($request->kode_kategori);
        $kategori->save();

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        // Redirect atau mengembalikan response yang sesuai
        return redirect('/kategori')->with('success', 'Data berhasil dihapus');
    }
}
