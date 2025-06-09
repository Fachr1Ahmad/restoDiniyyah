<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        User::create([
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "email" => $request->email,
        ]);
        
        return redirect("login")->with('success', 'Registration Berhasil! Silahkan Login.');
    }

public function login(Request $request) {
    $input  = [
        "email" => $request->email,
        "password" => $request->password,
    ];

    if (Auth::attempt($input)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }
    return back()->withErrors([
        'email' => 'Email & password tidak terdaftar',
    ])->onlyInput('email');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
