@extends('layouts.dashboard')

@section('title', 'Nueva reserva')

@section('menu')
    @include('components.client_menu', ['nuevevent' => 'active'])
@endsection

@section('content')
    <h1>Hacer nueva reserva de evento o espacio</h1>
    <div class="card p-2">
        <form action="{{route("eventos.store")}}" method="POST">

            @csrf
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
                <div class="col-8 col-sm-6">
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" name="spaceOnly">
                    <label class="btn btn-outline-primary" for="btn-check">Reservar solo espacio</label>
                </div >
                
                <div class="row mt-4">
                    <div class="col-12 col-sm-6">
                        <label id="tipoDe">Tipo de evento</label>
                        <select class="form-select" id="EventType" name="TipoEvento" required>
                            <option value=""> --- </option>
                            @foreach($event_types as $event)
                                <option value="{{$event->id}}">{{$event->nombre}}</option>
                            @endforeach
                        </select>
                        <select class="form-select" id="SalonType" name="SalonType" hidden>
                            <option value=""> --- </option>
                            @foreach($salon_types as $salon)
                                <option value="{{$salon->id}}">{{$salon->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-3" id="sillas" hidden>
                        <label for="inputSillas">Número sillas</label>
                        <input class="form-control" type="number" name="sillas" id="inputSillas">
                    </div>
                </div >
                    
            </div class="row">
            <div class="row p-2">
                <div class="col-12 col-sm-6">
                    <label for="ini">Inicio evento</label>
                    <input type="datetime-local" name="fecha_inicio" id="ini" class="form-control" value="{{old('fecha_inicio')}}">
                </div >
                
                <div class="col-12 col-sm-6">
                    <label for="fin">Final evento</label>
                    <input type="datetime-local" name="fecha_fin" id="fin" class="form-control" value="{{old('fecha_fin')}}">
                </div>
                    
            </div class="row">
            <div style="overflow-x: auto" id="tablaInvitados">
                <h3 class="my-2">Lista de invitados</h3>
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
                            <th scope="col">
                                Invitado especial
                            </th>
                            </th scope="col">
                            <th>
                                Remover
                            </th>
                        </tr>
                    </thead>
                        <tbody id="lista">
                            <tr class="fila">
                                <td scope="col">
                                    <select class="form-select" name="" id="" name="docType[]">
                                        <option value=""> ---</option>
                                        @foreach($Tipos_documento as $documento)
                                            <option value="{{$documento->id}}">{{$documento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td scope="col">
                                    <input type="number" name="doc[]" id="" class="form-control">
                                </td>
                                <td scope="col">
                                    <input type="text" name="nombre[]" class="form-control">
                                </td>
                                <td scope="col">
                                    <input type="checkbox" name="especial" class="form-check-input">
                                    <label> Especial </label>
                                </td>
                                <td scope="col">
                                    <button class="btn btn-danger delete">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div id="complementos" hidden>
                <h3>Complementos: </h3>
                @foreach ($complementos as $complemento)
                    <input type="checkbox" name="{{$complemento->nombre}}" id="{{$complemento->nombre}}" class="form-check-input">
                    <label for="{{$complemento->nombre}}">{{$complemento->nombre}}</label><br>
                @endforeach
            </div>
            <div class="p-2 d-flex justify-content-between">
                <button id="new" type="button" class="btn btn-primary">
                    Añadir invitado
                </button>
                <input type="submit" value="Hacer reserva" class="btn btn-success">
            </div>

            <input type="hidden" name="num_rows" value=2>
        </form>
    </div>
@endsection
