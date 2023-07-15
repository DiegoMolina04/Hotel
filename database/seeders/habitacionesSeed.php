<?php

namespace Database\Seeders;

use App\Models\habitaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class habitacionesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generar el id del tipo de habitacion en forma de Ciclo
        for($idTipoHab=1;$idTipoHab<=6;$idTipoHab++){

            //Generar la centena del codigo, segun el id del tipo de habitacion
            $centena=$idTipoHab*100;
            
            //Validar que el ciclo este creando habitaciones correspondientes a los primeros 5 tipos de habitaciones
            if($idTipoHab<>6){

                //Generar 20 habitaciones x cada Tipo de Habitacion
                for($codigo=$centena;$codigo<=$centena+19;$codigo++){
                    habitaciones::create([
                        'id_tip_hab'=>$idTipoHab,
                        'codigo'=>$codigo,
                        'id_estado'=>2
                    ]);
                }
            }else{

                //En caso de esta ejecutando la creacion del secto tipo de habitacion(Suite), el sistema solo generara 5 habitaciones
                for($codigo=$centena;$codigo<=$centena+4;$codigo++){
                    habitaciones::create([
                        'id_tip_hab'=>$idTipoHab,
                        'codigo'=>$codigo,
                        'id_estado'=>2
                    ]);
                }
            }
            
        }
    }
}
