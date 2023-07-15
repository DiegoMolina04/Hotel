@extends('layouts.dashboard')

@section('title', 'Editar invitado')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

@section('content')
<div class="card">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  <div class="card-body">
    <h3 class="card-title">Editar información de asistente</h3>
    <form action={{route('invitados.update', [$idEvento, $invitado->id])}} method="post">
        @csrf
        @method('PUT')
        <table class="table container-fluid" style="table-layout: fixed; min-width: 550px;">
            <thead>
                <tr class="table-primary">
                    <th scope="col">
                        Tipo de documento
                    </th>
                    <th scope="col">
                        Número documento
                    </th>
                    <th scope="col">
                        Nombre
                    </th>
                </tr>
            </thead>
                <tbody id="lista">
                    <div class="input-group mb-3 row">
                        <tr class="fila">
                            <td scope="col">
                                <select class="form-select" name="TipoDocumento">
                                    <option value=""> ---</option>
                                    @foreach($Tipos_documento as $documento)
                                        @if($documento->id == $invitado->id_tip_doc)
                                            <option value={{$documento->id}} selected>{{$documento->nombre}}</option>
                                        @else
                                            <option value={{$documento->id}}>{{$documento->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td scope="col">
                                <input type="number" name="Documento" id="" class="form-control" value="{{$invitado->num_documento}}">
                            </td>
                            <td scope="col">
                                <input type="text" name="Nombre" class="form-control" value="{{$invitado->nombre}}">
                            </td>
                        </tr>
                    </div>
                </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a href={{route('invitados.index', $idEvento)}} class="btn btn-primary">Regresar</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
  </div>
</div>
@endsection