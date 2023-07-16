@extends('layouts.dashboard')

@section('title', 'Home')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion 
    
    --}}
@section('itemActive', 'pqrs_create')

@section('content')
    <h1 style="margin-left:37%;">Todos los PQRS</h1>



    @csrf
    {{-- <div class="card rounded-5 p-4 col-md-9 col-12 offset-md-1"> --}}
    <div class="card rounded-5 offset-md-1">
        <div class="card-body">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-lx-12">
                        <form action="{{ route('gestion-pqrs.index') }}" method="GET">

                            <div class="form-row">
                                <div class="col-sm-4">
                                    Filtro por nombre de cliente o tipo de pqrs
                                    <select class="form-select" name="tipo_filtro">
                                        <option value="1">Nombre cliente</option>
                                        <option value="2">Tipo petición</option>
                                    </select>
                                    <br>
                                    <br>

                                    <input type="text" name="filtro" value="{{ $filtro }}">
                                    <input type="submit" value="Buscar">

                                </div>
                            </div>
                        </form>

                        {{-- <div class="form-row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="texto">
                                    </div>
                                    <div class="col-auto">
                                        <input type="submit" class="btn btn-primary" value="Buscar">
                                    </div>
                                </div> --}}

                    </div>
                    <form action="{{ route('pqrs.store') }}" method="POST">
                        <div class="col-lx-12">
                            <div style="height: 80%" style="overflow: scroll" class="table-responsive">
                                <br>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Nombre cliente</th>
                                            <th style="text-align: center">Tipo PQR</th>
                                            <th style="text-align: center">Descripción</th>
                                            <th style="text-align: center">Nombre trabajador</th>
                                            <th style="text-align: center">Respuesta</th>
                                            <th style="text-align: center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pqrs as $pqr)
                                            <tr>
                                                <td style="text-align: center">{{ $pqr->id_cliente }}</td>
                                                <td style="text-align: center">{{ $pqr->id_tipo_pqrs }}</td>
                                                <td style="text-align: center">{{ $pqr->descripcion }}</td>
                                                <td style="text-align: center">{{ $pqr->id_trabajador }}
                                                </td>
                                                <td style="text-align: center">{{ $pqr->respuesta }}</td>
                                                <td style="display: block" style="text-align: center">

                                                    <a href="{{ route('gestion-pqrs.edit', $pqr->id) }}"
                                                        class="btn btn-primary w-auto">Responder</a>


                                                    {{-- <a href="{{ route('gestion-pqrs.destroyView', $pqr->id) }}"
                                                        class="btn btn-danger w-auto">Eliminar</a> --}}
                                                    <form style="display: inherit"
                                                        action="{{ route('gestion-pqrs.destroy', $pqr->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger w-auto"
                                                            value="Eliminar">
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- @foreach ($data_Json as $data) --}}
                                        {{-- @for ($i = 0; $i <= count($data) - 1; $i++)
                                            <tr>
                                                <td style="text-align: center">{{ $data[$i]['nombre_cliente'] }}</td>
                                                <td style="text-align: center">{{ $data[$i]['tipo_pqr'] }}</td>
                                                <td style="text-align: center">{{ $data[$i]['descripcion'] }}</td>
                                                <td style="text-align: center">{{ $data[$i]['nombre_trabajador'] }}
                                                </td>
                                                <td style="text-align: center">{{ $data[$i]['respuesta'] }}</td>
                                                <td style="text-align: center">
                                                    <button href="{{ route('pqrs.edit'), $data[$i]['id'] }}" type="button"
                                                        class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#ModalCreatePQR" data-id="{{ $data[$i]['id'] }}"
                                                        data-nombre-cliente="{{ $data[$i]['nombre_cliente'] }}"
                                                        data-tipo-pqr="{{ $data[$i]['tipo_pqr'] }}"
                                                        data-descripcion="{{ $data[$i]['descripcion'] }}"
                                                        data-nombre-trabajador="{{ $data[$i]['nombre_trabajador'] }}"
                                                        data-respuesta="{{ $data[$i]['respuesta'] }}">Abrir modal
                                                        para</button>
                                                    <a href="">Eliminar</a>

                                                </td>
                                            </tr>
                                        @endfor
                                        @include('components.modales.editPQR') --}}
                                        {{-- @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>


    </form>

@endsection
