{{-- Extendiendo plantilla de dashboard--}}
@extends('layouts.dashboard')

{{-- Llenando espacio en plantilla --}}
@section('title', 'Gestion de eventos')

{{-- Contenido principal--}}
@section('content')
<!-- Tarjeta de factura -->
<div class="card">

    <!-- Cuerpo tarjeta -->
    <div class="card-body">

    <!-- Título tarjeta -->
    <h2 class="card-title"> Información reserva </h2>

    <!-- Formulario para actualizar estado -->
    <form method="POST" action="{{route('gestion-eventos.update', $evento->id)}}">
    <!-- Fila contenedora de elementos -->
    <div class="row">
        <!-- Información paquete -->
            @csrf
            @method('PUT')
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Paquete</h3>
                <p class="card-text"> Tipo: {{$evento->tipoEvento->nombre}} 
                <br>
                <p>Estado:
                    <select class="form-select" style="max-width: 20vw; display: inline;" name="estado">
                        @foreach($estados as $estado)
                            @if($estado->id == $evento->estadoReserva->id)
                                <option value={{$estado->id}} selected>{{$estado->nombre}}</option>
                            @else
                            <option value={{$estado->id}}>{{$estado->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </p>
                <p>
                    Total de asistentes: {{$evento->Numero_invitados}}
                </p>
                <p>
                    Fecha de inicio: {{$evento->fecha_inicio}}
                    <br>
                    Fecha de fin: {{$evento->fecha_fin}}
                </p>
                </p>
                <button type="submit" class="btn btn-success">Actualizar estado</button>
            </div>
            <!-- Fin Información paquete -->

        @if($evento->id_tipo_evento == 1)
            <!-- Información salon -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Salon</h3>
                <p class="card-text"> 
                    Tipo: {{ucfirst($Salon->tipo->nombre)}} <br>
                    Codigo: {{$Salon->codigo}}
                <br>
            </div>
            <!-- Información salon -->
        @endif

        @if($evento->id_tipo_evento == 1 && $Complementos != null)
            <!-- Información Complementos -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Complementos incluidos</h3>
                <ul>
                    @foreach ($Complementos as $complemento)
                        <li> {{$complemento->nombre}}
                    @endforeach
                </li>
                <br>
            </div>
            <!-- Información Complementos -->
        @endif
    </div>
    <!-- Cierre fila de contenidos tarjeta -->

    </form>
    <!-- Cierre formulario para actualizar estado -->
    

  </div>
  <!-- Cierre cuerpo tarjeta -->
</div>
<!-- Cierre tarjeta -->

@if($evento->id_tipo_evento != 1 && $asistentes->first() != null)

<div class="card mt-4">
    <div class="card-body">

        <h2 class="card-title"> Información Asistentes </h2>
        <p>
            Total de asistentes: {{$evento->Numero_invitados}}
        </p>

        <div class="row">
            <!-- Información invitados especiales -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">{{$evento->tipoEvento->nom_especiales}}</h3>
                <p class="card-text"> 
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de documento</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asistentes as $asistente)
                                @if($asistente->especial == true)
                                    <tr>
                                        <td>{{$asistente->TipoDocumento}}</td>
                                        <td>{{$asistente->num_documento}}</td>
                                        <td>{{$asistente->nombre}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- Información invitados especiales -->
    
            <!-- Información invitados -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Otros invitados</h3>
                <p class="card-text"> 
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tipo de documento</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asistentes as $asistente)
                                @if($asistente->especial == false)
                                    <tr>
                                        <td>{{$asistente->TipoDocumento}}</td>
                                        <td>{{$asistente->num_documento}}</td>
                                        <td>{{$asistente->nombre}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
            </div>
            <!-- Información invitados -->
        </div>
    </div>
</div>

<div class="m-2">
    <a href="" class="btn btn-primary">Ver todos los eventos</a>
</div>
@endif

@endsection