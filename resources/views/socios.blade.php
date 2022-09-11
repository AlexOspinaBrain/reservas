<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrar Socios') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                
                <div class="mt-8 text-2xl">
                    Crear Nuevo.
                </div>
                <br>
              <div style="width: 300px;">
                <form action="{{ route('reserva-socio') }}" method="get">
                    @csrf
                <div class="input-group input-group-sm mb-3" >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Identificación</span>
                    <input name="identificacion" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    
                </div>
                <div class="input-group input-group-sm mb-3" >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombre</span>
                    <input name="nombre" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    
                </div>
                <div class="input-group input-group-sm mb-3" >
                    <span class="input-group-text" id="inputGroup-sizing-sm">Apellido</span>
                    <input name="apellido" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                    
                </div>
                <button type="submit" class="btn btn-outline-primary">Enviar</button>
                </form>
                <br>
                <div class="alert alert-success" role="alert">
                    <div id="nombre">{{ $msg ?? ''}}</div>
                    
                </div>
              </div>
              <div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Identificación</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fecha creación</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($socios))
                            @foreach($socios as $socio)
                                <tr>
                                    <td>{{$socio->identificacion}}</td>
                                    <td>{{$socio->nombre}}</td>
                                    <td>{{$socio->apellido}}</td>
                                    <td>{{$socio->created_at}}</td>
                                    <td>
                                        <form action="{{ route('reserva-socio-delete') }}" method="get">
                                            @csrf
                                            <input type="hidden" name="idSocio" value="{{$socio->id}}">
                                            <button type="submit" class="btn btn-outline-danger float-center">Editar</button>
                                        </form>
                                        <form action="{{ route('reserva-socio-delete') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="idSocio" value="{{$socio->id}}">
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
