<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            $transaksi = Transaksi::all();
        }else{
            $transaksi = Transaksi::whereUserId(auth()->id())->get();
        }
        $user = User::whereRole('nasabah')->get();
        return view('admin.dashboard', compact('transaksi', 'user'));
    }
}
