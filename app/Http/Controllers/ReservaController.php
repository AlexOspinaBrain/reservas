<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Models\Reserva;
use App\Models\Socio;

class ReservaController extends Controller
{

    /**
     * Renderiza la vista de las reservas con las funciones disponibles
     * 
     * 
     *
     * @return object view
     */
    public function index(){

        $funciones = Funcion::all();

        return view('reservas',["funciones" => $funciones]);

    }

    /**
     * Recupera las reservas de una funcion especifica
     *
     * @param string $idFuncion
     * @return object json
     */
    public function getFuncionReservas($idFuncion = ''){
        
        $reservas = Reserva::where('funcion_id','=', $idFuncion)
            ->get();

        if (count($reservas)<1){
            $reservas = false;
        }
        return response()->json(["reservas" => $reservas]);

    }

    /**
     * Realiza la reserva de sillas
     * 
     * Recupera en un arreglo las sillas y crea las reservas según su socio y función
     *
     * @param mixed request
     * @return object view
     */
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

    /**
     * Recupera las reservas de un socio
     *
     * @param string id-socio
     * @return object view
     */
    public function getReservasSocio(){

        request()->validate([
            'id-socio'=>'required',
        ]);
        
        $reservas=[];
        
        $idSocio = request()->input('id-socio');
        $socio = Socio::where('identificacion','=', $idSocio)
            ->first();

        if ($socio) {
            $reservas = Reserva::where('socio_id','=', $socio->id)
                ->with('funcion') 
                ->get();

            $nombre = $socio->nombre . ' ' . $socio->apellido;
        } else {
            $nombre = "No existe el socio";
        }
        return response()->view('socioreserva', ["reservas" => $reservas, "nombre" => $nombre]);

    }

    /**
     * Elimina una reserva
     *
     * @param string idReserva
     * @return object view
     */
    public function delReservasSocio(){
        $idReserva = request()->input('idReserva');
        
        $reserva = Reserva::find($idReserva);

        $reserva->delete();

        return view('socioreserva',["nombre"=>"Reserva Eliminada"]);
    }
}
