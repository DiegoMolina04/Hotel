<?php


namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;

use App\Models\tipo_evento;
use App\Models\complementos_evento;
use App\Models\evento_complemento;
use App\Models\tipo_salon;
use App\Models\tipo_documentos;
use App\Models\salones;
use App\Models\eventos;
use App\Models\evento_salon;
use App\Models\factura_evento;
use App\Models\estados_reserva;
use App\Models\asistentes_evento;

use Illuminate\Http\Request;

class eventosController extends Controller
{
    /**
     * Función de apoyo para crear eventos
     * 
     * @return evento
     */
    protected function creacionEvento($request, $tipo){
        // Creamos evento con la información dada, id del usuario que realiza reserva y estado de evento en espera
        return eventos::create([
            'id_tipo_evento' => $tipo,
            'id_cliente' => auth()->user()->id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'Numero_invitados' => $request->invitados,
            'id_estado_evento' => 5
        ]); 
    }


    /**
     * Función encargada de reunir toda la información necesaria para hacer posterior facturación
     * 
     * @param idEvento Recibe como argumento el id del evento
     * 
     * @return array Retorna array con toda esa información
     */
    protected function infoFacturacion($idEvento){
        // Obtenemos evento para facturar
        $evento = eventos::all()->find($idEvento);

        // Validando que evento si pertenezca al usuario que hace petición
        if($evento->id_cliente != auth()->user()->id){
            return back()->withErrors([
                "NoPertenece" => "El evento al que se ha intentado acceder no le pertenese o no está asociado a su usuario."
            ]);
        }

        // Obtenemos información de tipo de evento
        $tipEven = tipo_evento::all()->find($evento->id_tipo_evento);

        // Obtenemos información de salon reservado

        $salonEv = evento_salon::where('id_evento', $idEvento)->first();
        $salon = null;

        // Dependiendo si se encontro reserva de salon o no
        if($salonEv != null){
            $salon = tipo_salon::all()->find(salones::all()->find($salonEv->id_salon)->id_tip_salon);
        }

        /**
         *  Obtenemos info sobre complementos 
         */
        $complementosAdquiridos = evento_complemento::where('id_evento', $idEvento)->get();

        // Creamos array para almacenar información de complementos
        $infoComplementos = [];

        // Información de todos los complementos
        $complementos = complementos_evento::all();
        
        // Añadimos al array la información de los complementos adquiridos
        foreach($complementosAdquiridos as $comp){
            $infoComplementos[] = $complementos->find($comp->id_complemento);
        }

        // Retornamos información obtenida en un array
        return [
            "evento" => $evento,
            "Tipo_evento" => $tipEven,
            "Salon" => $salon,
            "Complementos" => $infoComplementos
        ];

    }

    /**
     * Función que crea o actualiza la factura 
     * 
     * @param idEvento Recibe como parametro el id del evento
     * 
     * @return void
     */
    public function CrearFactura($idEvento){
        // Extraemos información de array obtenido en variables independientes
        extract($this->infoFacturacion($idEvento));

        // Primero calculamos el precio del evento de acuerdo al número de invitados
        $precioEvento = $Tipo_evento->precio_general + ($Tipo_evento->precio_invitado * $evento->Numero_invitados);

        // Ahora el precio del salon en caso de haber uno reservado
        $precioSalon = 0;
        if($Salon != null){
            $precioSalon = $Salon->precio_base + ($Salon->precio_silla * $evento->Numero_invitados);
        }

        // Ultimamente el precio de los complementos
        $precioComplementos = 0;
        foreach($Complementos as $complemento){
            $precioComplementos += $complemento->precio_general + ($complemento->precio_invitado * $evento->Numero_invitados);
        }

        // Ahora calculamos el subtotal
        $subTotal = $precioEvento + $precioSalon + $precioComplementos; 

        // Calculamos iva
        $iva = $subTotal * .21;

        // Finalmente el valor final 
        $Total = $subTotal + $iva; 

        // E insertamos los valores a la tabla factura_evento, o los actualizamos en caso de que ya existan
        factura_evento::updateOrCreate(
            ["fk_evento" => $evento->id], 
            [
                "paquete" => $precioEvento,
                "salon" => $precioSalon,
                "complementos" => $precioComplementos,
                "subtotal" => $subTotal,
                "valor_iva" => $iva,
                "valor_total" => $Total,
                "fk_metodo_pago" => 3
            ]
        );
    }

