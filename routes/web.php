<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'login');
Route::view('/login', 'login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/nasabah-saldo/{id}', [NasabahController::class, 'saldo'])->name('nasabah.saldo');
    Route::resource('jenis-sampah', JenisSampahController::class);
    Route::resource('nasabah', NasabahController::class);
    Route::resource('admin', NasabahController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pencarian', PencairanController::class);
});
