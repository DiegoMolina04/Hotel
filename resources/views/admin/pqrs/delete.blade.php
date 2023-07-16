@extends('layouts.dashboard')

@section('title', 'Responder PQRS')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion 
    
    --}}
@section('itemActive', 'pqrs_create')

@section('content')
    <h1 style="margin-left:35%;">Eliminar PQRS</h1>

    <form action="{{ route('gestion-pqrs.destroy', $pqr->id) }}" method="POST">

        @csrf
        @method('PUT')
        <div class="card rounded-5 p-4 col-md-9 col-12 offset-md-1">
            <div class="card-body">

                Nombre cliente
                <br>
                <br>

            </div>
            <div style="text-align: center">
                <button type="submit" class="btn btn-success w-25">Responder</button>
                {{-- <button type="button" class="btn btn-secondary w-25">Cerrar</button> --}}
                <a href="{{ route('gestion-pqrs.index') }}" class="btn btn-secondary w-25">Regresar</a>
            </div>

        </div>
        </div>


    </form>

@endsection
