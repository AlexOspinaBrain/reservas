<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Socio;

class SocioController extends Controller
{
    public function index(){

        $socios = Socio::all();
        
        return view('socios',["socios" => $socios]);

    }

    public function getSocio($idSocio = ''){

        $socio = Socio::where('identificacion','=', $idSocio)
            ->first();

        return response()->json(["socio" => $socio]);

    }

    public function storeSocio(){

        request()->validate([
            'identificacion' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
        ]);

        $socio = Socio::find(request()->input('id') ?? 0);
        if ($socio){
            $socio->identificacion = request()->input('identificacion');
            $socio->nombre = request()->input('nombre');
            $socio->apellido = request()->input('apellido');
            $socio->save();
        } else {
            $socio = Socio::create(request()->only('identificacion','apellido','nombre'));
        }
        return redirect()->route('socios');

    }

    public function delSocio(){
        
        $id = request()->input('id');

        $reservas = Reserva::where('socio_id',$id)->get();
        foreach($reservas as $reserva){
            $reserva->delete();
        }

        $socio = Socio::find($id);
        $socio->delete();

        $socios = Socio::all();

        return view('socios',["socios" => $socios, "msg"=>"Socio Eliminado"]);
    }
}
