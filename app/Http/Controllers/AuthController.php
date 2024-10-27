<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Coba autentikasi dengan data yang diberikan
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Autentikasi berhasil
            return redirect()->intended('/rumah-sakit');
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
