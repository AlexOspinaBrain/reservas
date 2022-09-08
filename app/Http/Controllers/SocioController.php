<?php

namespace App\Http\Controllers;

use App\Models\Socio;

class SocioController extends Controller
{
    public function getSocio(){

        $idSocio = request()->input('identificacion') ?? '';

        $socio = Socio::where('identificacion','=',$idSocio)
        ->where('estado','=',true)
        ->get();

        return response()->json(["socio" => $socio]);

    }
}
