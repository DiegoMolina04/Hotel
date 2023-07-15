@extends('layouts.dashboard')

@section('title', 'Home')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive', 'pqrs_create')

@section('content')
    <h1 style="margin-left:30%;">¿Tienes Algo Que Decirnos?</h1>

    <form action="{{ route('pqrs.store') }}" method="POST">

        @csrf

        <div class="card rounded-5 p-4 col-md-9 col-12 offset-md-1">
            <div class="card-body">
                <!-- <label for="nombre">Escribe tu nombre:</label>
                                                                                <br>
                                                                                <br>
                                                                                <div class="col-12 col-md-8">
                                                                                    <input class="form-control" placeholder="Nombre Completo" type="text"id="nombre" name="nombre">
                                                                                </div>
                                                                             -->


                <br>
                Tipo:
                <br>
                <br>

                <div class="col-12 col-md-8">
                    <select class="form-select" name="requerimiento" required="">
                        <option value="" selected="">Selecciona uno</option>
                        <option value="1">Peticion</option>
                        <option value="2">Queja</option>
                        <option value="3">Reclamo</option>
                        <option value="4">Sugerencia</option>
                    </select>
                </div>

                {{-- <input type="checkbox" class="btn-check" id="peticion" name="peticion" autocomplete="off">
                <label class="btn btn-outline-primary" for="peticion" value="1">Peticion</label>

                <input type="checkbox" class="btn-check" id="queja" name="queja" autocomplete="off">
                <label class="btn btn-outline-primary" for="queja" value="2">Queja</label>

                <input type="checkbox" class="btn-check" id="reclamo" name="reclamo" autocomplete="off">
                <label class="btn btn-outline-primary" for="reclamo" value="3">Reclamo</label>

                <input type="checkbox" class="btn-check" id="sugerencia" name="sugerencia" autocomplete="off">
                <label class="btn btn-outline-primary" for="sugerencia" value="4">Sugerencia</label> --}}



                <!--Campo: Tipo de Habitacion Seleccionada (tipo_hab)-->



                {{-- <br> 
                <br> --}}

                {{-- Califica nuestro Servicio
                <div class="star-rating">
                    <a name="1">★</a>
                    <a name="2">★</a>
                    <a name="3">★</a>
                    <a name="4">★</a>
                    <a name="5">★</a>
                </div> --}}


                <br>

                Realiza una breve descripción de tu PQRS:

                <br>
                <br>
                <div class="col-12 col-md-8">
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="40" rows="5" required=""></textarea>
                </div>

                <br>

                <!--<div class="form-check">
                                                                                 <input class="form-check-input" type="checkbox" value="" id="respcorreo" name="respcorreo">
                                                                                  <label class="form-check-label" for="respcorreo">
                                                                                    Recibir Respuesta en mi correo
                                                                                 </label>
                                                                                 </div>-->
                <br>
                <input type="submit" value="Enviar PQRS" class="btn btn-success float-end">

            </div>
        </div>


    </form>

@endsection
