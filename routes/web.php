<?php

use App\Http\Controllers\FuncionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SocioController;
use Illuminate\Support\Facades\Route;

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
    return redirect('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/socios', function () {
        return view('socios');
    })->name('socios');

    Route::get('reservas',
        [ReservaController::class, 'index']
        )->name('reservas');

    Route::get('funcion-reservas',
        [FuncionController::class, 'getFuncionReservas']
        )->name('funcion-reservas');

    Route::get('socios/socio',
        [SocioController::class, 'getSocio']
        )->name('getSocio');
});

/**
 * Manage inexistent routes
 */
Route::fallback(function () {
    return redirect('dashboard');
});