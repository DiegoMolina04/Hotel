<?php

namespace App\Http\Requests;

use App\Models\tipo_habitacion;
use App\Models\User;

/*
    Nombre Paquete: Carbon

    ¿Que es?: Carbon es una biblioteca la cual parte de la clase DateTime presente en PHP de forma nativa, esta biblioteca facilita el manejo y modificacion de fechas ya que ofrence funcionalidades adicionales sobre la propia clase nativa de PHP, asi como ofrecer nombres de metodos mas sencillos e intititivos

    Beneficios: 

        1. Manipulacion de fechas: Carbon nos permite manipular mas facilmente las fechas, ya sea añadiendo o quitando unidades, las cuales pueden ir desde segundos,minutos,dias,meses,años,etc.

            1.1 addDays(n) -> añadir n dias

        --

        2. Formateo de fechas: Carbon nos permite formatear la fecha facilmente como mejor nos guste

            2.1 format('estilo-formateo') -> formatea la fecha segun el estilo que le indiquemos

        --

        3. Comparacion de Fechas: Esta represnta una de las funcionalidades mas usadas, ya que permie establecer vales minimos o maximos de las fechas ingresadas en los formularios de validación.

            3.1 greaterThan('fecha') ->  Validar si la fecha es mayor a otra
            3.2 lessThan('fecha') -> Validar si una fecha es menor a otra

        --

        4. Traduccion de fechas: Al permitir tranformar nuestras fechas en diferentes formatos (Entre esos textos), carbon nos permite definir que lenguaje se usara al momento de la transformacion

            4.1 setLocale('codigo_lenguaje') -> Cambiar el lenguaje antes de realizar la transformacion

        --

        5. Funcionalidades adicionales: 
            5.1 Capacidad de trabajar con multiples zonas horarias
            5.2 Obetener componentes especificos de una fecha (Dia,Mes,Año)
            5.3 Calculos entre fechas
            5.4 Diferencias entre zonas horarias
        --
    --

    Aclaración: Carbon no es una libreria relativamente nueva, lo que hace es reinventar los metodos de la libreria DateTime presente de forma nativa en PHP, facilitando su uso y añadiendo funciones

    Nota:

        Clase: Estructura base de POO, la cual permite crear objetos definiendo atributos, metodos, etc

        Libreria/Biblioteca: Una libreria o biblioteca es un conjunto de codigo predefinido y retilizable el cual agrupa tanto clase como funcionalidades y recursos de forma coherente, es decir, son un conjunto de herramientas para tareas concretas

    --

*/
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class reservationsValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Obtener la Informacion del usuario
        $usuario=User::find(Auth::user()->id);

        //Validar si este cuenta con el rol cliente, de ser asi se le permitira continuar con el proceso, en caso contrario se le enviara un eror 403
        return $usuario->hasRole('cliente');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fecha_ingreso' => [
                'required',
                'date',
                /*
                    $value = Valor ingresado en el formulario

                    $fail = Funcion de Cierre la cual se ejecuta en caso de que falle la validacion y retornara un mensaje de error (El mensaje es obligatorio)
                */
                function ($attribute,$value, $fail) {

                    //Definir el numero minimo de dias para realizar la reserva
                    $diasMinimos=1;

                    /*
                        Carbon::tomorrow() -> Crear una instancia de la libreria Carbon con la fecha y hora de este momento en 24 horas

                        startOfDay() -> Al obtener la fecha, pondra la hora en 00:00:00 

                        addDays(num_dias) -> Añadir dias a la fecha generada
                    */
                    $fechaMinima = Carbon::tomorrow()->startOfDay()->addDays($diasMinimos);
                    
                    /*
                        Carbon::parse -> Generar una instancia de la fecha y hora ingresada
                    */
                    $fechaIngresada = Carbon::parse($value);

                    //Validar si la fecha ingresada es menor a la fecha minima para realiza la reserva, en caso de cumplise esta condicion la validacion fallara y retornara un mensaje de error
                    if($fechaIngresada->lessThan($fechaMinima)){
                        $fail("Debes reservar con minimo $diasMinimos dias de anticipación");
                    }   
                }
            ],

            'fecha_salida' => [
                'required',
                'date',
                /*
                    Regla usada: after (Despues de): nombre_input 

                    Objetivo: Validar que una fecha introducida en un input ocurre despues de otra
                */
                'after:fecha_ingreso'
            ],

            'tipo_hab'=>[
                'array',
                function($attribute,$value,$fail){
                    //Recorrer todo el arreglo de los datos generados y validar que ninguno sea nulo o no sea numerico se enviara su respectivo mensaje de error
                    foreach($value as $item){
                        if($item==null){
                            $fail("Debes completar todos los campos tipo de habitacion");
                        }

                        if(!is_numeric($item)){
                            $fail("Recuerda introducir datos validos");
                        }
                    }
                    
                },
                function($attribute,$value,$fail){
                    //Recorrer
                    foreach($value as $item){
                        if(tipo_habitacion::find($item)==NULL){
                            $fail("Error, Tipo de habitacion no encontrada");
                        }
                    }
                }
            ],

            'num_hab'=>[
                'array',
                'min:1',
                function($attribute,$value,$fail){
                    //Recorrer todo el arreglo de los datos generados y validar que ninguno sea nullo o se enviara un mensaje de error
                    foreach($value as $item){
                        if($item==null){
                            $fail("Debes especificar la cantidad de habitaciones");
                        }
                    }
                    
                }
            ]
            
        ];
    }
}

