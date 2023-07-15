{{-- Extendiendo plantilla de dashboard--}}
@extends('layouts.dashboard')

{{-- Llenando espacio en plantilla --}}
@section('title', 'Eventos')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

{{-- Contenido principal--}}
@section('content')
@if($eventos != null)
<table class="table">
    <thead>
      <tr>
        <th></th>
        <th scope="col">Código reserva</th>
        <th scope="col">Tipo Evento</th>
        <th scope="col">Número asistentes</th>
        <th scope="col">Fecha de inicio</th>
        <th scope="col">Fecha de fin</th>
        <th scope="col">Seleccionar</th>
      </tr>
    </thead>
    <tbody>
        @foreach($eventos as $evento)
        <tr>
            <td class="estado{{$evento->id_estado_evento}}"></td>
            <th scope="row">#Ev{{$evento->id}}</th>
            <td style="">{{$evento->tipoEvento->nombre}}</td>
            <td>{{$evento->Numero_invitados}}</td>
            <td>{{$evento->fecha_inicio}}</td>
            <td>{{$evento->fecha_fin}}</td>
            <td><a class="btn btn-primary" href={{route("eventos.show",["evento" => $evento->id])}}>Seleccionar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h3>¡Ops!, parece que aún no has hecho ninguna reserva</h3>
    <a href={{route('eventos.create')}} class="btn btn-success mt-4">Hacer reserva</a>
@endif

@endsection