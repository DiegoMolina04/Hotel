{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Eventos')

{{-- Contenido principal --}}
@section('content')

<!-- Carrusel de imagenes -->
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">

  <!-- Incluyendo imagenes de carrusel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src={{asset('img/eventos/comedor.jpg')}} alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/eventos/boda.jpg')}} " class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/eventos/comedor2.jpg')}} " class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/eventos/fiesta.jpg')}} " class="d-block w-100" alt="...">>
    </div>
    <!-- Fin inclusión de imagenes de carrusel -->
  </div>
  <!-- Burbujas carrusel -->
    <div class="carousel-caption d-block d-md-block">
        <!-- titulo burbuja -->
        <h5>
          ¿Quieres hacer tus sueños realidad?
        </h5>

        <!--Contenido burbuja -->
        <p>
          Con Dream Scape podras hacerlo. Contamos con un gran equipo de coordinación para cualquier tipo de evento que tengas en mente. Podrás vivir tu boda de ensueño, tus quince años, tu fiesta ideal, o incluso  una pequeña reunión empresarial.
        </p>
    </div>
    <div class="carousel-caption d-block d-md-block">
        <!-- titulo burbuja -->
        <h5>
          Pero no es todo
        </h5>

        <!--Contenido burbuja -->
        <p>
          Por otro lado, si solamente deseas realizar un evento por tu cuenta pero adquirir uno de nuestros espacios adecuados. También lo podrás hacer. Nos encargaremos del seguimiento y desarrollo del evento, de la logística (decoración, alimentos, música, iluminación ,etc); brindando la mejor atención y garantizando el éxito de tu evento.
        </p>
    </div>
  <!-- Cierre burbujas carrusel -->
</div>
<!-- Cierre carrusel -->

<!-- Sección de promoción de eventos-->

<div class="d-flex justify-content-around container-eventos m-4">

    <!-- Primera tarjeta de evento tipo boda -->
    <div class="card" style="width: 40%;">

      <!-- Imagen de tarjeta -->
      <img style="object-position: 50% 25%;" src={{asset('img/eventos/espacios.jpeg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">
        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          Nuestros Espacios
        </h5>

        <!-- Descripción del paquete --> 
        <p class="card-text">
        Nuestro hotel ofrece una amplia gama de espacios elegantes y versátiles que se adaptan a cualquier tipo de evento, ya sea una conferencia corporativa, una reunión social o cualquier otro acontecimiento especial. 
Además de nuestros espacios excepcionales, nuestro equipo de expertos en eventos estará a tu disposición en cada paso del camino. 


        </p>
        <!-- Cierre descripción del paquete -->
        
        <!-- Botón de reserva del paquete -->
        <a href="{{route('espacios')}}" class="btn btn-primary">Ver Espacios</a>
        
      </div>
      <!-- Cierre de contenido de tarjeta -->
    </div>
    <!-- Cierre de primera tarjeta tipo boda -->


     <div class="card" style="width: 40%;">

      <!-- Imagen de tarjeta -->
      <img style="object-position: 50% 25%;" src={{asset('img/eventos/paquetes.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">
        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          Nuestros Paquetes
        </h5>
        <br>
        <!-- Descripción del paquete --> 
        <p class="card-text">
        Con nuestros paquetes de eventos exclusivos, te garantizamos una experiencia inigualable que dejará una impresión duradera en tus invitados. Además, Nuestros paquetes de eventos también incluyen una exquisita selección de opciones gastronómicas, ya que talentosos chefs han creado menús personalizables que deleitarán a tus invitados con una deliciosa fusión de sabores y presentaciones artísticas.
          
        
        </p>
        <!-- Cierre descripción del paquete -->
        <br>
        <!-- Botón de reserva del paquete -->
        <a href="{{route('paquetes')}}" class="btn btn-primary">Ver Paquetes</a>
        
      </div>
      <!-- Cierre de contenido de tarjeta -->
    </div>
    <!-- Cierre de primera tarjeta tipo boda -->
</div>

@endsection