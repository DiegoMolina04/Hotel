{{-- Extendiendo plantilla de dashboard--}}
@extends('layouts.dashboard')

{{-- Llenando espacio en plantilla --}}
@section('title', 'Eventos')

{{-- Envio del item que debe aparecer como activo en el menu de navegacion --}}
@section('itemActive','eventos_lista')

{{-- Contenido principal--}}
@section('content')
<!-- Tarjeta de factura -->
<div class="card">

    <!-- Cuerpo tarjeta -->
    <div class="card-body">

    <!-- Título tarjeta -->
    <h2 class="card-title"> Información reserva </h2>

    <!-- Fila contenedora de elementos -->
    <div class="row">
        <!-- Facturación paquete -->
        <div class="col-12 col-lg-6 my-4">
            <h3 class="card-subtitle mb-2 text-muted ">Paquete</h3>
            <p class="card-text"> Tipo: {{$Tipo_evento->nombre}} 
            <br>
            <p>Estado: <span class="estado{{$estado_reserva->id}}">{{$estado_reserva->nombre}}</span></p>
            @if($Tipo_evento->id != 1)
            Precio base: {{number_format($Tipo_evento->precio_general)}}
            <br>
            Precio por invitado: {{number_format($Tipo_evento->precio_invitado)}}
            <br>
            Número de invitados: {{$evento->Numero_invitados}}
            <br>
            @endif
            Precio por paquete: 
            {{number_format($Factura->paquete)}}
            
            </p>
        </div>
        <!-- Fin facturación paquete -->

        @if($Tipo_evento->id == 1)
            <!-- Facturación salon -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Salon</h3>
                <p class="card-text"> Tipo:{{$Salon->nombre}} 
                <br>
                Precio base: {{number_format($Salon->precio_general)}}
                <br>
                Precio por invitado: {{number_format($Salon->precio_silla)}}
                <br>
                Número de invitados: {{$evento->Numero_invitados}}
                <br>
                Precio por paquete: 
                {{number_format($Factura->salon)}}
                </p>
            </div>
            <!-- Facturación salon -->
        @endif

        @if($Tipo_evento->id == 1)
            <!-- Facturación salon -->
            <div class="col-12 col-lg-6 my-4">
                <h3 class="card-subtitle mb-2 text-muted ">Complementos</h3>
                @foreach ($Complementos as $complemento)
                    <p class="card-text"> <h5 class="card-subtitle">{{$complemento->nombre}} </h5>
                    <br>
                    Precio base: {{number_format($complemento->precio_general)}}
                    <br>
                    Precio por invitado: {{number_format($complemento->precio_invitado)}}
                    <br>
                    Número de invitados: {{$evento->Numero_invitados}}
                    <br>
                    Precio por complemento: 
                    {{number_format($complemento->precio_general+ ($complemento->precio_invitado * $evento->Numero_invitados))}}
                    </p>
                @endforeach
                <br>
                Precio total complementos:
                {{number_format($Factura->complementos)}}
            </div>
            <!-- Facturación salon -->
        @endif

        <!-- Facturación general -->
        <div class="col-12 col-lg-6 my-4">
            <h3 class="card-subtitle mb-2 text-muted ">Total</h3>
                @if($Tipo_evento->id != 1)
                Paquete: {{number_format($Factura->paquete)}}
                <br>
                @endif
                @if($Tipo_evento->id == 1)
                Precio por salon: {{number_format($Factura->salon)}}
                <br>
                Precio por complementos: {{number_format($Factura->complementos)}}
                <br>
                @endif
                <br>
                Subtotal: {{number_format($Factura->subtotal)}}
                <br>
                Valor de iva: {{number_format($Factura->valor_iva)}}
                <br>
                Valor total: {{number_format($Factura->valor_total)}}
                </p>
                @if($evento->id_estado_evento != 2  && $evento->id_estado_evento != 3)
                <div>
                    <a href={{route('eventos.edit',$evento->id)}} class="btn btn-primary">Editar reserva</a>
                </div>
                @endif
            <br>
        </div>
        <!-- Fin facturación general -->
    </div>
    <!-- Cierre fila de contenidos tarjeta -->

  </div>
  <!-- Cierreckuerpo tarjeta -->
</div>
<!-- Cierre tarjeta -->

<form action="{{route('eventos.destroy', $evento->id)}}" method="POST">
    @csrf
    @method('DELETE')

    <div class="m-2" style="display: flex; justify-content: space-between;">
        <a id="cancelar" class="btn btn-danger">Cancelar reserva</a>
        <a href={{route('eventos.index')}} class="btn btn-success">Ver todas las reservas</a>
        @if($Tipo_evento->id != 1 && $evento->id_estado_evento != 2  && $evento->id_estado_evento != 3)
            @if($invitados == null)
                <a href={{route('invitados.create', $evento->id)}} class="btn btn-primary">Añadir invitados</a>
            @else
                <a href={{route('invitados.index', $evento->id)}} class="btn btn-primary">Editar invitados</a>
            @endif
        @endif
    </div>

    <div id="confirmacion" class="confirmacion">
        
        <div class="card text-bg-danger mb-3" >
            <div class="card-body">
            <h5 class="card-title">¿Estás seguro?</h5>
            <p class="card-text">Esta acción no es reversible, la configuración de este evento se perderá para siempre. </p>
            </div>
            <div class="m-2" style="display: flex; justify-content: space-between;">
                <a id="regresar" class="btn btn-success">Regresar</a>
                <button type="submit" class="btn btn-danger">Cancelar reserva</button>
            </div>
        </div>
    </div>
</form>

<script>
    let confirmation = document.getElementById('confirmacion');
    let cancel = document.getElementById('cancelar');
    let back = document.getElementById('regresar');

    cancel.addEventListener('click', function(){
        confirmation.style.display = 'flex';
    });

    regresar.addEventListener('click', function(){
        confirmation.style.display = 'none';
    });
</script>
@endsection