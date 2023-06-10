<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.profil');
    }

    public function sandi()
    {
        return view('admin.ubah-sandi');
    }

}
