<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.profil', [
            'user' =>  User::findOrFail(auth()->user()->id)
        ]);
    }

    public function sandi()
    {
        return view('admin.ubah-sandi');
    }

}
