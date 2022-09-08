<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                <div class="mt-8 text-2xl">
                    Vamos a Reservar!
                </div>
                <br>
                <div style="width: 300px;">
                <div class="input-group input-group-sm mb-3" >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Buscar</span>
                    <input name="id-socio" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Identificación">
                </div>
                <select name="funciones" class="form-select" >
                    <option>Seleccionar Función</option>
                    @foreach ($funciones as $funcion)
                        <option value="{{$funcion->id}}"> {{ $funcion->titulo }} - {{ $funcion->inicio }}</option> 
                    @endforeach
                </select>
                </div>
                <br>
                <br>
                <div class="row">
                    <x-teatro  />
                    
                    <div class="col-2">
                        <p><b>Reserva actual:</b></p>
                        <form id="reserva" method="POST">
                        
                            @csrf   
                            <div id = "form-errors">
                                {!! $errors->first('cuentapropias_sale_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                                {!! $errors->first('cuentapropias_entra_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                                {!! $errors->first('cuentaterceros_entra_id','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                                {!! $errors->first('monto','<small><div class="alert alert-danger" role="alert">:message</div></small>') !!}
                            </div>
                            {{--@if ($message)
                                <div class="alert alert-primary" role="alert">
                                    {{ $message }}
                                </div>
                            @endif--}}
                            <br>
                            <button type="button" class="btn btn-outline-primary">Reservar</button>
                        </form>
                    </div>
                </div>
              </div>                
            </div>
        </div>
    </div>
</x-app-layout>