    /**
     * Función de utilidad para validar formularios de eventos, creación y actualización
     */
    protected function validacionEventos($request){
        // Fecha mínima nueva reserva
        $fechaMinima = date('Y-m-d\TH:i', strtotime('+1 day'));
        $fechaMinFin = $request->fecha_inicio;
        // Primera capa de validación, independiente al tipo de reserva
        $request->validate([
            "fecha_inicio" => "required|date_format:Y-m-d\TH:i|after_or_equal:$fechaMinima",
            "fecha_fin" => "required|date_format:Y-m-d\TH:i|after_or_equal:$fechaMinFin"
        ]);

    }

    
    public function create(){
        // Trayendo información necesaria para vista
        $EventTypes = tipo_evento::all('nombre','id');
        $SalonTypes = tipo_salon::all('nombre','id');
        $complementos = complementos_evento::all('nombre','id', 'precio_general', 'precio_invitado');

        // Retornando vista y dandole información necesaria
        return view('clients.eventos.crear', [
            "event_types" => $EventTypes,
            "salon_types" => $SalonTypes,
            "complementos" => $complementos
        ]);
        
    }


    public function store(Request $request){

        // Hacemos validación inicial
        $this->validacionEventos($request);

        $request->validate([
            "invitados" => 'required|integer|min:1'
        ]);

        // Segunda capa de validación, de acuero a reserva de solo espacio o de paquete completo
        if($request->spaceOnly){
            $request->validate([
                "TipoSalon" => 'required|exists:tipo_salon,id',
            ]);
            $max = tipo_salon::conseguirMaximo($request->TipoSalon);
            $request->validate([
                "invitados" => "numeric|max:$max"
            ]);

            // Obteniendo salón disponible 
            if(
                $salon = salones::obtenerSalon(
                        $request->TipoSalon,
                        $request->fecha_inicio,
                        $request->fecha_fin
                    )
                )
            {
                // Creamos reserva apoyandonos en función
                $evento = $this->creacionEvento($request, 1);

                // Creamos relación de reserva con salón
                $relEventoSalon = evento_salon::create([
                    'id_salon' => $salon,
                    'id_evento' => $evento->id
                ]);

                // Añadimos complementos
                $complementos = complementos_evento::all('id');

                // Validando si tiene cada complemento
                foreach($complementos as $complemento){

                    // En caso de tenerlo lo añadimos
                    if($request->has($complemento->id)){
                        evento_complemento::create([
                            'id_complemento' => $complemento->id,
                            'id_evento' => $evento->id
                        ]);
                    }
                }
            }else{
                // Creamos error y retornamos en caso de no haber ningun salón disponible
                return back()->withErrors(['Salon' => "No hay salones de este tipo disponibles en esa fecha"])->withInput();
            }
        }else{
            $request->validate([
                "TipoEvento" => 'required|exists:tipo_evento,id',
            ]);

            // Creamos reserva apoyandonos en función
            $evento = $this->creacionEvento($request, $request->TipoEvento);
        }

        // Creamos factura en la db
        $this->CrearFactura($evento->id);

        // Redireccionamos a vista de usuario
        return redirect()->route('eventos.show', ['evento'=>$evento->id]);
    }

    /**
     * Función para mostrar información de facturación de un evento específico
     * 
     * @param id entero que rerpesenta el id de la reserva a presentar
     */
    public function show(int $id){
        // Obtenemos información de facturación
        $info = $this->infoFacturacion($id);

        // Obtenemos información de factura
        $info["Factura"] = factura_evento::where('fk_evento', $id)->first();

        // Obtenemos estado reserva
        $info["estado_reserva"] = estados_reserva::where('id', $info["evento"]->id_estado_evento)->first();

        // Obtenemos lista de invitados
        $info['invitados'] = asistentes_evento::where('id_evento', $id)->first();

        // Retornamos vista con información obtenida
        return view('clients.eventos.factura', $info);
    }

    /**
     * Función encargada de eliminar de la base de datos la reserva dada
     * 
     * @param id id de reserva a eliminar
     */
    public function destroy(int $id){

        // Obtenemos evento al que pertenece
        $evento = eventos::all()->find($id);

        // Validamos si el dueño del evento es el usuario que ejecuta la acción 
        if($evento->id_cliente != auth()->user()->id){
            return back()->withErrors('noPermitido', "El complemento que intenta eliminar no le pertenece");
        }

        // Eliminamos registros en tablas adjacentes
        evento_complemento::where('id_evento', $id)->delete();
        evento_salon::where('id_evento', $id)->delete();
        factura_evento::where('fk_evento', $id)->delete();
        asistentes_evento::where('id_evento', $id)->delete();

        // Eliminamos tabla en cuestion
        eventos::destroy($id);

        // Redireccionamos al index de eventos
        return redirect()->route('eventos.index');
    }

    /**
     * Función para desplegar vista para editar un evento 
     */
    public function edit(int $id){

        // Obteniendo información evento
        $evento = eventos::where('id_cliente', auth()->user()->id)->find($id);

        // Validando que se haya obtenido evento
        if($evento == null){
            return back()->withErrors(['EventoNoExiste' => "El evento que se ha intentado actualizar no exite o no le pertenece."]);
        }

        // Trayendo información necesaria para vista
        $EventTypes = tipo_evento::all('nombre','id');
        $SalonTypes = tipo_salon::all('nombre','id');
        $docTypes = tipo_documentos::all('nombre','id');
        $complementos = evento_complemento::complementosEvento($id);


        // Obteniendo salon
        $salon = evento_salon::where('id_evento', $id)->first();

        // Dependiendo si se encontro reserva de salon o no
        if($salon != null){
            $salon->Tipo = tipo_salon::all()->find(salones::all()->find($salon->id_salon)->id_tip_salon);
        }

        // Retornando vista con información obtenida
        return view('clients.eventos.edit',[
            "event_types" => $EventTypes,
            "salon_types" => $SalonTypes,
            "Tipos_documento" => $docTypes,
            "complementos" => $complementos,
            "evento" => $evento,
            "salon" => $salon
        ]);
        
    }

