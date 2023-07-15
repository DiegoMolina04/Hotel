<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\authCustom;
use App\Http\Controllers\registroPersonalizado;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* Especificacion de vistas de login y registro*/

            //Redireccion Sencilla hacia la vista de login
            Fortify::loginView(function(){
                return redirect()->route("viewLogin");
            });

            /*
                Redireccion personalizada hacia la vista de registro empleando un controlador externo el cual sera el encargado de realizar las consultas correspondientes a la BD y enviandole esos datos al registro
            */
            Fortify::registerView(function () {

                //Ruta de acceso a controlador intermedio
                return redirect()->route("viewRegister");
            });
        //

        //Redireccion del controlador de cracion de usuarios por defecto a controlador personalizado
        Fortify::createUsersUsing(authCustom::class);

        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
