<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Models\Reserva;

class ReservaController extends Controller
{
    public function index(){

        $funciones = Funcion::all();

        return view('reservas',["funciones" => $funciones]);

    }

    public function getFuncionReservas($idFuncion = ''){
        
        $reservas = Reserva::where('funcion_id','=', $idFuncion)
            ->get();

        if (count($reservas)<1){
            $reservas = false;
        }
        return response()->json(["reservas" => $reservas]);

    }

    public function setReservas(){
        
        request()->validate([
            'idreserva' => 'required',
            'idfuncion' => 'required',
        ]);

        $funciones = Funcion::all();
        
        $sillas = [];
        $requestSillas = request()->all();
        $socio = (int) request()->input('idreserva');
        $funcionS = (int) request()->input('idfuncion');

        
        foreach ($requestSillas as $key => $value){
            if (strncmp($key,"silla-",6) === 0){
                $sillas[] = $value;
                $reserva = new Reserva();
                $reserva->socio_id = $socio;
                $reserva->funcion_id = $funcionS;
                $reserva->silla = $value;
                $reserva->save();
            }
        }
        
        if (count($sillas)>0){
            $msg = "Reservación Generada";
        } else {
            $msg = "No Seleccionó Sillas";
        }
        

        return view('reservas',[
            "funciones" => $funciones, 
            "msg" => $msg, 
            "sillas" => $sillas,
        ]);

    }
}
