<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Kategori;
use App\Http\Requests\BarangRequest;
use App\Http\Requests\BarangUpdateRequest;

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
                    ->orWhere('kode_barang', 'LIKE', "%{$search}%");
            });
        }

        $barangs = $barangs->paginate(15);

        $barangs->appends(['search' => $search]); // Menambahkan parameter pencarian ke URL pagination

        return view('barang.daftar-barang', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return view('barang.tambah-barang', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
        // Dapatkan kategori berdasarkan id yang dipilih
        $kategori = Kategori::findOrFail($request->kategori_id);

        // Dapatkan jumlah barang dengan kode kategori yang sama
        $jumlahBarang = Barang::where('kategori_id', $kategori->id)->count();

        // Generate kode barang dengan format KODEKATEGORI-INCREMENTAL (001, 002, dst.)
        $kodeBarang = $kategori->kode_kategori . str_pad($jumlahBarang + 1, 3, '0', STR_PAD_LEFT);

        // Buat data barang baru dengan atribut yang valid
        $barang = new Barang($request->validated());

        // Tambahkan kode barang yang dihasilkan ke dalam atribut 'kode'
        $barang->kode_barang = $kodeBarang;

        // Simpan data barang ke database
        $barang->save();

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
    public function update(BarangUpdateRequest $request, Barang $barang)
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
    public function destroy(Barang $barang)
    {
        $barang->delete();

        // Redirect atau mengembalikan response yang sesuai
        return redirect('/daftar-barang')->with('success', 'Data berhasil dihapus');
    }
}
