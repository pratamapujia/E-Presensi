<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PresensiController;
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


// Route Admin
Route::middleware(['guest:user'])->group(function () {
    Route::get('/admin-panel', function () {
        return view('auth.loginAdmin');
    })->name('loginAdmin');
});

Route::get('/admin-dashboard', [AdminController::class, 'index']);

// Route User
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/prosesLogin', [AuthController::class, 'prosesLogin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index']);
    Route::get('/prosesLogout', [AuthController::class, 'prosesLogout']);

    // Presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    // Edit Profile
    Route::get('/edit', [PresensiController::class, 'editProfile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateProfile']);

    // Hostori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    // Izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatIzin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeIzin']);
});
