@extends('layouts.dashboard')

@section('title', 'Listado Reservas')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','reservations_index')

@section('content')

    {{--Validacion si existe algun mensaje por mostrar--}}
    @if (Session::has('message'))
        @php
            //Guardado de la informacion del mensaje en variables
            $class_alert=Session::get('message')['class_alert'];
            $content=Session::get('message')['content'];
        @endphp
        
        {{--Mostrar el mensaje en forma de alerta Bootstrap--}}
        <div class="alert alert-{{$class_alert}} text-center" role="alert">
            {{$content}}
        </div>
    @endif

    <div class="text-center">

        <h1>Reservas Activas</h1>

        @if (count($reservas_activas)>0)
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha y Hora Ingreso</th>
                        <th>Fecha y Hora Salida</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas_activas as $reserva)
                        <tr>
                            <td class="align-middle">{{$reserva->fecha_inicio}}</td>
                            <td class="align-middle">{{$reserva->fecha_fin}}</td>
                            <td class="align-middle">{{$reserva->estado_reserva}}</td>
                            <td class="align-middle">$ {{$reserva->valor_total}}</td>
                            <td class="align-middle">
                                <div class="container button-reservation">
                                    <a name="" id="" class="btn btn-success col-md-12" href="{{route("reservations.show",$reserva->id)}}" role="button">Ver Detallado</a>
                                </div>
                                
                                @if (FALSE)
                                    <div class="container button-reservation">
                                        <a name="" id="" class="btn btn-warning col-md-12" href="" role="button">Realizar Pago</a>
                                    </div>    
                                @endif

                                <div class="container button-reservation">
                                    <form action="{{route("reservations.destroy",$reserva->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger col-md-12" type="submit">Cancelar Reserva</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        @else

            <a name="" id="" class="btn btn-primary col-md-12" href="{{route("reservations.create")}}" role="button">Crear una nueva reserva</a>
            
        @endif
    
    </div>

        


@endsection
