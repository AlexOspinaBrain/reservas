<?php

namespace App\Http\Controllers;

use App\Models\Socio;

class SocioController extends Controller
{
    public function getSocio($idSocio = ''){

        $socio = Socio::where('identificacion','=', $idSocio)
        ->where('estado','=',true)
        ->first();

        return response()->json(["socio" => $socio]);

    }
}
