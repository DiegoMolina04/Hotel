@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')






  <div class="container">
    <h1 class="text-center">Selección de Camas</h1>
    <br><br>

    
    <div class="text-center">
      <span class="color-label" style="background-color: rgb(255, 153, 0); padding:5px; border-radius:5px; border:solid 1px black">Clausurado</span>
      <span class="color-label" style="background-color: rgb(255, 0, 0);padding:5px; border-radius:5px;border:solid 1px black">Ocupada</span>
      <span class="color-label" style="background-color: rgb(182, 181, 179);padding:5px; border-radius:5px;border:solid 1px black">Libre</span>
      <span class="color-label" style="background-color: rgb(255, 251, 20);padding:5px; border-radius:5px;border:solid 1px black">mantenimiento</span>

    </div>
    <br>
    <br>

    <div class="row">

      <div class="col-md-4">
        <div class="screen">
          <p>Habitaciones sencillas</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones sencillas -->
          <?php
             $numeroHabitacion = 1;

           foreach ($datosIndividual as $habitacion) { ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>
        </div>
      </div>

      <div class="col-md-4">
        <div class="screen">
          <p>Habitaciones dobles</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones dobles -->
          <?php foreach ($datosDoble as $habitacion) {  ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>

        </div>
      </div>

      <div class="col-md-4">
        <div class="screen">
          <p>Habitaciones dobles twin</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones dobles twin -->
          <?php foreach ($datosDobleTwing as $habitacion) { ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span   class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>

        </div>
      </div>

      <div class="col-md-4">
        <div class="screen">
          <p>Habitaciones Ejecutivas</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones ejecutivas -->
          <?php  foreach ($datosEmpresarial as $habitacion) { ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>

        </div>
      </div>

      <div class="col-md-4">
        <div class="screen">
          <p>Habitaciones Matrimoniales</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones matrimoniales -->
          <?php foreach ($datosMatrimonial as $habitacion) { ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>

        </div>
      </div>

      <div class="col-md-4">
        <div class="screen">
          <p>Suits</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
          <!-- Habitaciones suits -->
          <?php foreach ($datosSuite as $habitacion) { ?>
            <div class="bed {{$habitacion->Estado }}" onclick="selectBed(this)" data-id="{{ $habitacion->id }} " data-tipo="{{ $habitacion->Tipo }}" data-estado="{{ $habitacion->Estado }}" ></div>
            <span class="room-number" style="font-size: 12px">{{ $numeroHabitacion }}</span>

            <?php 
                        $numeroHabitacion++;

          } ?>

        </div>
      </div>
      
    </div>
  </div>  
@endsection

@section('scripts')
<script>
  let selectedBed = null;

  function selectBed(bed) {
    if (selectedBed !== null) {
      selectedBed.classList.remove('selected');
    }

    if (selectedBed === bed) {
      selectedBed = null;
    } else {
      bed.classList.add('selected');
      selectedBed = bed;

      const bedId = bed.getAttribute('data-id');
      const bedTipo = bed.getAttribute('data-tipo');
      const bedEstado = bed.getAttribute('data-estado');

      const queryParams = new URLSearchParams({
        id: bedId,
        tipo: bedTipo,
        estado: bedEstado
      });

      window.location.href = 'data?' + queryParams.toString();
    }
  }
</script>
@endsection