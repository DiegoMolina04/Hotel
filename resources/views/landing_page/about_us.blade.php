{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Nosotros')

{{-- Contenido principal --}}
@section('content')
  <!--Contenedor de tarjetas con información -->
    <div class="container mt-4">
      <div class="row">

        <!-- Primera tarjeta "Sobre nosotros" -->
        <div class="card mb-3" style="max-width: col-12">
          <div class="row g-0">
            <!-- Imagen de tarjeta -->
            <div class="col-md-6">
              <img
                src="./img/carrusel/ext2.jpg"
                class="img-fluid rounded-start"
                alt="Carrousel Fotos"
              />
            </div>
            <!-- Fin imagen de tarjeta -->

            <!-- Espacio de tarjeta de titulo y contenido -->
            <div class="col-md-6">
              <div class="card-body">
                <!-- Titulo tarjeta -->
                <h5 class="card-title mt-0">
                  <b>SOBRE NOSOTROS</b>
                </h5>
                <!-- Cierre titulo de tarjeta -->

                <!-- Texto o contenido de tarjeta -->
                <p class="card-text">
                  Dream Scape es un lujoso hotel ubicado en Santa Marta
                  Colombia, ofrecemos diferentes tipos de habitaciones para que
                  el huésped pueda escoger la opción ideal, el huésped también
                  dispone de lugares comunes: Una terraza en donde puede
                  disfrutar del sol y la brisa y un restaurante bar bastante
                  completo para que aproveche de la mejor comida sin salir del
                  hotel.
                </p>
                <!-- Cierre de contenido de tarjeta -->
              </div>
            </div>
            <!-- Espacio de tarjeta de titulo y contenido -->
          </div>
        </div>
        <!-- Cierre primera tarjeta -->
        <!-- Segunda tarjeta "misión" -->
        <div class="card mb-3" style="max-width: col-12">
          <div class="row g-0">

            <!-- Imagen de tarjeta -->
            <div class="col-md-2">
              <img
                src="./img/MisionVision/mision.jpg"
                class="img-fluid rounded-start"
                alt="Mision Hotel"
                height="170px"
                width="190px"
              />
            </div>
            <!-- Cierre de imagen de tarjeta -->
            
            <!-- Espacio de tarjeta de titulo y contenido -->
            <div class="col-md-10">
              <div class="card-body">

                <!-- Titulo de tarjeta -->
                <h5 class="card-title mt-0">
                  <b>MISIÓN</b>
                </h5>
                <!-- Cierre titulo de tarjeta -->

                <!-- Contenido de tarjeta -->
                <p class="card-text">
                  Cuidamos a nuestros clientes como a familiares o amigos y lo
                  hacemos de este modo porque así lo sentimos, porque viajar y
                  conocer una ciudad implica también conocer a quién vive en
                  ella y nosotros somos una de las partes más importantes que
                  hacen que su experiencia en Santa Marta sea lo más auténtica
                  posible. Este es su hogar. Queremos que tenga todas las
                  comodidades posibles.
                </p>
                <!-- Cierre contenido de tarjeta -->
              </div>
            </div>
            <!-- Cierre espacio de tarjeta de titulo y contenido -->
          </div>
        </div>

        <!-- Tercera tarjeta "Visión" -->
        <div class="card mb-3" style="max-width: col-12">
          <div class="row g-0">

            <!-- Imagen de tarjeta -->
            <div class="col-md-2">
              <img
                src="./img/MisionVision/vision.jpg"
                class="img-fluid rounded-start"
                alt="Vision Hotel"
                height="170px"
                width="190px"
              />
            </div>
            <!-- Cierre imagen tarjeta -->

            <!-- Titulo y contenido tarjeta -->
            <div class="col-md-10">
              <div class="card-body">

                <!-- Titulo tarjeta -->
                <h5 class="card-title mt-0">
                  <b>VISIÓN</b>
                </h5>
                <!-- Cierre titulo tarjeta -->

                <!-- Contenido de la tarjeta -->
                <p class="card-text">
                  Cuidamos a nuestros clientes como a familiares o amigos y lo
                  hacemos de este modo porque así lo sentimos, porque viajar y
                  conocer una ciudad implica también conocer a quién vive en
                  ella y nosotros somos una de las partes más importantes que
                  hacen que su experiencia en Santa Marta sea lo más auténtica
                  posible. Este es su hogar. Queremos que tenga todas las
                  comodidades posibles.
                </p>
                <!-- Cierre contenido de la tarjeta -->
              </div>
            </div>
          </div>
        </div>
        <!-- Cierre titulo y contenido tarjeta -->
      </div>
    </div>
    <!-- cierre de contenedor de tarjetas-->

@endsection