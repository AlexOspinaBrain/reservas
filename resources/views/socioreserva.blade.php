<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservas por Socio') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                <div class="mt-8 text-2xl">
                    Administrar Reservas.
                </div>
                <br>
              <div style="width: 300px;">
                <form action="{{ route('reserva-socio') }}" method="get">
                    @csrf
                <div class="input-group input-group-sm mb-3" >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Buscar</span>
                    <input name="id-socio" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Identificación">
                    
                </div>
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
                <br>
                <div class="alert alert-success" role="alert">
                    <div id="nombre">{{ $nombre ?? ''}}</div>
                    
                </div>
              </div>
              <div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID reserva</th>
                        <th scope="col">Función</th>
                        <th scope="col">Silla</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($reservas))
                            @foreach($reservas as $reserva)
                                <tr>
                                    <td>{{$reserva->id}}</td>
                                    <td>{{$reserva->funcion->titulo }} - {{$reserva->funcion->inicio}}</td>
                                    <td>{{$reserva->silla}}</td>
                                    <td>
                                        <form action="{{ route('reserva-socio-delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="idReserva" value="{{$reserva->id}}">
                                            <button type="submit" class="btn btn-outline-danger float-center">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                
              </div>
            </div>
        </div>
    </div>
</x-app-layout>
