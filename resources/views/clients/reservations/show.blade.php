@extends('layouts.dashboard')

@section('title', 'Detallado Reserva')

@section('content')

    <div class="text-center">

        <h1>Detallado de la Reserva</h1>

        @php
            //Transformar el formato de la fecha de inicio como de finalizacion de la reserva, para luego ser representadas en los input
            $fecha_inicio=date("Y-m-d", strtotime($info_reserva[0]->fecha_inicio));

            $fecha_fin=date("Y-m-d", strtotime($info_reserva[0]->fecha_fin));
        @endphp

        <div class="card" style="overflow-x: auto;">
            <div class="card-body">

                <!--Seccion: Fecha Inicio y Fecha fin de la reserva-->
                <div>
                    <h2 class="title-reservation-section">Lapso de la reserva</h2>
                    <div class="row p-2 section-reservation">
            
                        <!--Campo: Fecha de inicio de la reserva (fecha_ingreso)-->
                        <div class="col-6">
                            <label>Fecha de Ingreso</label>
                            <input type="date" class="form-control" value="{{$fecha_inicio}}" required disabled>
                        </div>
        
                        <!--Campo: Fecha de finalizacion de la reserva (fecha_salida)-->
                        <div class="col-6">
                            <label >Fecha de Salida</label>
                            <input type="date" class="form-control" value="{{$fecha_fin}}" disabled>
                        </div> 

                    </div>
                </div>

                <!--Seccion: Tipo Habitacion, Max Personas-->
                <div class="reservation-section">
                        
                    <h2 class="title-reservation-section">Habitaciones reservadas</h2>
                    
                    <table class="table" style="table-layout: fixed;">
                        <thead>
                            <tr class="table-primary">
                                <th colspan="2">Tipo de habitación</th>
                                <th>Max. Personas</th>
                                <th>Codigo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($info_reserva as $registro)
                                <tr>
                                    <td colspan="2" class="td_reservation">
                                        <input type="numeric" class="form-control" disabled value="{{$registro->tipo_hab}}">
                                    </td>

                                    <td class="td_reservation">
                                        <input type="numeric" class="form-control" disabled value="{{$registro->max_personas}}">
                                    </td>

                                    <td class="td_reservation">
                                        <input type="numeric" class="form-control" disabled value="{{$registro->codigo}}">
                                    </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                
            <div class="card-footer text-muted">

                <!--Boton Editar o actulizar la reserva-->
                <a class="btn btn-warning" href="{{route("reservations.edit",$info_reserva[0]->id_reserva)}}" role="button">Editar/Actulizar la reserva</a>

                <!--Boton cancelar reserva y redirigir a la vista principal-->
                <a class="btn btn-primary" href="{{route("reservations.index")}}" role="button">Volver al menu principal</a>
        
            </div>

        </div>
            
    </div>

@endsection

@section('scripts')

@endsection
