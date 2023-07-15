<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tipo_evento;
use App\Models\tipo_salon;
use App\Models\eventos;
use App\Models\asistentes_evento;
use App\Models\estados_reserva;
use App\Models\evento_salon;
use App\Models\salones;
use App\Models\complementos_evento;
use App\Models\evento_complemento;
use App\Models\tipo_documentos;

class gestionEventosController extends Controller
{
    // Atributo que contiene los estados de habitaciones visibles y manejables por el coordinador de eventos
    protected $estadosVisibles = [1,4,5];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Traemos eventos
        $eventos = eventos::whereIn('id_estado_evento', $this->estadosVisibles)->orderBy('fecha_inicio')->paginate(10);

        // A cada evento le traemos la información del evento
        for($i = 0, $max = COUNT($eventos); $i < $max; $i++){
            $eventos[$i]->tipoEvento = tipo_evento::where('id', $eventos[$i]->id_tipo_evento)->first();
        }

        // Retornamos vista con información obtenida 
        return view("admin.eventos.index",[
            "eventos" => $eventos
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // Obtenemos información de evento
        $evento = eventos::where('id',$id)->whereIn('id_estado_evento', $this->estadosVisibles)->first();

        // Validamos existencia de evento
        if($evento == null){
            return redirect()->route("gestion-eventos.index")->withErrors(['eventoNoEncontrado' => "El evento que se ha intentado leer no ha sido encontrado"]);
        }


        // Obtenemos información necesaria de acuerdo a tipo de evento
        if($evento->id_tipo_evento == 1){

            // Información salón
            $salonEv = evento_salon::where('id_evento', $id)->first();
            $salon = salones::all()->find($salonEv->id_salon);
            $salon->tipo = tipo_salon::all()->find(salones::all()->find($salonEv->id_salon)->id_tip_salon);

            /**
             *  Obtenemos info sobre complementos 
             */
            $complementosAdquiridos = evento_complemento::where('id_evento', $id)->get();
    
            // Creamos array para almacenar información de complementos
            $infoComplementos = [];
    
            // Información de todos los complementos
            $complementos = complementos_evento::all();
            
            // Añadimos al array la información de los complementos adquiridos
            foreach($complementosAdquiridos as $comp){
                $infoComplementos[] = $complementos->find($comp->id_complemento);
            }

        }else{
            // Asistentes evento
            $asistentes = asistentes_evento::where('id_evento', $id)->get();

            // Tipo de documento para cada asistente
            for($i = 0, $max = COUNT($asistentes); $i < $max; $i++){
                $asistentes[$i]->TipoDocumento = tipo_documentos::where('id', $asistentes[$i]->id_tip_doc)->first()->nombre;
            }
        }

        // Información necesaria para cualquier evento 
        $evento->tipoEvento = tipo_evento::where('id', $evento->id_tipo_evento)->first();
        $evento->estadoReserva = estados_reserva::where('id',$evento->id_estado_evento )->first();
        $estados = estados_reserva::all();


        // Retornamos vistas y damos información
        return view("admin.eventos.info", [
            "evento" => $evento,
            "asistentes" => isset($asistentes) ? $asistentes : null,
            "estados" => $estados,
            "Salon" => isset($salon) ? $salon : null,
            "Complementos" => isset($infoComplementos) ? $infoComplementos : null
        ]);
    }

    /**
     * Función encargada de actualizar estado de reserva
     * 
     * @param id Es el id de la reserva a actualizar
     * 
     * @param req El la información enviada en la petición
     */
    public function update(int $id, Request $req){

        // Obtenemos reservas con estados visibles para el coordinador y buscamos el especifico a cambiar 
        $evento = eventos::whereIn('id_estado_evento', $this->estadosVisibles)->find($id);

        // Validamos haber obtenido el evento, caso contrario redireccionamos con mensaje de error
        if($evento == null){
            return back()->withErrors(['eventoNoEncontrado' => "El evento que se ha intentado actualizar no ha sido encontrado"]);
        }

        // Actualizamos y guardamos
        $evento->id_estado_evento = $req->estado;
        $evento->save();

        // Regresamos a la vista anterior con la acualización hecha
        return back();
        
    }

    
}
