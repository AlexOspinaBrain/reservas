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
    Route::get('/socios',
        [SocioController::class, 'index']
        )->name('socios');

    /**Consultar Socio */
    Route::get('/socios/socio/{idSocio}',
        [SocioController::class, 'getSocio']
        )->name('getSocio');

    /**Delete Socio */
    Route::post('/socios/delete',
        [SocioController::class, 'delSocio']
        )->name('socios-delete');

    /**Crea o actualiza Socio */
    Route::post('/socios/store',
        [SocioController::class, 'storeSocio']
        )->name('socios-store');

    /**Vista Reservas */
    Route::get('/reservar',
        [ReservaController::class, 'index']
        )->name('reservar');

    /** Reservas de una funcion */
    Route::get('/funcion-reservas/{idFuncion}',
        [ReservaController::class, 'getFuncionReservas']
        )->name('funcion-reservas');

    /**Reservar Sillas */
    Route::post('/reservar',
        [ReservaController::class, 'setReservas']
        )->name('reservar');


    /*Vista Manage Reservas por socio */
    Route::get('/reservas/socio', function () {
        return view('socioreserva');
        })->name('reservas-socio');

    /**Reservas de socio */
    Route::get('/reserva/socio',
        [ReservaController::class, 'getReservasSocio']
        )->name('reserva-socio');
    
    /**Elimina Reservas de socio */
    Route::post('/reserva/socio/delete',
        [ReservaController::class, 'delReservasSocio']
        )->name('reserva-socio-delete');
});

/**
 * Manage inexistent routes
 */
Route::fallback(function () {
    return redirect('dashboard');
});