    /**
     * Función para retornar vista de inicio usuarios 
     */
    public function index(){

        // Obtenemos eventos con paginación de 10 eventos por página
        $eventos = eventos::where("id_cliente", auth()->user()->id)->paginate(10);

        // Si no obtuvimos ningún evento retornamos vista con eventos = false 
        if(COUNT($eventos) == 0){
            return view('clients.eventos.index', [
                "eventos" => false
            ]);
        }

        // Obtenemos información de tipo de evento para cada evento
        for($i = 0, $max = count($eventos); $i < $max; $i++){
            $eventos[$i]->tipoEvento = tipo_evento::where("id", $eventos[$i]->id_tipo_evento)->first();
        }

        //Retornamos vista con información obtenida        
        return view('clients.eventos.index', [
            "eventos" => $eventos
        ]);
    }
    /**
     * Función encargada de actualizar reserva de espacio / salón
     */
    public function update(int $id, Request $request){

        //Obtenemos evento y validamos que exista
        $evento = eventos::all()->find($id);

        if($evento == null || $evento->id_cliente != auth()->user()->id){
            return back()->withErrors(['notFound' => "Intentando actualizar un evento no existente o que no le pertenece"]);
        }
        
        // Hacemos validación inicial
        $this->validacionEventos($request);

        // Segunda capa de validación, de acuero a reserva de solo espacio o de paquete completo
        if($evento->id_tipo_evento == 1){
            $request->validate([
                "TipoSalon" => 'required|exists:tipo_salon,id',
            ]);

            // Obteniendo salón disponible 
            if(
                $salon = salones::obtenerSalon(
                        $request->TipoSalon,
                        $request->fecha_inicio,
                        $request->fecha_fin
                    )
                )
            {
                // Actualizamos reserva
                $evento->fecha_inicio = $request->fecha_inicio;
                $evento->fecha_fin = $request->fecha_fin;
                $evento->id_tipo_evento = $request->TipoSalon;
                $evento->save();

                // Actualizamos relación con salón
                $relEventoSalon = evento_salon::create([
                    'id_salon' => $salon,
                    'id_evento' => $evento->id
                ]);

            }else{
                // Creamos error y retornamos en caso de no haber ningun salón disponible
                return back()->withErrors(['Salon' => "No hay salones de este tipo disponibles en esa fecha"])->withInput();
            }
        }else{
            $request->validate([
                "TipoEvento" => 'required|exists:tipo_evento,id',
            ]);

            // Actualizamos evento
            
        }

        // Creamos factura en la db
        $this->CrearFactura($evento->id);

        // Redireccionamos a vista de usuario
        return redirect()->route('eventos.show', ['evento'=>$evento->id]);
    }

    /**
     * Manejando complementos de un evento especifico 
     */
    public function addComplement(Request $req, int $idEvento){
        
        // Obtenemos evento al que pertenece
        $evento = eventos::all()->find($idEvento);

        // Validamos si el dueño del evento es el usuario que ejecuta la acción o si existe el evento 
        if($evento == null || $evento->id_cliente != auth()->user()->id){
            return back()->withErrors('noPermitido', "El complemento que intenta modificar no le pertenece o no existe");
        }

        // Validando complemento enviado
        $req->validate([
            "complemento" => "required|exists:complementos_eventos,id"
        ]);

        // Creando complemento_evento
        evento_complemento::create([
            'id_complemento' => $req->complemento,
            'id_evento' => $evento->id
        ]);

        // Actualizando facturación 
        $this->CrearFactura($evento->id);
        
        // Regresar a vista anterior
        return back();

    }

    public function deleteComplement(int $id){

        // Obtenemos al complemento a eliminar
        $complemento = evento_complemento::all()->find($id);

        // Validamos que complemento exista
        if($complemento == null){
            return back()->withErrors('NotFound', "Complemento no encontrado");
        }

        // Obtenemos evento al que pertenece
        $evento = eventos::all()->find($complemento->id_evento);

        // Validamos si el dueño del evento es el usuario que ejecuta la acción 
        if($evento->id_cliente != auth()->user()->id){
            return back()->withErrors('noPermitido', "El complemento que intenta modificar no le pertenece");
        }

        // Eliminando complemento 
        evento_complemento::destroy($id);

        // Actualizando facturación 
        $this->CrearFactura($evento->id);

        // Regresando a vista anteriror
        return back();
    }
}
