<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Lost;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLostRequest $request)
    {
        //
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
    public function destroy(Lost $lost)
    {
        //
    }
}
