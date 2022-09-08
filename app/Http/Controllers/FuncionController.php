<?php

namespace App\Http\Controllers;

use App\Models\Funcion;

class FuncionController extends Controller
{
    public function getFuncionReservas(){

        $idFuncion = request()->input('idFuncion') ?? 0;

        $funcion = Funcion::where('id','=',$idFuncion)
        ->with('reservas')
        ->get();

        return response()->json(["funcion" => $funcion]);

    }
}
