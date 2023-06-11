<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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

    public function ubahSandi(Request $request)
    {
        # Validation
        $request->validate([
            'passwordLama' => ['required'],
            'passwordBaru' => ['required', Password::min(8), 'confirmed']
        ]);


        #Match The Old Password
        if(!Hash::check($request->passwordLama, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->passwordBaru)
        ]);

        return back()->with("success", "Password changed successfully!");
    }
}
