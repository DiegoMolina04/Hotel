@extends('layouts.dashboard')

@section('title', 'Nueva reserva')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

@section('content')
<div class="card" >

  <div class="card-body">
    <h2 class="card-title">Invitados</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3 class="card-subtitle mb-2 text-muted ">Información de {{$paquete->nom_especiales}}</h3>
    @if($paquete->min_especiales == $paquete->max_especiales )
        <p>Ingrese exactamente {{$paquete->min_especiales}}.</p>
    @else
        <p>Ingrese almenos {{$paquete->min_especiales}} o máximo {{$paquete->max_especiales}}.</p>
    @endif
    <form action={{route('invitados.store', $evento->id)}} method="post">
        @csrf
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
                    @for($i = 0; $i < $paquete->max_especiales; $i++)
                        <tr class="fila">
                            <td scope="col">
                                <select class="form-select" name="TipoDocumentoEspeciales[]">
                                    <option value=""> ---</option>
                                    @foreach($Tipos_documento as $documento)
                                        @if($documento->id == old("TipoDocumentoEspeciales.$i"))
                                            <option value={{$documento->id}} selected>{{$documento->nombre}}</option>
                                        @else
                                            <option value={{$documento->id}}>{{$documento->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td scope="col">
                                <input type="number" name="DocumentoEspeciales[]" id="" class="form-control" value="{{old("DocumentoEspeciales.$i")}}">
                            </td>
                            <td scope="col">
                                <input type="text" name="NombreEspeciales[]" class="form-control" value="{{old("NombreEspeciales.$i")}}">
                            </td>
                        </tr>
                    @endfor
                    </div>
                </tbody>
        </table>
        @if(($evento->Numero_invitados - $paquete->min_especiales) > 0)
        <h3 class="card-subtitle mb-2 text-muted ">Demás invitados</h3>
        @if($paquete->min_especiales == $paquete->max_especiales )
            <p>Ingrese exactamente {{$evento->Numero_invitados - $paquete->min_especiales}}.</p>
        @else
            <p>Ingrese el número de invitados necesario para completar {{$evento->Numero_invitados}} teniendo en cuenta a el(los) {{$paquete->nom_especiales}}.</p>
        @endif
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
                    @for($i = 0, $max = ($evento->Numero_invitados -$paquete->min_especiales); $i < $max; $i++)
                        <tr class="fila">
                            <td scope="col">
                                <select class="form-select" name="TipoDocumento[]">
                                    <option value=""> ---</option>
                                    @foreach($Tipos_documento as $documento)
                                        @if($documento->id == old("TipoDocumento.$i"))
                                            <option value={{$documento->id}} selected>{{$documento->nombre}}</option>
                                        @else
                                            <option value={{$documento->id}}>{{$documento->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td scope="col">
                                <input type="number" name="Documento[]" id="" class="form-control" value="{{old("Documento.$i")}}">
                            </td>
                            <td scope="col">
                                <input type="text" name="Nombre[]" class="form-control" value="{{old("Nombre.$i")}}">
                            </td>
                        </tr>
                    @endfor
                    </div>
                </tbody>
        </table>
        @endif
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit">Añadir invitados</button>
        </div>
    </form>
  </div>
</div>
@endsection