<?php

namespace App\Http\Controllers;

use App\Models\Funcion;

class ReservaController extends Controller
{
    public function index(){

        $funciones = Funcion::all();

        return view('reservas',["funciones" => $funciones]);

    }
}
