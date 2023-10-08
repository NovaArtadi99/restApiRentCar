<?php

use App\Http\Controllers\API\AUTH\LoginController;
use App\Http\Controllers\API\AUTH\RegisterController;
use App\Http\Controllers\API\MobilController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\PenyewaController;
use App\Http\Controllers\API\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// login
Route::post('login', [LoginController::class, 'login']);
// register
Route::post('register', [RegisterController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // user
    // Route::get('/user', [UserController::class, 'index']);
    // Mobil
    Route::resource('mobil', MobilController::class);
    Route::post('/mobil/{plat_mobil}',[MobilController::class,'update']);

    // Pegawai
    Route::resource('pegawai', PegawaiController::class);
    Route::post('pegawai/{id_pegawai}',[PegawaiController::class,'update']);

    // Penyewa
    Route::resource('penyewa', PenyewaController::class);
    Route::post('penyewa/{id}',[PenyewaController::class,'update']);
    
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    Route::post('transaksi/{id}',[TransaksiController::class,'update']);
});