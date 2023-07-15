{{-- Extendiendo plantilla de dashboard--}}
@extends('layouts.dashboard')

{{-- Llenando espacio en plantilla --}}
@section('title', 'Inventario')

{{-- Contenido principal--}}
@section('content')
    <!-- Título sección -->
    <h1>Inventario</h1>

    <!-- Separador -->
    <hr>

    <!-- Botón de crear nuevo item -->
    <a href="{{route("gestion-inventario.create")}}" class="btn btn-primary"> 
        Agregar inventario
    </a>

    <!-- Tabla de inventario -->
    <table class="table table-striped table-hover mt-4 table-inventario">

        <!-- Títulos de columnas -->
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripctión</th>
                <th scope="col">Tipo elemento</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <!-- Cierre títulos columnas -->

        <!-- Filas / cuerpo de tabla -->
        <tbody>
            <tr>
                <td class="bg-warning bg-gradient"></td>
                <td>124</td>
                <td>Silla</td>
                <td>Lugar para sentarse 😁</td>
                <td>Mueble habitación</td>
                <td>10</td>
                <td>
                    <!-- Botones de acciones -->
                    <a href="#" class="my-1 btn btn-success">
                        Editar
                    </a>
                    <br>
                    <a href="#" class="my-1 btn btn-danger">
                        Eliminar
                    </a>
                </td>
            </tr>
        </tbody>
        <!-- Cierre cuerpo tabla -->
    </table>
    <!-- Cierre de tabla de inventario -->
@endsection