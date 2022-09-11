<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                <div class="mt-8 text-2xl">
                    Vamos a Reservar!
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div style="width: 300px;">
                        <div class="input-group input-group-sm mb-3" >
                            <span class="input-group-text" id="inputGroup-sizing-sm">Buscar</span>
                            <input id="id-socio" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Identificación">
                            
                        </div>
                        <div class="alert alert-secondary" role="alert">
                            <div id="nombre"></div>
                            <div id="apellido"></div>
                        </div>
                        <div>
                        <select id="funciones" name="funciones" class="form-select" >
                            <option value="seleccionar">Seleccionar Función</option>
                            @foreach ($funciones as $funcion)
                                <option value="{{$funcion->id}}"> {{ $funcion->titulo }} - {{ $funcion->inicio }}</option> 
                            @endforeach
                        </select>
                        </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="alert alert-primary" role="alert">
                        {{ $msg ?? '' }}
                        @if(isset($sillas))
                            @foreach ($sillas as $silla)
                                <p>{{ $silla }}</p>
                            @endforeach
                        @endif
                    </div>
                  </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <x-teatro  />
                    
                    <div class="col-2">
                        <p><b>Reserva actual:</b></p>
                        <form id="reserva" method="POST" action="{{ route('reservar') }}">
                        
                            @csrf   
                            
                            <button id="sendForm" type="button" class="btn btn-outline-primary">Reservar</button>
                            <input type="hidden" name="idreserva" id="idreserva">
                            <input type="hidden" name="idfuncion" id="idfuncion">
                            <br>
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Silla</th>
                                    
                                  </tr>
                                </thead>
                                <tbody id="bodyform"></tbody>
                            </table>
                            
                        </form>
                    </div>
                </div>
              </div>                
            </div>
        </div>
    </div>
</x-app-layout>


<script type="text/javascript" src="{{url('/js/reservas.js')}}"></script>