<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcion extends Model
{
    use HasFactory;
    
    protected $table = "funciones";

    public function reservas(){
        return $this->belongsTo(Reserva::class, 'funcion_id');
    }
}
