<!-- 
  Plantilla de vistas de autenticación 
  Tales como inicios de sesión y registro
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

    <!--Importacion de Bootstrap a traves de Vite-->
    @vite([
      'resources/css/bootstrap.min.css',
      'resources/js/bootstrap.bundle.min.js'
    ])

    <!--Importacion manual de la hoja de estilos propia del proyecto-->
    <link rel="stylesheet" href="{{asset("addons/css/app.css")}}">

    <link rel="shortcut icon" href="{{asset('img/others/icon.png')}}" type="image/x-icon">

  </head>

  <body @yield("custom_attributes",'')>
    
    <!-- Incorporación componente de cabecera -->
    <x-headboard_home link="{{route('index')}}"> 
      <!-- Definiendo botón dentro de la cabecera -->
      <a class="btn btn-light" href="{{route('index')}}">Regresar</a> 

    </x-headboard_home>
    <!-- Cierre incorporación componente de cabecera -->

    <!-- Definiendo espacio en plantilla para incorporación de contenido principal -->
    @yield("content")

  </body>
</html>
