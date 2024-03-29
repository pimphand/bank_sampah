<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PencairanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SampahController;
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
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile', [AuthController::class, 'update']);


    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/nasabah-saldo/{id}', [NasabahController::class, 'saldo'])->name('nasabah.saldo');
    Route::resource('jenis-sampah', JenisSampahController::class);
    Route::resource('sampah', SampahController::class);
    Route::resource('nasabah', NasabahController::class);
    Route::resource('admin', NasabahController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pencarian', PencairanController::class);
    Route::resource('report', ReportController::class);
});
