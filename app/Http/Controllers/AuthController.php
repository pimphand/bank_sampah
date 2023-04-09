<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => "required|exists:users,username",
            'password' => "required",
        ], [
            'password.required' => "password harus di isi.",
            'username.required' => "username harus di isi.",
            'username.exists' => "username tidak ditemukan.",
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'gagal' => 'password atau username salah.',
        ]);
    }
}
