@extends('layouts.dashboard')

@section('title', 'Nueva reserva')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

@section('content')

<div class="card" >
  <div class="card-body">
    <h3 class="card-title">Invitados - {{$tipoEvento->nombre}}#Ev{{$evento->id}}</h3>
    <h4 class="card-subtitle mb-2 text-muted ">{{$tipoEvento->nom_especiales}}</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo de documento</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistentes as $asistente)
                @if($asistente->especial == true)
                    <tr>
                        <td>{{$asistente->TipoDocumento}}</td>
                        <td>{{$asistente->num_documento}}</td>
                        <td>{{$asistente->nombre}}</td>
                        <td>
                            <a href={{route("invitados.edit", [$evento->id, $asistente->id])}} class="btn btn-success">Editar</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h4 class="card-subtitle mb-2 text-muted ">Otros asistentes</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Tipo de documento</th>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Nombre</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistentes as $asistente)
                @if($asistente->especial != true)
                    <tr>
                        <td>{{$asistente->TipoDocumento}}</td>
                        <td>{{$asistente->num_documento}}</td>
                        <td>{{$asistente->nombre}}</td>
                        <td>
                            <form method="POST" action={{route("invitados.destroy", [$evento->id, $asistente->id])}}>
                                @csrf
                                @method('DELETE')
                                <button type="submit"class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <a href={{route("invitados.edit", [$evento->id, $asistente->id])}} class="btn btn-success">Editar</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <a href={{route("eventos.show", $evento->id)}} class="btn btn-primary">Regresar</a>
        <a href={{route("ViewAddAsist", $evento->id)}} class="btn btn-success">Añadir invitado</a>
      </div>
  </div>
</div>

@endsection