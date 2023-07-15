@extends('layouts.dashboard')

@section('title', 'Nueva reserva')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','reservations_create')

@section('content')

@php
    //Transformar el formato de la fecha de inicio como de finalizacion de la reserva, para luego ser representadas en los input
    $fecha_inicio=date("Y-m-d", strtotime($info_reserva[0]->fecha_inicio));
    $fecha_fin=date("Y-m-d", strtotime($info_reserva[0]->fecha_fin));
@endphp

<div class="text-center">

    <h1>Actualizar una reserva</h1>

    <form action="{{route("reservations.update",1)}}" method="post">
        {{--Token CSRF Para formularios--}}
        @method('PATCH')
        @csrf

        {{--Visualizar los mensajes de error provenientes de la Form Request--}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="ul_alert">
                    @foreach ($errors->all() as $error)
                        <li style="list-style:none;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{--Visualizar los mensajes provenientes del Controlador--}}
        @if (Session::has('message'))
            @php
                //Guardado de la informacion del mensaje en variables
                $class_alert=Session::get('message')['class_alert'];
                $content=Session::get('message')['content'];
            @endphp
            
            {{--Mostrar el mensaje en forma de alerta Bootstrap--}}
            <div class="alert alert-{{$class_alert}}" role="alert">
                {{$content}}
            </div>
        @endif

        <div class="card" style="overflow-x: auto;">

            <div class="card-body">

                <!--Seccion: Fecha Inicio y Fecha fin de la reserva-->
                <div>
                    <h2 class="title-reservation-section">Ingrese el lapso de la reserva</h2>
    
                    <div class="row p-2 section-reservation">
        
                        <!--Campo: Fecha de inicio de la reserva (fecha_ingreso)-->
                        <div class="col-6">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
        
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{$fecha_inicio}}" required>
                        </div>
     
                        <!--Campo: Fecha de finalizacion de la reserva (fecha_salida)-->
                        <div class="col-6">
                            <label for="fecha_salida">Fecha de Salida</label>
        
                            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{$fecha_fin}}" required>
                        </div> 

                    </div>
                </div>

                <!--Seccion: Tipo Habitacion, Num Adultos, Num Niños-->
                <div class="reservation-section">
                    <h2 class="title-reservation-section">Ingrese el tipo de habitacion a reservar</h2>
                
                    <table class="table" style="table-layout: fixed;">
                        <thead>
                            <tr class="table-primary">
                                <th colspan="2">Tipo de habitación</th>
                                <th>Max. Personas</th>
                                <th>Num. Habitaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lista">

                            {{--Generacion de registros guardados--}}
                            @foreach ($info_reserva as $registro)
                                <tr class="fila">
                                    <td colspan="2" class="td_reservation">

                                        <!--Campo: Tipo de Habitacion Seleccionada (tipo_hab)-->
                                        <select class="form-select" name="tipo_hab[]" required>

                                            {{--Generar las opciones de los tipos de habitacion disponible--}}
                                            @foreach($room_types as $room)

                                                @if ($room->id==$registro->id)
                                                    <option value="{{$room->id}}" selected>{{$room->nombre}}</option>
                                                @else
                                                    <option value="{{$room->id}}">{{$room->nombre}}</option>
                                                @endif

                                            @endforeach
                                        </select>
                                    </td>

                                    <!--Campo Desabilidato: Numero maximo de personas (Autocompletado de acuerdo al tipo de habitacion seleccionado)-->
                                    <td class="td_reservation">
                                        <input type="numeric" class="form-control" disabled>
                                    </td>

                                    <!--Campo: Numero de Habitaciones (num_habitaciones)-->
                                    <td class="td_reservation">
                                        <input type="numeric" class="form-control" name="num_hab[]" required value="{{$registro->cantidad_habitaciones}}">
                                    </td>


                                    <td class="td_reservation">
                                        <button class="btn btn-danger delete">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="fila" id="fila_guia">
                                <td colspan="2" class="td_reservation">

                                    <!--Campo: Tipo de Habitacion Seleccionada (tipo_hab)-->
                                    <select class="form-select" name="tipo_hab[]" required>
                                        <option value="" selected>Selecciona uno</option>

                                        {{--Generar las opciones de los tipos de habitacion disponible--}}
                                        @foreach($room_types as $room)
                                            <option value="{{$room->id}}">{{$room->nombre}}</option>
                                        @endforeach
                                    </select>

                                    @error('tipo_hab')
                                        {{$message}}
                                    @enderror
                                </td>

                                <!--Campo Desabilidato: Numero de adultos (Autocompletado de acuerdo al tipo de habitacion seleccionado)-->
                                <td class="td_reservation">
                                    <input type="numeric" class="form-control" disabled>
                                </td>

                                <!--Campo: Numero de Habitaciones (num_habitaciones)-->
                                <td class="td_reservation">
                                    <input type="numeric" class="form-control" name="num_hab[]" required>
                                </td>

                                <td class="td_reservation">
                                    <button class="btn btn-danger delete">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            
            <div class="card-footer text-muted">

                <!--Boton Generar nuevo resgistro de habitación-->
                <button id="new" type="button" class="btn btn-primary">Añadir habitación</button>

                <!--Boton Guardar reserva-->
                <button type="submit" class="btn btn-success">Guardar Cambios</button>

                <!--Boton cancelar reserva y redirigir a la vista principal-->
                <a class="btn btn-danger" href="{{route("reservations.index")}}" role="button">Cancelar Actualizacion</a>
    
                <input type="hidden" name="num_rows" value=2>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')

    <script>
        
        /*
            Nombre Metodo: getElementsByClassName('nombre_clase')

            Funcion: Obtener todos los elementos los cuales tengan una clase en espcifica, luego los guarda en forma de coleccion

            Explicacion: Una vez que carga la pagina web, Javascript crea una copia del primer (y unico) registro de habitaciones, dicho registro lo usara mas adelante cuando queramos seleccionar otro tipo de habitacion
        */
        let fila = document.getElementById('fila_guia');

        /*
            Nombre Metodo: getElementById('id_elemento')

            Funcion: Seleccionar el elemento el cual tenga el mismo id

            Explicacion: Se guardara en una variable, la informacion del contenedor padre de todos los registros. Esto ya que mas adelante lo necesitaremos para inyectarle nuevos registros
        */
        let lista = document.getElementById("lista");

        /*
            Nombre Metodo: elemento_original.cloneNode(true)

            Funcion: Copiar o duplicar el elemento

            Explicacion: Se creara una copia en forma de constante del registro en blanco seleccionado anteriormente
        */
        const clon = fila.cloneNode(true); 

        /*
            Nombre Metodo: elemento.length
            Funcion: Contar la cantidad de subelementos existentes

            Objetivo: Esta funcion tiene como objetivo, detectar todos los botones de eliminacion de registro de habitacion, y de acuerdo a su posicion, borrar uno u otro registro

            Funcionamiento:

                1. Guardar en una variable,todos los elementos los cuales tengan la clase "detele", es decir todos los botones de eliminacion de habitacion

                2. Crear un ciclo for el cual se ejecute de acuerdo a la cantidad de botones de eliminacion existente (Obtenidos en el paso anterior)

                    2.1 En caso de que alguno de los botones sea oprimido, el sistema procedera a borrar la fila correspondiente al boton opimino

                --
            --
        */
        function DeleteBtns(){
            //Paso 1
            let btnElimin = document.getElementsByClassName('delete');

            //Paso 2
            for(i = 0; i < btnElimin.length ; i++){
        
                //Paso 2.1
                btnElimin[i].addEventListener('click', (e)=>{
                    let padre = e.target.parentElement.parentElement.parentElement;
                padre.removeChild(e.target.parentElement.parentElement);
                });
            }
        }

        /*
            Nombre Metodo: addEventListener('suceso',acciones)

            Funcion: Cuando suceda cierto suceso, haga x cosa

            Explicacion: Si el elemento el cual tiene el id "new", fue seleccionado, se creara un nuevo clon y luego se introducira dentro del contenedor padre, para luego ejecutar la funcion "DeleteBtns"
        */
        document.getElementById('new').addEventListener('click', ()=>{
            let clonNew = clon.cloneNode(true);
            lista.appendChild(clonNew);

            DeleteBtns();
        });

        //La funcion de deteccion y procesamiento de botones de borrado se ejecuta en cuanto cargamos la pagina web
        DeleteBtns();

    </script>
@endsection
