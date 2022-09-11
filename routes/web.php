<?php

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
    /**Vista Home */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    /*Vista Manage Socios */
    Route::get('/socios', function () {
        return view('socios');
    })->name('socios');
    /**Consultar Socio */
    Route::get('/socios/socio/{idSocio}',
        [SocioController::class, 'getSocio']
        )->name('getSocio');
    /**Vista Reservas */
    Route::get('/reservas',
        [ReservaController::class, 'index']
        )->name('reservas');
    /**Endpoint Reservas de una funcion */
    Route::get('/funcion-reservas/{idFuncion}',
        [ReservaController::class, 'getFuncionReservas']
        )->name('funcion-reservas');
    /**Reservar Sillas */
    Route::post('/reservar',
        [ReservaController::class, 'setReservas']
        )->name('reservar');
    
});

/**
 * Manage inexistent routes
 */
Route::fallback(function () {
    return redirect('dashboard');
});