<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerValidate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class authCustom extends Controller
{

    //Metodo encargado de retornar la vista de Login
    public function viewLogin(){
        return view('auth.login');
    }

    //Metodo encargado de realizar las consultas necesarias y retornar la vista de registro
    public function viewRegister(){

        //Obtener los paises registrados en la BD
        $paises=DB::select("CALL consultarPaises()");

        //Obtener los tipos de documentos registrados en la BD
        $documentos=DB::select("CALL consultarTipoDocumentos()");

        //Obtener los generos registrados en la BD
        $generos=DB::select("CALL consultarGeneros()");

        return view("auth.register",[
            'paises'=>$paises,
            'documentos'=>$documentos,
            'generos'=>$generos
        ]);

    }

    //Metodo encargado de recibir la informacion del formulario de registro y crear la cuenta del cliente
    public function clientRegister(registerValidate $request){

        //Guardar la informacion recibida en el formulario en variables contenedoras
        $nombre=$request->nombre;
        $id_pais=$request->id_pais;
        $id_genero=$request->id_genero;
        $id_tip_doc=$request->id_tip_doc;
        $num_documento=$request->num_doc;
        $num_telefono=$request->num_telefono;
        $fecha_nacimiento=$request->fecha_nacimiento;
        $email=$request->email;
        $password=Hash::make($request->password);

        //Obtener la fecha y Hora actuales
        $datetime=date("Y-m-d H:i:s");

        //Ejecutar el Procedimiento con los datos ingresados
        DB::statement("CALL registrarUsuario('$nombre','$id_pais','$id_genero','$id_tip_doc','$num_documento','$num_telefono','$fecha_nacimiento','$email','$password','$datetime','$datetime')");

        //Consultar el Id del usuario recien creado
        $registro_usuario=DB::select('select id from users where nombre = ?', [$nombre]);

        //Consultar la info del usuario recien creado, usando los metodos el metodo find para poder usar los metodos de Spatie
        $registro_usuario=User::find($registro_usuario[0]->id);

        //Asignacion del Rol al usuario
        //$registro_usuario->assignRole('cliente');
        //coordinador_inventario
        $registro_usuario->assignRole('servicio_cliente');

        //Redireccion a menu principal
        return redirect()->route("index");
    }
}
