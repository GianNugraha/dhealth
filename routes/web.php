<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Punya Akses Login  
Route::group(['middleware' => ['authWEB']], function () {
    Route::get('/home',[HomeController::class,'index'])->name('home');
    
    Route::get('tambah',[HomeController::class,'create'])->name('tambah');

    Route::get('daftar',[ObatController::class,'daftar'])->name('daftar');
    Route::get('obat/getObatById/{id_obat}',[ObatController::class,'getObatById'])->name('get obat by id');
    Route::get('obat/getObat',[ObatController::class,'getObat'])->name('get obat');
    Route::get('signa/getSigna',[ObatController::class,'getSigna'])->name('get signa');
    Route::get('obat/create',[ObatController::class,'create_obat'])->name('buat obat');
    Route::post('obat/store_obat',[ObatController::class,'store_obat'])->name('store obat');
    Route::post('resep/store_resep',[ObatController::class,'store_resep'])->name('store resep');
    Route::get('resep/create',[ObatController::class,'create_resep'])->name('buat obat');
    Route::get('pesanan/getPesananById/{id_pesanan}',[ObatController::class,'show'])->name('details');
    
    // Route::get('edit', function () {
    //     return view('edit');
    // });

});