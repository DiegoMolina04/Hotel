{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Paquetes')

{{-- Contenido principal --}}
@section('content')


<!-- Titulo -->
<h1 style="color:#000000;" class="row m-4">
    <!-- Separador decorativo -->
    <div class="col-4"><hr></div>
    
    <!-- Texto de título general -->
    <div class="col-4 text-center" style=" text-shadow: #2499c7 0 6px 1rem;">
      Elige un paquete
    </div >

    <!-- Separador decorativo -->
    <div class="col-4"><hr></div>
  </h1>
  <!-- Cierre titulo general -->

  <hr>

  <!-- Título grupo de eventos -->
  <h2 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
    Bodas
  </h2>

  <hr>

  <!-- Grupo de tarjetas tipo boda -->
  <div class="d-flex justify-content-around container-eventos m-4">

    <!-- Primera tarjeta de evento tipo boda -->
    <div class="card" style="width: 40%;">

      <!-- Imagen de tarjeta -->
      <img style="object-position: 50% 25%;" src={{asset('img/eventos/boda3.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">
        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          Boda - Paquete standard
        </h5>

        <!-- Descripción del paquete --> 
        <p class="card-text">
          Ten una boda rememorable en DreamScape con el paquete básico:
          <ul>
            <li>
              Documentación para para boda simbolica, catolica o civil
            </li>
            <li>
              Fotografías y videos
            </li>
            <li>
              Tarta de boda
            </li>
            <li>
              Champán para el grupo después de la ceremonia
            </li>
            <li>
              1 arreglo de mesa con flores tropicales.
            </li>
            <li>
              Cena romántica a la luz de las velas con champán
            </li>
            <li>
              Bolsa de pétalos de rosa para la ceremonia
            </li>
          </ul>

        </p>
        <!-- Cierre descripción del paquete -->
        
        <!-- Botón de reserva del paquete -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
        
      </div>
      <!-- Cierre de contenido de tarjeta -->
    </div>
    <!-- Cierre de primera tarjeta tipo boda -->

    <!-- Segunda tarjeta tipo boda -->
    <div class="card" style="width: 40%">

      <!-- Imagen tarjeta -->
      <img src={{asset('img/eventos/boda.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Cuerpo de tarjeta -->
      <div class="card-body">

        <!-- Título del paquete -->
        <h5 class="card-title titulo-card">
          Boda - Paquete dreamy
        </h5>

        <!-- Descripción de paquete -->
        <p class="card-text">Ten una boda de ensueño disfrutando de todo lo que te ofrece el paquete dreamy: 
          <ul>
            <li>
              Todo lo incluido en el paquete standard 
            </li>
            <li>
              Wedding Planners que le ayudaran en la planificación de su boda antes de su llegada y durante su estancia en el resort
            </li>
            <li>
              Sonorización y traducción simultánea de la ceremonia si es necesario
            </li>
            <li>
              Los lugares más románticos en los que realizar la ceremonia como nuestra hermosa playa de arena blanca, magníficos gazebos
            </li>
          </ul>
          
        </p>
        <!-- Cierre descripción de paquete -->

        <!-- Botón de reserva de paquete -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

      </div>
      <!-- Cierre contenido de paquete -->
    </div>
    <!-- Cierre de segunda tarjeta tipo boda -->

    <!-- Tercera tarjeta tipo boda -->
    <div class="card" style="width: 40%">
      
      <!-- Imagen tarjeta -->
      <img style="object-position:bottom;" src={{asset('img/eventos/boda2.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de la tarjeta -->
      <div class="card-body">

        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          Boda - Paquete perfect
        </h5>

        <!-- Descripción de paquete -->
        <p class="card-text">Ten una boda más allá de lo que prodrías imaginar con nuestro paquete perfect: 
          <ul>
            <li>
              TODO lo incluido en los paquetes standard y dreamy
            </li>
            <li>
              Ramo tropical para la novia y boutonniere para el novio
            </li>
            <li>
              Detalle de bienvenida con selección de dulces artesanales
            </li>
            <li>
              Masaje de cortesía para dos y uso de la zona húmeda del Spa
            </li>
            <li>
              Upgrade gratuito a habitación superior para los novios (sujeto a disponibilidad)
            </li>
            <li>
              Pulsera especial para los novios con acceso exclusivo a todos los resorts
            </li>
          </ul>
        </p>
        <!-- Cierre descripción de paquete -->

        <!-- Botón de reserva de paquete -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

      </div>
      <!-- Cierre contenido de tarjeta -->
    </div>
    <!-- Cierre tercera tarjeta tipo boda -->

  </div>
  <!-- Cierre grupo de tarjetas tipo boda -->

  <hr>

  <!-- Título grupo de tarjetas -->
  <h2 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
    Cumpleaños
  </h2>

  <hr>

  <!-- Grupo de tarjetas tipo cumpleaños -->
  <div class="d-flex justify-content-around container-eventos m-4">
    
    <!-- Primera tarjeta tipo cumpleaños -->
    <div class="card" style="width: 40%">

      <!-- Imagen de tarjeta -->
      <img style="object-position:bottom;" src={{asset('img/eventos/birthDay.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">

        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          15 años - Paquete standard
        </h5>

        <!-- Descripción de paquete -->
        <p class="card-text">Celebra tu cumpleaños de la mejor manera con el paquete básico:
          <ul>
            <li>Fotografias y Videos</li>
            <li>Maquillador Profesional</li>
            <li>Arreglo florar en todas las mesas</li>
            <li>Detalle por parte del hotel</li>
          </ul>
        </p>
        <!-- Cierre descripción de paquete -->

        <!-- Botón de reservación -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
      </div>
      <!-- Cierre contenido de tarjeta -->
    </div>
    <!-- Cierre de tarjeta -->

    <!-- Segunda tarjeta tipo cumpleaños -->
    <div class="card" style="width: 40%">

      <!-- Imagen de tarjeta -->
      <img style="object-position:50% 30%;" src={{asset('img/eventos/birthDay2.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">

        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          15 años - Paquete dreamy
        </h5>

        <!-- Descripción de paquete -->
        <p class="card-text">Celebra tu cumpleaños una manera de ensueño paquete dreamy:
          <ul>
            <li>Todo lo includio en el paquete estandard</li>
            <li>Acompañamiento de los mejores chefs</li>
            <li>Animadores</li>
            <li>Decoración personalizada</li>
            <li>Detalles Para Invitados</li>
          </ul>
        </p>

        <!-- Cierre descripción de paquete -->

        <!-- Botón reserva de paquete -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

      </div>
      <!-- Cierre contenido de tarjeta -->
    </div>
    <!-- Cierre de tarjeta -->

    <!-- Tercera tarjeta de eventos tipo cumpleaños -->
    <div class="card" style="width: 40%">

      <!-- Imagen de tarjeta -->
      <img style="object-position:bottom;" src={{asset('img/eventos/birthDay3.jpg')}} class="card-img-top eventos" alt="...">

      <!-- Contenido de tarjeta -->
      <div class="card-body">

        <!-- Título de paquete -->
        <h5 class="card-title titulo-card">
          15 años - Paquete perfect
        </h5>

        <!-- Descripción de paquete -->
        <p class="card-text">Celebra tu cumpleaños la manera perfecta con el paquete dreamy:
          <ul>
            <li>Todo lo includio en el paquete estandard y dreamy</li>
            <li>Excursión guiada  por toda la infraestructura del hotel</li>
            <li>Suite por una noche (una persona) todo incluido</li>
            <li>Acceso a todas las actividades del hotel por un dia</li>
          </ul>
        </p>
        <!-- Cierre descripción -->

        <!-- Botón de reserva -->
        <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
      </div>
      <!-- Cierre de contenido de tarjeta -->
    </div>
    <!-- Cierre de tarjeta -->

  </div>
  <!-- Cierre grupo de tarjetas tipo cumpleaños -->
  <hr>

<!-- Título grupo de tarjetas -->
<h2 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
  Primeras Comuniones
</h2>

<hr>

<!-- Grupo de tarjetas tipo cumpleaños -->
<div class="d-flex justify-content-around container-eventos m-4">
  
  <!-- Primera tarjeta tipo cumpleaños -->
  <div class="card" style="width: 40%">

    <!-- Imagen de tarjeta -->
    <img style="object-position:bottom;" src={{asset('img/eventos/comunion1.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de tarjeta -->
    <div class="card-body">

      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
         Comunión - Paquete standard
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Celebra tu fiesta de primera Comunión de la mejor manera con el paquete básico:
        <ul>
          <li>Fotografias y Videos</li>
          <li>Postre</li>
          <li>Arreglo florar en todas las mesas</li>
          <li>Detalle por parte del hotel</li>
        </ul>
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reservación -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
    </div>
    <!-- Cierre contenido de tarjeta -->
  </div>
  <!-- Cierre de tarjeta -->

  <!-- Segunda tarjeta tipo cumpleaños -->
  <div class="card" style="width: 40%">

    <!-- Imagen de tarjeta -->
    <img style="object-position:50% 30%;" src={{asset('img/eventos/comunion2.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de tarjeta -->
    <div class="card-body">

      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Comunión - Paquete dreamy
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Celebra tu fiesta de primera Comunión con una reunión de ensueño con el  paquete dreamy:
        <ul>
          <li>Todo lo includio en el paquete estandard</li>
          <li>Acompañamiento de los mejores chefs</li>
          <li>Animadores</li>
          <li>Decoración personalizada</li>
          <li>Detalles Para Invitados</li>
        </ul>
      </p>

      <!-- Cierre descripción de paquete -->

      <!-- Botón reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de tarjeta -->
  </div>
  <!-- Cierre de tarjeta -->

  <!-- Tercera tarjeta de eventos tipo cumpleaños -->
  <div class="card" style="width: 40%">

    <!-- Imagen de tarjeta -->
    <img style="object-position:bottom;" src={{asset('img/eventos/comunion3.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de tarjeta -->
    <div class="card-body">

      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Comunión - Paquete perfect
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Celebra tu Primera Comunión soñada a la perfección con el paquete Perfect:
        <ul>
          <li>Todo lo incluido en el paquete estandard y dreamy</li>
          <li>Excursión guiada  por toda la infraestructura del hotel</li>
          <li>Suite por una noche (tres personas) todo incluido</li>
          <li>Acceso a todas las actividades del hotel por un día</li>
          <li>Banquete Especial</li>
        </ul>
      </p>
      <!-- Cierre descripción -->

      <!-- Botón de reserva -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
    </div>
    <!-- Cierre de contenido de tarjeta -->
  </div>
  <!-- Cierre de tarjeta -->

</div>
<!-- Cierre grupo de tarjetas tipo cumpleaños -->



<hr>

<!-- Título grupo de eventos -->
<h2 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
  Bautizos
</h2>

<hr>

<!-- Grupo de tarjetas tipo boda -->
<div class="d-flex justify-content-around container-eventos m-4">

  <!-- Primera tarjeta de evento tipo boda -->
  <div class="card" style="width: 40%;">

    <!-- Imagen de tarjeta -->
    <img style="object-position: 50% 25%;" src={{asset('img/eventos/bauti1.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de tarjeta -->
    <div class="card-body">
      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Bautizo - Paquete standard
      </h5>

      <!-- Descripción del paquete --> 
      <p class="card-text">
        Celebra un bautizo rememorable en DreamScape con el paquete básico:
        <ul>
         
          <li>
            Fotografías y videos
          </li>
          <li>
            Tarta de 3 pisos
          </li>
          <li>
            Champán para el grupo después de la ceremonia
          </li>
          <li>
            1 arreglo de mesa con flores tropicales.
          </li>
          <li>
            Detalle por parte del hotel.
          </li>
        </ul>

      </p>
      <!-- Cierre descripción del paquete -->
      
      <!-- Botón de reserva del paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
      
    </div>
    <!-- Cierre de contenido de tarjeta -->
  </div>
  <!-- Cierre de primera tarjeta tipo boda -->

  <!-- Segunda tarjeta tipo boda -->
  <div class="card" style="width: 40%">

    <!-- Imagen tarjeta -->
    <img src={{asset('img/eventos/bauti2.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Cuerpo de tarjeta -->
    <div class="card-body">

      <!-- Título del paquete -->
      <h5 class="card-title titulo-card">
        Bautizo - Paquete dreamy
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Aprovecha este gran evento al máximo  disfrutando de todo lo que te ofrece el paquete dreamy: 
        <ul>
          <li>
            Todo lo incluido en el paquete standard 
          </li>
          <li>
            Apoyo de colaboradores que le ayudaran en la gestión y planificación del evento.
          </li>
          <li>
            Sonorización y traducción simultánea de la ceremonia si es necesario
          </li>
          <li>
            Detalle para los padres y los padrinos.
          </li>
        </ul>
        
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de paquete -->
  </div>
  <!-- Cierre de segunda tarjeta tipo boda -->

  <!-- Tercera tarjeta tipo bñoda -->
  <div class="card" style="width: 40%">
    
    <!-- Imagen tarjeta -->-+
    <img style="object-position:bottom;" src={{asset('img/eventos/bauti3.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de la tarjeta -->
    <div class="card-body">

      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Bautizo - Paquete perfect
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Haz que tu pequeño viva esta experiencia al máximo con nuestro paquete perfect: 
        <ul>
          <li>
            Todo lo incluido en los paquetes standard y dreamy
          </li>
          <li>
            Acceso Vip a todas las actividades infantiles del resort
          </li>
          <li>
            Detalle de bienvenida con selección de dulces artesanales
          </li>
          <li>
            Hospedaje una noche todo incluido  (bautizado y padres)
          </li>
          <li>
            Banquete especial 
          </li>
        </ul>
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de tarjeta -->
  </div>
  <!-- Cierre tercera tarjeta tipo boda -->

</div>
<!-- Cierre grupo de tarjetas tipo boda -->

<hr>

<!-- Título grupo de eventos -->
<h2 class="text-center my-4" style=" text-shadow: #2499c7 0 6px 1rem;">
  Corporativo/Social 
</h2>

<hr> 


<!-- Grupo de tarjetas tipo boda -->
<div class="d-flex justify-content-around container-eventos m-4">

  <!-- Primera tarjeta de evento tipo boda -->
  <div class="card" style="width: 40%;">

    <!-- Imagen de tarjeta -->
    <img style="object-position: 50% 25%;" src={{asset('img/eventos/corp1.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de tarjeta -->
    <div class="card-body">
      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Corporativo - Paquete standard
      </h5>

      <!-- Descripción del paquete --> 
      <p class="card-text">
        Realiza una reunión satisfactoria con el paquete standard :
        <ul>
          
          <li>
            Decoración en la sala. 
          </li>
          <li>
            Champán por mesa 
          </li>
          <li>
            Arreglo de mesa con flores tropicales.
          </li>
          <li>
            Buffet Variado
          </li>
          
        </ul>

      </p>
      <!-- Cierre descripción del paquete -->
      
      <!-- Botón de reserva del paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>
      
    </div>
    <!-- Cierre de contenido de tarjeta -->
  </div>
  <!-- Cierre de primera tarjeta tipo boda -->

  <!-- Segunda tarjeta tipo boda -->
  <div class="card" style="width: 40%">

    <!-- Imagen tarjeta -->
    <img src={{asset('img/eventos/corp2.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Cuerpo de tarjeta -->
    <div class="card-body">

      <!-- Título del paquete -->
      <h5 class="card-title titulo-card">
        Corporativo- Paquete dreamy
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Realiza una reunión satisfactoria con el paquete Dreamy:
        <ul>
          <li>
            Todo lo incluido en el paquete standard 
          </li>
          <li>
            2 suites por una noche
          </li>
          <li>
            Musica en vivo
          </li>
        </ul>
        
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de paquete -->
  </div>
  <!-- Cierre de segunda tarjeta tipo boda -->

  <!-- Tercera tarjeta tipo boda -->
  <div class="card" style="width: 40%">
    
    <!-- Imagen tarjeta -->
    <img style="object-position:bottom;" src={{asset('img/eventos/corp3.jpg')}} class="card-img-top eventos" alt="...">

    <!-- Contenido de la tarjeta -->
    <div class="card-body">

      <!-- Título de paquete -->
      <h5 class="card-title titulo-card">
        Corporativo - Paquete perfect
      </h5>

      <!-- Descripción de paquete -->
      <p class="card-text">Realiza una reunión satisfactoria con el paquete Perfect:
        <ul>
          <li>
            TODO lo incluido en los paquetes standard y dreamy
          </li>
          <li>
            Acceso ilimitado  a todos los espacios comunes
          </li>
          <li>
            Detalle de bienvenida con selección de dulces artesanales
          </li>
          <li>
            Pulsera especial para los invitados con acceso exclusivo a todos los resorts
          </li>
        </ul>
      </p>
      <!-- Cierre descripción de paquete -->

      <!-- Botón de reserva de paquete -->
      <a href="{{route('login')}}" class="btn btn-primary">¡Has tu reserva!</a>

    </div>
    <!-- Cierre contenido de tarjeta -->
  </div>
  <!-- Cierre tercera tarjeta tipo boda -->

</div>
<!-- Cierre grupo de tarjetas tipo boda -->

@endsection

