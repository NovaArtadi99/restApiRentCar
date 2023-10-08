<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenyewaController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('mobils', [MobilController::class, 'index'])->name('mobils.index');
// Route::get('mobils/create', [MobilController::class, 'create'])->name('mobils.create');
// Route::post('mobils', [MobilController::class, 'store'])->name('mobils.store');
// Route::get('mobils/{id}/edit', [MobilController::class, 'edit'])->name('mobils.edit');
// Route::put('mobils/{id}', [MobilController::class, 'update'])->name('mobils.update');
// Route::delete('mobils/{id}', [MobilController::class, 'destroy'])->name('mobils.destroy');