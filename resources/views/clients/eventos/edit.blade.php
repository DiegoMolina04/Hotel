@extends('layouts.dashboard')

@section('title', 'Editar invitado')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

@section('content')
<h1>Hacer nueva reserva de evento o espacio</h1>
    <div class="card p-2">
        <form action="{{route("eventos.update", $evento->id)}}" method="POST">

            @csrf
            @method('PUT')

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row p-2">                
                <div class="row mt-4">
                    <div class="col-12 col-sm-6">
                        @if($evento->id_tipo_evento != 1)
                            <label id="tipoDe">Tipo de evento</label>
                            <select class="form-select" id="EventType" name="TipoEvento" required>
                                <option value=""> --- </option>
                                @foreach($event_types as $event)
                                    @if ($event->id == 1)
                                        @continue
                                    @endif
                                    @if($evento->id_tipo_evento == $event->id)
                                        <option value="{{$event->id}}" selected>{{$event->nombre}}</option>
                                    @else
                                        <option value="{{$event->id}}">{{$event->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <label id="tipoDe">Tipo de espacio</label>
                            <select class="form-select" id="SalonType" name="TipoSalon">
                                <option value=""> --- </option>
                                @foreach($salon_types as $salontype)
                                    @if($salon->Tipo->id == $salontype->id)
                                        <option value="{{$salontype->id}}" selected>{{$salontype->nombre}}</option>
                                    @else
                                        <option value="{{$salontype->id}}">{{$salontype->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div >
                    
            </div class="row">
            <div class="row p-2">
                <div class="col-12 col-sm-6">
                    <label for="ini">Inicio evento</label>
                    <input type="datetime-local" name="fecha_inicio" id="ini" class="form-control" value="{{$evento->fecha_inicio}}" min="{{date('Y-m-d\TH:i')}}">
                </div >
                
                <div class="col-12 col-sm-6">
                    <label for="fin">Final evento</label>
                    <input type="datetime-local" name="fecha_fin" id="fin" class="form-control" value="{{$evento->fecha_fin}}" min="{{date('Y-m-d\TH:i')}}">
                </div>
                    
            </div>
            <div class="p-2 d-flex justify-content-end">
                <input type="submit" value="Actualizar reserva" class="btn btn-primary">
            </div>
        </form>

            @if($evento->id_tipo_evento == 1)
            <div id="complementos">
                <h3>Complementos: </h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Complemento</th>
                            <th>¿Incluido?</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complementos as $complemento)
                            <tr>
                                <td>{{$complemento->nombre}}</td>
                                <td>
                                    @if($complemento->id_evento != null)
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    @if($complemento->id_evento != null)
                                        <form action={{route("delComp", $complemento->id_compEven)}} method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"> Eliminar </button>
                                        </form>
                                    @else
                                        <form action={{route("addComp", $evento->id)}} method="POST">
                                            @csrf
                                            <input type="hidden" value={{$complemento->id}} name="complemento">
                                            <button type="submit" class="btn btn-success"> Añadir </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <div class="p-2 d-flex justify-content-end">
                <a href="{{route('eventos.show', $evento->id)}}"  class="btn btn-primary">Regresar</a>
            </div>

            <input type="hidden" name="num_rows" value=2>
    </div>
@endsection