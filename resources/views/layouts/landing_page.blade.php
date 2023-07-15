<!-- 
  Plantilla para vistas de landing page
  Vistas que se pueden ver sin haber iniciado sesión
-->
<!DOCTYPE html>
<html lang="es">
  <head>
    
    <!-- Metadatos -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Título y espacio para personalizar el título -->
    <title>DreamScape | @yield("title") </title>

    <!-- Estilos e incorporación de bootstrap -->
    @vite([
      'resources/css/bootstrap.min.css',
      'resources/js/bootstrap.bundle.min.js'
    ])

    <link rel="stylesheet" href="{{asset("addons/css/app.css")}}">

    <link rel="shortcut icon" href="{{asset('img/others/icon.png')}}" type="image/x-icon">

  </head>
  <body @yield("custom_attributes",'')>

    <!-- Añadiendo componente de cabecera -->
    <x-headboard_home_2 href="{{ route('index') }}">
      @auth
        <a class="btn btn-lg btn-light" href="{{route("redirect")}}" role="button">Dashboard</a>  
      @endauth

      @guest
        {{-- Añadiendo botón de inicio de sesión en caso de que el usuario no haya iniciado sesión ---}}
        <a class="btn btn-lg btn-light" href="{{route("viewLogin")}}" role="button">Iniciar Sesion</a>
      @endguest

    </x-headboard_home_2>
    <!-- Cierre componente de cabecera -->

    <!-- Nav Links -->
    <ul class="nav justify-content-center nav-links ul-link-nav">
      <li class="nav-item">
        <a href={{route("sobrenos")}}>Sobre nosotros</a>
      </li>
      <li class="nav-item">
        <a href={{route("rooms")}} >Habitaciones</a>
      </li>
      <li class="nav-item">
        <a href={{route("eventos")}}>Eventos</a>
      </li>
      <li class="nav-item">
        <button type="button" style="background-color:#19875400; color:white; border:none;" data-bs-toggle="modal" data-bs-target="#mapa">
          Ubicanos 
        </button>
      </li>
      <li class="nav-item">
        <a href={{route("contactanos")}}>Contacto</a>
      </li>
      
    </ul>
    <!-- Cierre links de navegación-->

    <!--Contenido Principal-->
    @yield("content")

    <!--Incluir Modal Mapa-->
    @include("components.modales.mapa")

    <!-- Footer -->
    @include("components.footer_2")

  </body>
</html>