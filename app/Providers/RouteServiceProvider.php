<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            /*
                Nombre metodo: routes

                Funcion: Declarar los archivos usados para determinar las rutas del aplicativo, asi como sus respectivas caracteristicas

                Sintaxis:

                    Route::middelware('nombre_middleware_aplicar')
                        ->prefix('prefijo_navegador')
                        ->group(base_path('ruta/archiv/rutas.php));

                --

                Partes:

                    - nombre_middle_aplicar: Metodo de autenticacion admitido -> Web, API, etc.

                    - prefijo_navegador: Esta es una palabra que usaremos en la barra de navegacion para diferenciar cuando accedemos a un recursos desde uno u otro archivo principal de rutas

                        Ej: Imagina que en tu carpeta resources hay dos funcionalidades con el mismo nombre, pero que son usados para diferentes usuarios:

                            resources/client/reservations/index.blade.php
                            resources/admin/reservations/index.blade.php

                        En este caso lo que podriamos hacer es crear un archivo de rutas solo para nuestro usuario cliente y otro para el usuario administrador, sin embargo al momento de definir nuestras rutas, debemos añadir manualmente algun factor que diferiente las carpetas:

                            Route::get('clientes/reservaciones', function () {
                                return view("clientes.reservations.index.blade.php");
                            });

                            Route::get('administradores/reservaciones', function () {
                                return view("administradores.reservations.index.blade.php");
                            });

                        Este proceso deberias realizarlo cada vez que las rutas sean similares. Ante esa situacion lo mas recomendable es configurar un prefijo el cual, aunque no lo pongas directamente en tus rutas, Laravel te obligara a usarlos en la barra de navegación:

                            Rutas:

                                Route::get('/reservaciones', function () {
                                    return view("clientes.reservations.index.blade.php");
                                });

                            --

                            Navegador:
                                proyecto.com/prefijo/reservaciones
                            --

                        --
                    - 'ruta_archivo_rutas': Este corresponde al directorio donde se encuentra tu archivo de rutas perzonalidado, por convencion se suelen dejar al interior de la carpeta "Routes"
                --
            */
                        
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->prefix("clients")
                ->group(base_path('routes/clients.php'));

            Route::middleware('web')
                ->prefix("admin")
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
