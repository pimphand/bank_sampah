<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    function logout()
    {
        Auth::logout();
        return true;
    }

    function profile()
    {
        return view('profile');
    }

    function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'nama' => ['required'],
            'email' => ['required', Rule::unique(User::class)->ignore($user->id)],
            'username' => ['required'],
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password != null ? Hash::make($request->password) : $user->password,
        ]);

        return back()->with('success', 'Profil telah di perbarui.');
    }
}
