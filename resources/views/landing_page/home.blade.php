{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Home')

{{-- Contenido principal --}}
@section('content')
   <!-- Contenedor de carrusel -->
   <div class="container-lg mt-md-4">
      <div class="col-md-12 col-sm-12 p-3">
        <!-- Carrusel -->
        <div
          id="carouselExampleControls"
          class="carousel slide"
          data-bs-ride="carousel"
        >
        <!-- Elementos del carrusel -->
          <div class="carousel-inner">
            <!-- Primer item -->
            <div class="carousel-item active">
              <img
                src="./img/carrusel/ext1.jpg"
                height="500px"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre primer item -->

            <!-- Segundo item -->
            <div class="carousel-item">
              <img
                height="500px"
                src="./img/carrusel/ext2.jpg"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre segundo item -->

            <!-- Tercer item -->
            <div class="carousel-item">
              <img
                src="./img/carrusel/food.jpg"
                height="500px"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre tercer item -->

            <!-- Cuarto item -->
            <div class="carousel-item">
              <img
                src="./img/carrusel/restaurant.jpg"
                height="500px"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre cuarto item -->

            <!-- Quinto item -->
            <div class="carousel-item">
              <img
                src="./img/carrusel/ext3.jpg"
                height="500px"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre quinto item -->

            <!-- Sexto item -->
            <div class="carousel-item">
              <img
                src="./img/carrusel/ext4.jpg"
                height="500px"
                class="d-block w-100"
                alt="..."
              />
            </div>
            <!-- Cierre sexto item -->
            
          </div>
          <!-- Cierre elementos de carrusel -->

          <!-- Botón de item previo -->
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleControls"
            data-bs-slide="prev"
          >
            <span
              class="carousel-control-prev-icon"
              aria-hidden="true"
            ></span>
            <!-- Mensaje botón -->
            <span class="visually-hidden">Antes</span>
          </button>
          <!-- Cierre botón item previo -->

          <!-- Botón siguiente item -->
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleControls"
            data-bs-slide="next"
          >
            <span
              class="carousel-control-next-icon"
              aria-hidden="true"
            ></span>
            <span class="visually-hidden">Después</span>
          </button>
          <!-- Cierre siguiente botón -->
        </div>
        <!-- Cierre carrusel -->
      </div>
    </div>
    <!-- Cierre contenedores de carrusel -->

    <!-- Contenedor contenido principal -->
    <div class="container mt-4">

    <!-- Título sección -->
      <div class="col-12 mt-4 row">
        <!-- Separador decorativo -->
        <div class="col-lg-5 col-4">
          <hr>
        </div>

        <!-- Título -->
        <div class="col-lg-2 col-4">
          <h1 style="text-align:center;"> Habitaciones</h1>
        </div>

        <!-- Separador decoreativo -->
        <div class="col-lg-5 col-4">
          <hr>
        </div>

      </div>
      <!-- Cierre título sección -->

      <!-- Contenedor de tarjetas sección-->
      <div class="row">

        <!-- Contenedor tarjeta -->
        <div class="col-lg-6 col-md-6 col-sm-12 p-3">

          <!-- Tarjeta con sombra -->
          <div class="card shadow-card">

            <!-- Imagen de tarjeta -->
            <img
              height="330px"
              src="./img/Habitaciones/Habitación matrimonial/mejor.jpg"
              class="card-img-top"
              alt="matrimonial"
            />

            <!-- Contenido principal tarjeta -->
            <div class="card-body">

              <!-- Título habitación -->
              <h5 class="card-title">
                HABITACIÓN MATRIMONIAL
              </h5>

              <!-- Descripción habitación -->
              <p class="card-text">
                Esta es la habitación más grande de todas, ya que tiene un
                tamaño de 32 metros cuadrados, recomendada para familias de tres
                (3) o cuatro (4) integrantes
              </p>

              <!-- Botón de reserva -->
              <button
                class="btn buttons"
                data-bs-toggle="modal"
                data-bs-target="#reserveModal"
                onclick="changeRoomSelect(5)"
              >
                !Reserve ahora!
              </button>
              <!-- Cierre de reserva -->

              <!-- Precio habitación -->
              <span style="color: #198754">Por solo $350.000</span>

            </div>
            <!-- Cierre contenido principal tarjeta -->
            
          </div>
          <!-- Cierre tarjeta -->

        </div>
        <!-- Cierre contentenedor tarjeta -->


        <!-- Contenedor segunda tarjeta -->
        <div class="col-lg-6 col-md-6 col-sm-12 p-3">

          <!-- Tarjeta con sombra -->
          <div class="card shadow-card">

            <!-- Imagen tarjeta -->
            <img
              height="330px"
              src="./img/Habitaciones/Habitación empresarial/Habitación empresarial.jpg"
              class="card-img-top"
              alt="empresarial"
            />

            <!-- Contenido principal tarjeta -->
            <div class="card-body">+
              
              <!-- Título habitación -->
              <h5 class="card-title">
                HABITACIÓN EMPRESARIAL
              </h5>

              <!-- Descripción habitación -->
              <p class="card-text">
                Esta habitación es muy amplia, ya que cuenta con 25 metros
                cuadrados. Recomendado para una (1) persona que necesite un
                lugar tranquilo y agradable para descansar y trabajar .
              </p>
              <!-- Cierre descripción de habitación -->

              <!-- Botón de reserva -->
              <button
                class="btn buttons"
                data-bs-toggle="modal"
                data-bs-target="#reserveModal"
                onclick="changeRoomSelect(4)"
              >
                !Reserve ahora!
              </button>
              <!-- Cierre botón de reserva -->

              <!-- Precio habitación -->
              <span style="color: #198754">Por solo $300.000</span>

            </div>
            <!-- Cierre contenido principal -->

          </div>
          <!-- Cierre tarjeta -->

        </div>
        <!-- Cierre contenedor tarjeta -->

      </div>
      <!-- Cierre contenedor de tarjetas sección -->

      <!-- Botón "Ver todas las habitaciones" -->
      <div class="col-12 mt-4 row">

        <!-- Separador decorativo -->
        <div class="col-4">
          <hr>
        </div>

        <!-- Botón ver todas las habitaciones -->
        <div class="col-4">
          <button class="btn btn-outline-dark col-12" id="button-link-rooms">
            <a href={{route("rooms")}} id="link-rooms">
              Ver todas las habitaciones
            </a>
          </button>
        </div>
        <!-- Cierre botón -->

        <!-- Separador decorativo -->
        <div class="col-4">
          <hr>
        </div>

      </div>
      <!-- Cierre título sección -->

      <!-- Segunda sección -->
      <div class="col-12 mt-4">

        <!-- Contenedor de elementos -->
        <div class="row">

          <!-- Tarjeta de información -->
          <div class="card mb-3" style="max-width: col-12">
            <div class="row g-0">

              <!-- Contenedor carrusel -->
              <div class="col-md-5">

                  <!-- Carrusel -->
                  <div
                    id="carouselservicios"
                    class="carousel slide"
                    data-bs-ride="carousel"
                  >
                  <!-- Elementos carrusel -->
                    <div class="carousel-inner">

                      <!-- Primer elemento -->
                      <div class="carousel-item active">
                        <img
                          src="./img/carru_serv/gimnasio.jpg"
                          height="500px"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre primer elemento -->

                      <!-- Segundo elemento -->
                      <div class="carousel-item">
                        <img
                          height="500px"
                          src="./img/carru_serv/bar.webp"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre segundo elemento -->

                      <!-- Tercer elemento -->
                      <div class="carousel-item">
                        <img
                          src="./img/carrusel/food.jpg"
                          height="500px"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre tercer elemento -->

                      <!-- Cuarto elemento -->
                      <div class="carousel-item">
                        <img
                          src="./img/carrusel/restaurant.jpg"
                          height="500px"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre cuarto elemento -->
          
                      <!-- Quinto elemento -->
                      <div class="carousel-item">
                        <img
                          src="./img/carrusel/ext3.jpg"
                          height="500px"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre quinto elemento -->

                      <!-- Sexto elemento -->          
                      <div class="carousel-item">
                        <img
                          src="./img/carrusel/ext4.jpg"
                          height="500px"
                          class="d-block w-100"
                          alt="..."
                        />
                      </div>
                      <!-- Cierre sexto elemento -->
                      
                    </div>
                    <!-- Cierre elementos carrusel -->

                    <!-- Botón elemento previo -->
                    <button
                      class="carousel-control-prev"
                      type="button"
                      data-bs-target="#carouselservicios"
                      data-bs-slide="prev"
                    >
                      <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                      ></span>
                      <span class="visually-hidden">Antes</span>
                    </button>
                    <!-- Cierre botón elemento previo -->

                    <!-- Botón siguiente elemento -->
                    <button
                      class="carousel-control-next"
                      type="button"
                      data-bs-target="#carouselservicios"
                      data-bs-slide="next"
                    >
                      <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                      ></span>
                      <span class="visually-hidden">Después</span>
                    </button>
                    <!-- Cierre botón siguiente elemento -->
                  </div>
                  <!-- Cierre carrusel -->

                </div>
                <!-- Cierre contendor carrusel -->

              <!-- Contenedor contenido de tarjeta -->
              <div class="col-md-7">
                <!-- Cuerpo de tarjeta -->
                <div class="card-body">

                  <!-- Título tarjeta -->
                  <h5 class="card-title mt-0">
                    <b>SERVICIOS QUE OFRECEMOS</b>
                  </h5>
                  <!-- Cierre titulo tarjeta -->

                  <!-- Contenido de tarjeta -->

                  <!-- Texto introductivo -->
                  <p class="card-text">
                    Si quiere disfrutar de unas vacaciones activas y divertidas, Dream Scape le ofrece ocio, 
                    diversión y la posibilidad de practicar sus deportes favoritos. Disfrute de los mejores shows nocturnos, 
                    actividades acuáticas, deportes y vida nocturna, entre miles de planes a su disposición.
                  </p>

                  <!-- Lita de actividades ofrecidas -->
                  <ul>
                    <li> Actividades diurnas </li>
                    <li> Entretenimiento nocturno con shows en directo en los diferentes bares y zonas comunes</li>
                    <li> Club infantil</li>
                    <li> Actividades y excursiones guiadas (con coste extra – ofrecidas por agencias externas)</li>
                    <li> Amplio gimnasio con una completa variedad de maquinaria fitness y musculación</li>
                    <li> Pistas de tenis</li>
                    <li> Cancha de pickleball, con clases gratuitas en grupo y clases privadas ($) disponibles</li>
                    <li> Green Fees</li>
                    <li> Sports Bar con proyección de partidos y eventos deportivos de nivel </li>
                    <li>Discoteca, abierta todos los días a partir de las 23h.</li>
                  </ul>

                  <!-- Cierre contenido tarjeta -->
             
                </div>
                <!-- Cierre cuerpo de tarjeta -->

              </div>
              <!-- Cierre contenedor contenido de tarjeta -->

            </div>
          </div>
          <!-- Cierre tarjeta de información -->

        </div>
        <!-- Cierre contenedor de elementos -->

      </div>
      <!-- Cierre segunda sección -->

    </div>
    <!-- Cierre contenedor contenido principal -->
@endsection