<!-- Plantilla de dashboard -->
<!DOCTYPE html>
<html lang="es">
    <head>

        <!-- Metadatos -->
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- Título y espacio para personalizar el título -->
        <title>DreamScape | @yield("title")</title>

        <!--Importacion de Bootstrap a traves de Vite-->
        @vite([
            'resources/css/bootstrap.min.css',
            'resources/js/bootstrap.bundle.min.js'
        ])

        <!-- Estilos e incorporación de bootstrap -->
        <link rel="stylesheet" href="{{asset("addons/css/app.css")}}">

        <link rel="shortcut icon" href="{{asset('img/others/icon.png')}}" type="image/x-icon">
    </head>

    <body>
        <!-- Utilizando componente de cabecera (plantilla 2, para dashboard) -->
        <x-headboard_home_2 href="{{route('redirect')}}">
            <!-- Contenido en cabecera -->

            <!-- Contenedor elemento de perfil -->
            <div class="fs-5">
                <!-- Contenedor de imagen y menú-->
                <div class="fotoPerfil">

                    <!-- Contenedor de imagen de perfil -->
                    <a href="#">

                        {{-- Verificando si el usuario tiene foto de perfil --}}
                        @if(isset($user->url_photo))

                            {{-- Si el usuario tiene imagen se obtiene y despliega esa--}}
                            <img width="100" height="100" style="object-fit: cover; border-radius: 30%;" 
                            src="storage/userPhotos/{{$user->url_photo}}" alt="Foto de {{$user->name}}" >
                        @else

                            {{-- De otra manera se despliega un svg por default--}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        @endif
                    </a>
                    <!-- Cierre contenedor de imagen de perfil -->

                    <!-- Menú de opciones de usuario -->
                    <ul class="menuPerfil">
                        <a>
                            <li>Ver perfil</li>
                        </a>
                        <form action="{{route("logout")}}" method="post">
                            @csrf
                            <button 
                                class="btn btn-danger"
                                type="submit"
                            >
                                Cerrar sesión
                            </button>
                        </form>
                    </ul>
                    <!-- Cierre menú de opciones de usuario -->
                </div>
                <!-- Cierre contenedor imagen y menu -->
            </div>
            <!-- Contenedor elemento de perfil -->
        </x-cabecera>
        <!-- Cierre componente cabecera -->

        <!-- Menú horizontal (versión para pantallas moviles) -->
        <div class="container-fluid bg-light d-block d-lg-none" id="despliegueMenu" style="color:white; text-align: center; cursor:pointer;">
            <ul class="nav justify-content-center">
                
                {{-- 
                    Se empleara la directira @role() para validar si el usuario autenticado cumple con el rol deseado.

                    Este proceso se repetira por cada uno de los roles registrados en el sistema, en cuando haya concordancia, importara su menu de navegacion correspondiente.

                    Asi mismo, se le enviara que el item de la barra de navegacion que debe marcarse como activo
                --}}
                @role('cliente')
                    @include('components.client_menu', ['itemActive'=>View::getSection('itemActive')])
                @endrole

                @role('recepcionista')
                    Menu Rol recepcionista
                @endrole

                @role('servicio_cliente')
                    Menu Rol trabajador servicio al cliente     
                @endrole

                @role('coordinador_inventario')
                    Menu Rol coordinador invenatario
                @endrole

                @role('coordinador_eventos')
                    Menu Rol coordinador eventos
                @endrole

                @role('superadmin')
                    Menu Rol superadmin
                @endrole
            </ul>
        </div>
        <!-- Cierre menú horizontal -->

        <!-- Contenedor de contenido principal y menú vertical-->
        <div class="row container-fluid">

            <!-- Menú vertical (Versión pantallas desde lg) -->
            <div class="d-flex flex-column p-3 col-3 d-none d-lg-flex " style="min-height: 70vh;">

                <!-- Titulo de sección -->
                <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <span class="fs-4">Opciones</span>
                </a>

                <hr>

                <!-- Lista de opciones de menú -->
                <ul class="nav nav-pills flex-column mb-auto">

                    {{-- 
                        Se empleara la directira @role() para validar si el usuario autenticado cumple con el rol deseado.

                        Este proceso se repetira por cada uno de los roles registrados en el sistema, en cuando haya concordancia, importara su menu de navegacion correspondiente.

                        Asi mismo, se le enviara que el item de la barra de navegacion que debe marcarse como activo
                    --}}
                    @role('cliente')
                        @include('components.client_menu', ['itemActive'=>View::getSection('itemActive')])
                    @endrole

                    @role('recepcionista')
                        Menu Rol recepcionista
                    @endrole

                    @role('servicio_cliente')
                        Menu Rol trabajador servicio al cliente     
                    @endrole

                    @role('coordinador_inventario')
                        Menu Rol coordinador invenatario
                    @endrole

                    @role('coordinador_eventos')
                        Menu Rol coordinador eventos
                    @endrole

                    @role('superadmin')
                        Menu Rol superadmin
                    @endrole

                </ul>

                <hr>

                <!-- Pie de menú, nombre e imagen de usuario -->
                <div class="px-4 fs-5">
                    {{-- Verificando si el usuario tiene foto de perfil --}}
                    @if(isset($user->url_photo))

                        {{-- Usamos foto de perfil del usuario --}}
                        <img width="40" height="40" style="object-fit: cover; border-radius: 30%;" 
                        src="storage/userPhotos/{{$user->url_photo}}" alt="Foto de {{$user->name}}" >
                    @else

                        {{-- Caso contrario svg por default --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    @endif
                    
                    <!-- Nombre de usuario -->
                    {{ Auth::user()->nombre }}
                </div>
                <!-- Cierre de imagen y nombre de usuario -->
            </div>
            <!-- Cierre de menú vertical -->

            <!-- Sección de contenido principal -->
            <div class="col-12 col-lg-9 mt-4">
                <!--Espació para insertar contenido de acuerdo a vista -->
                @yield('content')
            </div>
            
        </div>
        
        <!-- Incluyendo pie de página  y scripts -->
        @include('components.footer_2')

        @yield('scripts')
    </body>
</html>