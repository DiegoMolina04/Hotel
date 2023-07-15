{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','Habitaciones')

{{-- Contenido principal --}}
@section('content')

<!-- Contenedor tarjetas de habitaciones -->
<div class="container mt-4">
  <div class="row">
    <!--Habitacion individual-->
    <div class="card mb-3" style="max-width: col-12">
      <div class="row g-0">
        <div class="col-md-5">
          <img
            src="./img/productos/habitacion_individual.jpg"
            class="img-fluid rounded-start"
            alt="..."
          />
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title mt-0">
              <b>HABITACIÓN INDIVIDUAL:</b>
            </h5>
        <p class="card-text">
          Esta habitación está pensada específicamente para aquellos que
          vengan de paso y no quieran gastan mucho en lujos, solo en lo
          necesario, por lo cual aquí en <b>Dream Scape</b> consideramos que
          tu habitación debería tener las siguientes características:
        </p>
        <ul>
          <li>Cama estandar individual</li>
          <li>Televisor con pantalla plana de 45 pulgadas</li>
          <li>Conexion a internet (Wifi)</li>
          <li>Baño privado</li>
          <li>Closet pequeño</li>
          <li>Recomendado para viajeros solitarios</li>
        </ul>
        <button
        class="btn buttons"
        data-bs-toggle="modal"
        data-bs-target="#reserveModal"
        onclick="changeRoomSelect(1)">
            ¡Reserve Ahora!
        </button>
          </div>
        </div>
      </div>
    </div>
    <!--Habitacion doble-->
    <div class="card mb-3" style="max-width: col-12">
      <div class="row g-0">
        <div class="col-md-5">
          <img
            src="./img/productos/habitacion_doble.jpg"
            class="img-fluid rounded-start"
            alt="..."
          />
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title mt-0"><b>HABITACION DOBLE:</b></h5>
        <p class="card-text">
          Esta habitación está pensada específicamente para aquellos que
          vengan de paso y no quieran gastan mucho en lujos, solo en lo
          necesario, por lo cual aquí en <b>Dream Scape</b> consideramos que
          tu habitación debería tener las siguientes características:
        </p>
        <ul>
          <li>Cama estandar individual</li>
          <li>Televisor con pantalla plana de 45 pulgadas</li>
          <li>Conexion a internet (Wifi)</li>
          <li>Baño privado</li>
          <li>Closet pequeño</li>
          <li>Recomendado para viajeros solitarios</li>
        </ul>
        <button
        class="btn buttons"
        data-bs-toggle="modal"
        data-bs-target="#reserveModal"
        onclick="changeRoomSelect(2)">
            ¡Reserve Ahora!
        </button>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!--Habitacion doble twin-->
    <div class="card mb-3" style="max-widthcol-12">
      <div class="row g-0">
        <div class="col-md-5">
          <img
            src="./img/productos/habitacion_doble_twin.jpg"
            class="img-fluid rounded-start"
            alt="..."
          />
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title mt-0"><b>HABITACION DOBLE TWIN</b></h5>
            <p class="card-text">
              ¿Viajas con tu amig@ y no quieres compartir cama?, pues
              inmediatamanete debes escoger esta habitacion ya que te permite
              tener todas las comodidades de una habitacion doble normal, pero
              te da la independencia y el espacio que necesites. Caractieristicas:
            </p>
            <ul>
              <li>2 Camas individuales</li>
              <li>Televisor con pantalla plana de 45 pulgadas</li>
              <li>Conexion a internet (Wifi)</li>
              <li>Baño privado</li>
              <li>Closet grande</li>
              <li>Aire acondicionado</li>
            </ul>
            <button
              class="btn buttons"
              data-bs-toggle="modal"
              data-bs-target="#reserveModal"
              onclick="changeRoomSelect(3)">
            ¡Reserve Ahora!
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--Habitacion empresarial-->
    <div class="card mb-3" style="max-width: col-12">
      <div class="row g-0">
        <div class="col-md-5">
          <img
            src="./img/Habitaciones/Habitación empresarial/Habitación empresarial.jpg"
            class="img-fluid rounded-start"
            alt="..."
          />
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title mt-0"><b>HABITACIÓN EMPRESARIAL</b></h5>
            <p class="card-text">
              Si viniste a la costa por trabajo y quieres estar comodo y
              tranquilo, esta habitacion es para ti ya que podemos ofrecerte las
              sigueintes caractertisticas y servicios:
            </p>
            <ul>
              <li>Cama semidoble</li>
              <li>Televisor con pantalla plana de 45 pulgadas</li>
              <li>Conexion a internet (Wifi/Ethernet)</li>
              <li>Escritorio de madera</li>
              <li>Silla de Escritorio</li>
              <li>Baño privado</li>
              <li>Mini Bar</li>
              <li>Closet mediano</li>
              <li>Aire acondicionado</li>
            </ul>
            <button
              class="btn buttons"
              data-bs-toggle="modal"
              data-bs-target="#reserveModal"
              onclick="changeRoomSelect(4)">
            ¡Reserve Ahora!
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--Habitacion matrimonial-->
    <div class="card mb-3" style="max-width: col-12">
      <div class="row g-0">
        <div class="col-md-5">
          <img
            src="./img/productos/habitacion_matrimonial.jpg"
            class="img-fluid rounded-start"
            alt="..."
          />
        </div>
        <div class="col-md-7">
          <div class="card-body">
            <h5 class="card-title mt-0"><b>HABITACIÓN MATRIMONIAL</b></h5>
            <p class="card-text">
              Esta habitación es perfecta para aquellas parejas que deseen pasar
              su luna de miel o incluso compartir tiempo en familia con sus
              hijos, por lo cual te podemos ofrecer las siguientes
              características:
            </p>
            <ul>
              <li>Cama GrandKing</li>
              <li>Televisor con pantalla plana de 50 pulgadas</li>
              <li>Conexion a internet (Wifi)</li>
              <li>Baño privado</li>
              <li>Closet grande</li>
              <li>Aire acondicionado</li>
              <li>Mini Bar</li>
            </ul>
            <button
              class="btn buttons"
              data-bs-toggle="modal"
              data-bs-target="#reserveModal"
              onclick="changeRoomSelect(5)">
            ¡Reserve Ahora!
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection