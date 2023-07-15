<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Nota: Para agregar un usuario, unicamente deberan, añadir mas registros al arreglo, siempre manteniendo los nombres de las claves
        $usuarios=[
            [
                'nombre'=>"Cliente",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>1111111111,
                'num_telefono'=>1111111111,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'cliente@example.com',
                'password'=>123456789,
                'rol'=>'cliente'
            ],
            [
                'nombre'=>"Recepcionista",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>2222222222,
                'num_telefono'=>2222222222,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'recepcionista@example.com',
                'password'=>123456789,
                'rol'=>'recepcionista'
            ],
            [
                'nombre'=>"Servicio al Cliente",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>3333333333,
                'num_telefono'=>3333333333,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'servicio_cliente@example.com',
                'password'=>123456789,
                'rol'=>'servicio_cliente'
            ],
            [
                'nombre'=>"Coordinador de Inventario",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>4444444444,
                'num_telefono'=>4444444444,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'coordinador_inventario@example.com',
                'password'=>123456789,
                'rol'=>'coordinador_inventario'
            ],
            [
                'nombre'=>"Personal de Aseo",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>5555555555,
                'num_telefono'=>5555555555,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'personal_aseo@example.com',
                'password'=>123456789,
                'rol'=>'personal_aseo'
            ],
            [
                'nombre'=>"Coordinador de Eventos",
                'id_pais'=>46,
                'id_genero'=>2,
                'id_tip_doc'=>1,
                'num_documento'=>6666666666,
                'num_telefono'=>6666666666,
                'fecha_nacimiento'=>"2023-06-25",
                'email'=>'coordinador_eventos@example.com',
                'password'=>123456789,
                'rol'=>'coordinador_eventos'
            ],
        ];

        foreach($usuarios as $usuario){

            //Guardar la informacion de cada columna en su respectiva variable
            $nombre=$usuario['nombre'];
            $id_pais=$usuario['id_pais'];
            $id_genero=$usuario['id_genero'];
            $id_tip_doc=$usuario['id_tip_doc'];
            $num_documento=$usuario['num_documento'];
            $num_telefono=$usuario['num_telefono'];
            $fecha_nacimiento=$usuario['fecha_nacimiento'];
            $email=$usuario['email'];
            $password=Hash::make($usuario['password']);

            //Obtener la fecha y Hora actuales
            $datetime=date("Y-m-d H:i:s");

            //Ejecutar el Procedimiento con los datos ingresados
            DB::statement("CALL registrarUsuario('$nombre','$id_pais','$id_genero','$id_tip_doc','$num_documento','$num_telefono','$fecha_nacimiento','$email','$password','$datetime','$datetime')");

            //Consultar el Id del usuario recien creado
            $registro_usuario=DB::select('select id from users where nombre = ?', [$nombre]);

            //Consultar la info del usuario recien creado, usando los metodos el metodo find para poder usar los metodos de Spatie
            $registro_usuario=User::find($registro_usuario[0]->id);

            //Asignacion del Rol al usuario
            $registro_usuario->assignRole($usuario['rol']);
        }
    }
}