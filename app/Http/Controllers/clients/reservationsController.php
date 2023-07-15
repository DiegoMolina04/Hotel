<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\reservationsValidate;
use App\Models\reservas;
use App\Models\eventos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class reservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Recuperacion del id del cliente 
        $id_cliente=Auth::user()->id;
        
        //Ejecutar el metodo que consulta las reservas activas que posee el usuario, para luego guardarlo en su respectiva variable
        $reservas_activas=DB::select("CALL consultarReservasActivas($id_cliente)");

        /*
            Consulta pendiente por revisión: Se debe usar unicamente procedimientos almacenados

            $events = eventos::where('id_cliente', auth()->user()->id);
        */

        //Retornar la vista enviandole la informacion necesaria
        return view("clients.reservations.index",[
            'reservas_activas'=>$reservas_activas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Ejecutar el procedimiento que consulta que tipo de habitaciones cuenta aun con habitaciones disponibles
        $room_types=DB::select("CALL consultarTipoHabitacionDisponibles()");

        //Obtener la fecha actual y sumarle 3 dias
        $fecha_minima=Carbon::tomorrow()->startOfDay()->addDays(2);

        //Retornar la vista de creacion, enviandole los datos necesarios
        return view("clients.reservations.create",['room_types'=>$room_types,
        'fecha_minima'=>$fecha_minima]);
    }

    public function pay($id){
        return "vista de pago";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reservationsValidate $request, SessionManager $sessionManager)
    {
        //Declaracion de la variable subtotal de la factura
        $subtotal=0;

        //Recuperacion id cliente 
        $id_cliente=Auth::user()->id;

        /* 
            Paso 1: Recuperar y Transformar los input date del formulario
            Paso 2: Establecer la hora de la reserva a las 12:00
        */
        $fecha_inicio=Carbon::parse($request->fecha_ingreso)->addHours(12);
        $fecha_fin=Carbon::parse($request->fecha_salida)->addHours(12);

        //Calcular el numero de dias que durara la reserva
        $dias_reserva=$fecha_inicio->diffInDays($fecha_fin);

        //Recuperar tanto los tipos de habitacion junto con la cantidad de habitacion a reservas
        $tipo_habitacion=$request->tipo_hab;
        $num_hab=$request->num_hab;

        //Ejecutar el procedimiento que registra los datos basicos de la reserva
        DB::select("CALL registrarReserva($id_cliente,'$fecha_inicio','$fecha_fin',@id_reserva);");

        //Obtener y guardar el identificador de la reserva creada
        $id_reserva=DB::select("SELECT @id_reserva as 'id_reserva';")[0]->id_reserva;

        //Recorrer individualmente cada uno de los registros de tipo de habitacion
        for($contador_tip_hab=0;$contador_tip_hab<count($tipo_habitacion);$contador_tip_hab++){

            //Guardar el id del tipo de habitacion
            $id_tip_hab=$tipo_habitacion[$contador_tip_hab];

            //Consultar los codigos de las habitaciones disponibles segun el tipo
            $habitaciones_disponibles=DB::select("CALL consultarDatosHabDisponibles($id_tip_hab)");

            //Validar si el numero de habitaciones disponibles es menor a la cantidad de habitaciones solicitadas
            if(count($habitaciones_disponibles)<$num_hab[$contador_tip_hab]){

                //Ejecutar el procediento que borra toda la informacion de la reserva
                DB::statement("CALL borrarReservaFailed($id_reserva)");

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'No hay suficientes habitaciones disponibles'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Validar si las unidades ingresadas son iguales o menos a 1
            if($num_hab[$contador_tip_hab]<=0){
                //Ejecutar el procediento que borra toda la informacion de la reserva
                DB::statement("CALL borrarReservaFailed($id_reserva)");

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'Las unidades deben ser mayor o igual a 1'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Validar que las unidades ingresadas sean enteras
            if(is_integer($num_hab[$contador_tip_hab])){
                //Ejecutar el procediento que borra toda la informacion de la reserva
                DB::statement("CALL borrarReservaFailed($id_reserva)");

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'Los valores ingresados deben ser enteros'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Recorrer indvidualmente la informacion de cada habitacion segun la cantidad de habitaciones seleccionadas 
            for($id_hab=0;$id_hab<$num_hab[$contador_tip_hab];$id_hab++){

                //Declaracion variable contenedora de los resultados de asociacion habitacion con reserva
                $historial_procesos=[];

                //Guardado del id de la habitacion a reservar
                $cod_hab=$habitaciones_disponibles[$id_hab]->id;

                //Definir el valor actual del IVA (2023) -> Pendiente por coneccion a API DIAN
                $IVA=0.19;

                //Adicion del valor base de la habitacion al subtotal de la factura
                $subtotal+=$habitaciones_disponibles[$id_hab]->costo_base;

                //Ejecutar el procedimiento el cual asocia la habitacion con la reserva, para luego cambiar su estado a "ocupado", asi mismo el resultado de este proceso sera guardado en el historial de procedimiento para ser validado mas adelante
                array_push(
                    $historial_procesos,
                    DB::statement("CALL asociarHabReserva($cod_hab,$id_reserva)")
                );

            }

            //El subtotal actual solo tiene el valor de 1 dia de reserva, sin embargo, este debe ser multiplicado por la cantidad de dias a reservar
            $subtotal*=$dias_reserva;
        }

        //Calcular el IVA sobre el subtotal a pagar
        $valor_IVA=$subtotal*$IVA;

        //Calcular el valor total que debe pagar el cliente
        $valor_total=$subtotal+$valor_IVA;

        /*
            Objetivo: Validacion de buen funcionamiento de procesos

            Pasos:
                Paso 1: Eliminar los registros duplicados (array_unique), del historial de procesos generado anteriormente

                Paso 2: Contar los elementos presentes en el historial y validar que solo haya 1 registro

                Paso 3: Validar que ese unico registro en el historial tenga el valor de Verdadero

                Paso 4: Validar que la creacion de la factura se ha realizado exitosamente
            --

            Validacion Exitosa: Generara un mensaje indicandole al usuario que su reserva fue exitosa

            Validacion Exitosa: Generara un mensaje indicandole al usuario que el proceso de reservacion ha fallado
        */  
        if(
            count(array_unique($historial_procesos))==1 &&
            $historial_procesos[0]==TRUE &&
            DB::statement("CALL crearFacturaHab($id_reserva,'$subtotal','$valor_IVA','$valor_total')")
        ){
            //Declaracion mensaje validacion exitosa
            $data_message=[
                'class_alert'=>'success',
                'content'=>'Felicidades, has generado exitosamente tu reservacion'
            ];
        }else{

            //Declaracion mensaje validacion fallida
            $data_message=[
                'class_alert'=>'danger',
                'content'=>'Lo sentimos, ha ocurrido un error al crear tu reserva, intentalo nuevamente'
            ];
        }

        //Generar mensaje temporal
        $sessionManager->flash('message',$data_message);

        //Redireccion a la vista de reservas activas
        return redirect()->route("reservations.index"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,SessionManager $sessionManager)
    {
        /* 
            Nombre Validación: Identificador valido
            Objetivo: Revisar que el identificador recibido sea numerico
        */
        if(!is_numeric($id)){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, identificador Invalido"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }
        
        //Ejecutar el metodo encargado de obtener (si es posible), la informacion de la reserva segun su id        
        $info_reserva=DB::select("CALL validarReserva($id)");

        /* 
            Nombre Validación: Reserva Encontrada
            Objetivo: Revisar que si se haya encontrado una reserva con ese identificador
        */
        if($info_reserva==NULL){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, La reserva indicada no existe"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Recuperacion y guardado del id del cliente
        $id_cliente=Auth::user()->id;

        /* 
            Nombre Validación: Reserva sin cancelar
            Objetivo: Revisar que la reserva no haya sido cancelada anteriormente
        */
        if($info_reserva[0]->estado_reserva=="Cancelada"){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva ya fue cancelada"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        /* 
            Nombre Validación: Reserva asociada a cliente
            Objetivo: Revisar que este asociada al cliente mediante su id
        */
        if($id_cliente<>$info_reserva[0]->id_cliente){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva esta asociada a otro cliente"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        $info_reserva=DB::select("CALL consultarHabReserva($id)");

        return view("clients.reservations.show",[
            'info_reserva'=>$info_reserva
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,SessionManager $sessionManager)
    {
        /* 
            Nombre Validación: Identificador valido
            Objetivo: Revisar que el identificador recibido sea numerico
        */
        if(!is_numeric($id)){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, identificador Invalido"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }
        
        //Ejecutar el metodo encargado de obtener (si es posible), la informacion de la reserva segun su id        
        $info_reserva=DB::select("CALL validarReserva($id)");

        /* 
            Nombre Validación: Reserva Encontrada
            Objetivo: Revisar que si se haya encontrado una reserva con ese identificador
        */
        if($info_reserva==NULL){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, La reserva indicada no existe"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Recuperacion y guardado del id del cliente
        $id_cliente=Auth::user()->id;

        /* 
            Nombre Validación: Reserva sin cancelar
            Objetivo: Revisar que la reserva no haya sido cancelada anteriormente
        */
        if($info_reserva[0]->estado_reserva=="Cancelada"){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva ya fue cancelada"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        /* 
            Nombre Validación: Reserva asociada a cliente
            Objetivo: Revisar que este asociada al cliente mediante su id
        */
        if($id_cliente<>$info_reserva[0]->id_cliente){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva esta asociada a otro cliente"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Ejecutar el procedimiento que consulta que tipo de habitaciones cuenta aun con habitaciones disponibles
        $room_types=DB::select("CALL consultarTipoHabitacionDisponibles()");

        //Ejecutar el procedimiento que consulta que tipo de habitacion tiene la reserva, asi como la cantidad de habitaciones
        $info_reserva=DB::select("CALL consultarTipoHabReserva($id);");

        //Retornar la vista de creacion, enviandole los datos necesarios
        return view("clients.reservations.edit",[
            'room_types'=>$room_types,
            'info_reserva'=>$info_reserva
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reservationsValidate $request, $id,SessionManager $sessionManager)
    {

        /* 
            Nombre Validación: Identificador valido
            Objetivo: Revisar que el identificador recibido sea numerico
        */
        if(!is_numeric($id)){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, identificador Invalido"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }
        
        //Ejecutar el metodo encargado de obtener (si es posible), la informacion de la reserva segun su id        
        $info_reserva=DB::select("CALL validarReserva($id)");

        /* 
            Nombre Validación: Reserva Encontrada
            Objetivo: Revisar que si se haya encontrado una reserva con ese identificador
        */
        if($info_reserva==NULL){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, La reserva indicada no existe"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Recuperacion y guardado del id del cliente
        $id_cliente=Auth::user()->id;

        /* 
            Nombre Validación: Reserva sin cancelar
            Objetivo: Revisar que la reserva no haya sido cancelada anteriormente
        */
        if($info_reserva[0]->estado_reserva=="Cancelada"){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva ya fue cancelada"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        /* 
            Nombre Validación: Reserva asociada a cliente
            Objetivo: Revisar que este asociada al cliente mediante su id
        */
        if($id_cliente<>$info_reserva[0]->id_cliente){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva esta asociada a otro cliente"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Obtener la informacion de las habitaciones asociadas a la reserva
        $habitaciones=DB::select("CALL consultarHabReserva($id)");

        //Emplear un procedimiento almacenado para cambiar el estado de las habitaciones a libre
        foreach($habitaciones as $habitacion){
 
            //Guardado del id de la habitacion
            $id_habitacion=$habitacion->id;
 
            //Validacion y posterior redireccion en caso de que el cambio de estado no sea posible
            if(!DB::statement("CALL cambiarEstadoHab($id_habitacion,2)")){
 
                //Creacion de mensaje temporal
                $data_message=[
                    'class_alert'=>'danger',
                    'content'=>'Ha ocurrido un error, intentalo nuevamente'
                ];
 
                //Generacion del mensaje temporal
                $sessionManager->flash('message',$data_message);
 
                //Redireccion a ruta principal
                return redirect()->route("reservations.index");
            }
        }

        //Declaracion de la variable subtotal de la factura
        $subtotal=0;

        //Recuperacion id cliente 
        $id_cliente=Auth::user()->id;

        /* 
            Paso 1: Recuperar y Transformar los input date del formulario
            Paso 2: Establecer la hora de la reserva a las 12:00
        */
        $fecha_inicio=Carbon::parse($request->fecha_ingreso)->addHours(12);
        $fecha_fin=Carbon::parse($request->fecha_salida)->addHours(12);

        //Calcular el numero de dias que durara la reserva
        $dias_reserva=$fecha_inicio->diffInDays($fecha_fin);

        //Recuperar tanto los tipos de habitacion junto con la cantidad de habitacion a reservas
        $tipo_habitacion=$request->tipo_hab;
        $num_hab=$request->num_hab;

        //Ejecutar el procedimiento que registra los datos basicos de la reserva
        DB::select("CALL actualizarInfoReserva($id,'$fecha_inicio','$fecha_fin');");

        //Recorrer individualmente cada uno de los registros de tipo de habitacion
        for($contador_tip_hab=0;$contador_tip_hab<count($tipo_habitacion);$contador_tip_hab++){

            //Guardar el id del tipo de habitacion
            $id_tip_hab=$tipo_habitacion[$contador_tip_hab];

            //Consultar los codigos de las habitaciones disponibles segun el tipo
            $habitaciones_disponibles=DB::select("CALL consultarDatosHabDisponibles($id_tip_hab)");

            //Validar si el numero de habitaciones disponibles es menor a la cantidad de habitaciones solicitadas
            if(count($habitaciones_disponibles)<$num_hab[$contador_tip_hab]){

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'No hay suficientes habitaciones disponibles'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Validar si las unidades ingresadas son iguales o menos a 1
            if($num_hab[$contador_tip_hab]<=0){
                //Ejecutar el procediento que borra toda la informacion de la reserva
                DB::statement("CALL borrarReservaFailed($id)");

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'Las unidades deben ser mayor o igual a 1'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Validar que las unidades ingresadas sean enteras
            if(is_integer($num_hab[$contador_tip_hab])){
                //Ejecutar el procediento que borra toda la informacion de la reserva
                DB::statement("CALL borrarReservaFailed($id)");

                //Generar mensaje de error
                $sessionManager->flash('message',[
                    'class_alert'=>'danger',
                    'content'=>'Los valores ingresados deben ser enteros'
                ]);

                //Redirigir nuevamente a la vista de creacion
                return redirect()->route("reservations.create");
            }

            //Recorrer indvidualmente la informacion de cada habitacion segun la cantidad de habitaciones seleccionadas 
            for($id_hab=0;$id_hab<$num_hab[$contador_tip_hab];$id_hab++){

                //Declaracion variable contenedora de los resultados de asociacion habitacion con reserva
                $historial_procesos=[];

                //Guardado del id de la habitacion a reservar
                $cod_hab=$habitaciones_disponibles[$id_hab]->id;

                //Definir el valor actual del IVA (2023) -> Pendiente por coneccion a API DIAN
                $IVA=0.19;

                //Adicion del valor base de la habitacion al subtotal de la factura
                $subtotal+=$habitaciones_disponibles[$id_hab]->costo_base;

                //Ejecutar el procedimiento el cual asocia la habitacion con la reserva, para luego cambiar su estado a "ocupado", asi mismo el resultado de este proceso sera guardado en el historial de procedimiento para ser validado mas adelante
                array_push(
                    $historial_procesos,
                    DB::statement("CALL asociarHabReserva($cod_hab,$id)")
                );

            }

            //El subtotal actual solo tiene el valor de 1 dia de reserva, sin embargo, este debe ser multiplicado por la cantidad de dias a reservar
            $subtotal*=$dias_reserva;
        }

        //Calcular el IVA sobre el subtotal a pagar
        $valor_IVA=$subtotal*$IVA;

        //Calcular el valor total que debe pagar el cliente
        $valor_total=$subtotal+$valor_IVA;

        /*
            Objetivo: Validacion de buen funcionamiento de procesos

            Pasos:
                Paso 1: Eliminar los registros duplicados (array_unique), del historial de procesos generado anteriormente

                Paso 2: Contar los elementos presentes en el historial y validar que solo haya 1 registro

                Paso 3: Validar que ese unico registro en el historial tenga el valor de Verdadero

                Paso 4: Validar que la creacion de la factura se ha realizado exitosamente
            --

            Validacion Exitosa: Generara un mensaje indicandole al usuario que su reserva fue exitosa

            Validacion Exitosa: Generara un mensaje indicandole al usuario que el proceso de reservacion ha fallado
        */  
        if(
            count(array_unique($historial_procesos))==1 &&
            $historial_procesos[0]==TRUE &&
            DB::statement("CALL actualizaFacturaReserva($id,'$subtotal','$valor_IVA','$valor_total')")
        ){
            //Declaracion mensaje validacion exitosa
            $data_message=[
                'class_alert'=>'success',
                'content'=>'Felicidades, has actualizado correctamente tu reservacion'
            ];
        }else{

            //Declaracion mensaje validacion fallida
            $data_message=[
                'class_alert'=>'danger',
                'content'=>'Lo sentimos, ha ocurrido un error al crear tu reserva, intentalo nuevamente'
            ];
        }

        //Generar mensaje temporal
        $sessionManager->flash('message',$data_message);

        //Redireccion a la vista de reservas activas
        return redirect()->route("reservations.index"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SessionManager $sessionManager)
    {
        /* 
            Nombre Validación: Identificador valido
            Objetivo: Revisar que el identificador recibido sea numerico
        */
        if(!is_numeric($id)){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, identificador Invalido"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }
        
        //Ejecutar el metodo encargado de obtener (si es posible), la informacion de la reserva segun su id        
        $info_reserva=DB::select("CALL validarReserva($id)");

        /* 
            Nombre Validación: Reserva Encontrada
            Objetivo: Revisar que si se haya encontrado una reserva con ese identificador
        */
        if($info_reserva==NULL){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, La reserva indicada no existe"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        //Recuperacion y guardado del id del cliente
        $id_cliente=Auth::user()->id;

        /* 
            Nombre Validación: Reserva sin cancelar
            Objetivo: Revisar que la reserva no haya sido cancelada anteriormente
        */
        if($info_reserva[0]->estado_reserva=="Cancelada"){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva ya fue cancelada"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }

        /* 
            Nombre Validación: Reserva asociada a cliente
            Objetivo: Revisar que este asociada al cliente mediante su id
        */
        if($id_cliente<>$info_reserva[0]->id_cliente){

            //Creacion de mensaje temporal
            $sessionManager->flash('message',[
                'class_alert'=>"danger",
                'content'=>"Error, la reserva esta asociada a otro cliente"
            ]);

            //Redireccion a ruta principal
            return redirect()->route("reservations.index");
        }   

        //Obtener la informacion de las habitaciones asociadas a la reserva
        $habitaciones=DB::select("CALL consultarHabReserva($id)");

        //Emplear un procedimiento almacenado para cambiar el estado de las habitaciones a libre
        foreach($habitaciones as $habitacion){

            //Guardado del id de la habitacion
            $id_habitacion=$habitacion->id;

            //Validacion y posterior redireccion en caso de que el cambio de estado no sea posible
            if(!DB::statement("CALL cambiarEstadoHab($id_habitacion,2)")){

                //Creacion de mensaje temporal
                $data_message=[
                    'class_alert'=>'danger',
                    'content'=>'Ha ocurrido un error, intentalo nuevamente'
                ];

                //Generacion del mensaje temporal
                $sessionManager->flash('message',$data_message);

                //Redireccion a ruta principal
                return redirect()->route("reservations.index");
            }
        }

        //Validar si fue porsible realizar la cancelacion de la reserva 
        if(DB::statement("CALL cancelarReserva($id)")){
            $data_message=[
                'class_alert'=>'success',
                'content'=>'La reserva ha sido cancelada exitosamente'
            ];
        }else{
            $data_message=[
                'class_alert'=>'danger',
                'content'=>'Ha ocurrido un error, intentalo nuevamente'
            ];
        }

        //Generacion del mensaje temporal
        $sessionManager->flash('message',$data_message);

        //Redireccion a ruta principal
        return redirect()->route("reservations.index");
    }
}
