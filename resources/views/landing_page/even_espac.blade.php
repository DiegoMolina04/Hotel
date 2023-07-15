{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Espacios')

{{-- Contenido principal --}}
@section('content')


<!-- Titulo -->
<h1 style="color:#000000;" class="row m-4">
    <!-- Separador decorativo -->
    <div class="col-4"><hr></div>
    
    <!-- Texto de título general -->
    <div class="col-4 text-center" style=" text-shadow: #2499c7 0 6px 1rem;">
      Elige un Espacio
    </div >

    <!-- Separador decorativo -->
    <div class="col-4"><hr></div>
  </h1>
  <!-- Cierre titulo general -->

  <hr>

  <!-- Título grupo de eventos -->
  <h3 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
   Espacios Diseñados especialmente para ti
  </h3>

  <hr>

  <!-- Grupo de tarjetas -->
  <div class="d-flex justify-content-around container-eventos m-4">

    <!-- Primera tarjeta de evento -->
    <div class="card" style="width: 40%;">

      <!-- Imagen de tarjeta -->
      <img style="object-position: 50% 25%;" src={{asset('img/eventos/espacios/esp1.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">
        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          Paradise
        </h5>

        <!-- Descripción del paquete --> 
        <p class="card-text">
           Espacio versátil y rústico diseñado para brindarte experiencias memorables. Este espacio es el lugar perfecto para máximo 200 personas y todo tipo de eventos, desde conferencias y reuniones de negocios hasta celebraciones sociales y bodas. Ofrecemos servicios audivisuales, y personal para asegurar que cada evento sea un éxito.
          
        </p>
        <!-- Cierre descripción del paquete -->
        
        <!-- Botón de reserva del paquete -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
        
      </div>
      <!-- Cierre de cuerpo de tarjeta -->
    </div>
    <!-- Cierre de primera tarjeta -->

   <!-- Segunda tarjeta tipo boda -->
   <div class="card" style="width: 40%">

    <!-- Imagen tarjeta -->
    <img src={{asset('img/eventos/espacios/espa2.png')}} class="card-img-top eventos" alt="...">

    <!-- Cuerpo de tarjeta -->
    <div class="card-body">

      <!-- Título del paquete -->
      <h5 class="card-title titulo-card">
        Freedom
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">
        Espacio versátil y rústico diseñado para brindarte experiencias memorables. Este espacio es el lugar perfecto para máximo 200 personas y todo tipo de eventos, desde conferencias y reuniones de negocios hasta celebraciones sociales y bodas. Ofrecemos servicios audivisuales, y personal para asegurar que cada evento sea un éxito.
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de paquete -->
  </div>
  <!-- Cierre de segunda tarjeta tipo boda -->

   <!-- Tercera tarjeta -->
   <div class="card" style="width: 40%">

    <!-- Imagen tarjeta -->
    <img src={{asset('img/eventos/espacios/espa3.png')}} class="card-img-top eventos" alt="...">

    <!-- Cuerpo de tarjeta -->
    <div class="card-body">

      <!-- Título del paquete -->
      <h5 class="card-title titulo-card">
        Marvelous
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">
        Espacio versátil y rústico diseñado para brindarte experiencias memorables. Este espacio es el lugar perfecto para máximo 200 personas y todo tipo de eventos, desde conferencias y reuniones de negocios hasta celebraciones sociales y bodas. Ofrecemos servicios audivisuales, y personal para asegurar que cada evento sea un éxito.
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de paquete -->
  </div>
  <!-- Cierre de Tercera tarjeta  -->  

</div>
<!-- Cierre grupo de tarjetas -->

@endsection