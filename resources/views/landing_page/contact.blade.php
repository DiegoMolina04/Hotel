{{-- Extendiendo plantilla de landing page--}}
@extends('layouts.landing_page')

{{-- Completando titulo con sección partada en plantilla --}}
@section('title','contactanos')


{{-- Contenido principal --}}
@section('content')

  <!-- Contenedor principal -->
    <div style="min-height:60vh;" class="container mt-4">

      <!-- Titulo contenedor -->
      <h3>Dejanos tus comentarios</h3>

      <!-- Formulario -->
      <form action="">
        
        <div class="form-group">
          <label for="nombre"><p>Nombre</p></label>
          <input
            type="text"
            name="nombre"
            id="nombre"
            placeholder="Escribe tu nombre"
            class="form-control"
            maxlength="60"
            required
          />
        </div>

        <br>

        <div class="form-group">
          <label for="email"> <p>correo</p></label>
          <input
            class="form-control"
            type="email"
            name="email"
            id="email"
            placeholder="Escribe tu correo"
            required
          />
        </div>
        
        <br>

        <div class="form-group">
          <label for="comentario">Comentario</label>
          <textarea
            class="form-control"
            id="comentario"
            rows="3"
            placeholder="Escribe tu duda o inquietud"
            style="resize: none"
            maxlength="150"
          ></textarea>
        </div>

        <br>

        <button type="submit" class="btn btn-light buttons">Enviar</button>

      </form>
      <!-- Cierre formulario -->
    </div>
    <!-- Cierre contenedor  -->


@endsection