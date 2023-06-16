<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Lost;
use App\Models\Barang;
use App\Http\Requests\LostRequest;

class LostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $losts = Lost::with('barang')
        ->when($search, function ($query) use ($search) {
            return $query->whereHas('barang', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            });
        })
        ->latest('created_at')
        ->paginate(15);

    $losts->appends(['search' => $search]); // Menambahkan parameter pencarian ke URL pagination

    return view('barang.hilang.daftar', compact('losts'));
}


    public function cari(Request $request)
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

        return view('barang.hilang.cari', compact('barangs'));
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

        // Validasi input dan dapatkan data yang telah lolos validasi
        $validatedData = $request->validated();

        // Simpan data ke database
        $lost->update($validatedData);

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
