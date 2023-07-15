<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Http\Controllers\clients\eventosController;
use App\Models\eventos;
use App\Models\asistentes_evento;
use App\Models\tipo_evento;
use App\Models\tipo_documentos;

use App\Rules\ArraysCannotShareValues;
use Illuminate\Http\Request;

class asistentesEvento extends Controller
{
    public function index(int $Idevento){
        
        $asistentes = asistentes_evento::where('id_evento', $Idevento)->get();
        $evento = eventos::all()->find($Idevento);
        $tipoEvento = tipo_evento::all()->find($evento->id_tipo_evento);

        for($i = 0, $max = COUNT($asistentes); $i < $max; $i++){
            $asistentes[$i]->TipoDocumento = tipo_documentos::where('id', $asistentes[$i]->id_tip_doc)->first()->nombre;
        }

        if($asistentes != null){
            return view('clients.eventos.listaAsistentes', [
                "asistentes" => $asistentes,
                "evento" => $evento,
                "tipoEvento" => $tipoEvento
            ]);
            
        }else{
            return redirect()->route("eventos.show", $idEvento)->withErrors(['noExistentes' => "Este evento no tiene lista de invitados aún"]);
        }
    }

    public function create(int $Idevento){
        $evento = eventos::all()->find($Idevento);

        if($evento->id_tipo_evento == 1){
            return redirect()->route("eventos.show", $idEvento)->withErrors(['tipoSalon' => "En este evento solo se reserva espacio, no incluye lista de invitados"]);
        }
        $paquete = tipo_evento::all()->find($evento->id_tipo_evento);

        return view("clients.eventos.addinvitados",[
            "evento" => $evento,
            "paquete" => $paquete,
            "Tipos_documento" => tipo_documentos::all()
        ]);
    }

    public function edit(int $idEvento, int $idInvitado){
        $invitado = asistentes_evento::all()->find($idInvitado);

        return view("clients.eventos.editInvitado",[
            "invitado" => $invitado,
            "idEvento" => $idEvento,
            "Tipos_documento" => tipo_documentos::all()
        ]);
    }
    

    public function update(Request $req,int $idEvento, int $idInvitado){

        $req->validate([
            "TipoDocumento" => "required|exists:tipo_documentos,id",
            "Documento" => "required|string|min:10",
            "Nombre"=> "required|string|min:10"
        ]);

        $asistente = asistentes_evento::all()->find($idInvitado);


        $asistente->id_tip_doc = $req->TipoDocumento;
        $asistente->num_documento = $req->Documento;
        $asistente->nombre = $req->Nombre;

        $asistente->save();

        return redirect()->route('invitados.index', $idEvento);
        
    }

    public function store(Request $request,int $idEvento){

        if(asistentes_evento::where('id_evento', $idEvento)->first() != null){
            return redirect()->route("eventos.show", $idEvento)->withErrors(['yaexistentes' => "Este evento ya tiene lista de invitados"]);
        }

        $evento = eventos::all()->find($idEvento);
        $paquete = tipo_evento::all()->find($evento->id_tipo_evento);
        

        $this->validarEnviado($idEvento, $request);

        for($i = 0, $max = COUNT($request->TipoDocumentoEspeciales); $i < $max; $i++){
            if($request->TipoDocumentoEspeciales[$i] != null){
                asistentes_evento::updateOrInsert(
                    [
                        "id_evento" => $idEvento,
                        "num_documento" => $request->DocumentoEspeciales[$i]
                    ],
                    [
                        "id_tip_doc" => $request->TipoDocumentoEspeciales[$i],
                        "especial" => true,
                        "nombre" => $request->NombreEspeciales[$i]
                    ]
                );
            }
        }

        for($i = 0, $max = COUNT($request->TipoDocumento); $i < $max; $i++){
            if($request->TipoDocumento[$i] != null){
                asistentes_evento::updateOrInsert(
                    [
                        "id_evento" => $idEvento,
                        "num_documento" => $request->Documento[$i]
                    ],
                    [
                        "id_tip_doc" => $request->TipoDocumento[$i],
                        "especial" => false,
                        "nombre" => $request->Nombre[$i]
                    ]
            );
            }
        }
        // logrado 
        return redirect()->route("invitados.index", $idEvento);
    }


    public function destroy(int $idevento, int $invitado){
        // Eliminamos invitado de lista de invitados
        asistentes_evento::destroy($invitado);

        // Obtenemos evento y le restamos uno a el numero de invitados
        $evento = eventos::all()->find($idevento);
        $evento->Numero_invitados = $evento->Numero_invitados - 1;
        $evento->save();

        // Creamos instancia del controlador de eventos y acualizamos la factura
        $controlador = new eventosController();
        $controlador->CrearFactura($idevento);

        // Regresamos a la vista anterior con el cambio ya hecho
        return back();
        
    }

    public function agregarInvitado(Request $request, int $id){

        // Validación de campos
        $request->validate([
            "TipoDocumento" => "required|exists:tipo_documentos,id",
            "Documento" => "required|string|min:10",
            "Nombre"=> "required|string|min:10"
        ]); 

        // Añadiendo información a base de datos
        asistentes_evento::updateOrInsert(
            [
                "id_evento" => $id,
                "num_documento" => $request->Documento
            ],
            [
                "id_tip_doc" => $request->TipoDocumento,
                "especial" => false,
                "nombre" => $request->Nombre
            ]
        );

        // Obtenemos evento y le restamos uno a el numero de invitados
        $evento = eventos::all()->find($id);
        $evento->Numero_invitados = $evento->Numero_invitados + 1;
        $evento->save();

        // Creamos instancia del controlador de eventos y acualizamos la factura
        $controlador = new eventosController();
        $controlador->CrearFactura($id);

        // Redireccion a lista de invitados
        return redirect()->route('invitados.index', $id);

    }

    public function vistaAgregarInvitado(int $id){
        return view("clients.eventos.addInvitado",[
            "eventoId" => $id,
            "Tipos_documento" => tipo_documentos::all()
        ]);
    }

    /**
     * Funcion encargada de validar envio de creación de lista de invitados
     * 
     * 
     */
    protected function validarEnviado($idEvento, $request){

        $evento = eventos::all()->find($idEvento);
        $paquete = tipo_evento::all()->find($evento->id_tipo_evento);

        $minInvi = $evento->Numero_invitados - $paquete->max_especiales;
        $maxInvi = $evento->Numero_invitados - $paquete->min_especiales;

        $rules = [
            "TipoDocumentoEspeciales" => "array|between:".$paquete->min_especiales.",".$paquete->max_especiales,
            "DocumentoEspeciales" => "array|between:".$paquete->min_especiales.",".$paquete->max_especiales,
            "NombreEspeciales" => "array|between:".$paquete->min_especiales.",".$paquete->max_especiales,
            "TipoDocumento" => "array|between:$minInvi,$maxInvi",
            "Documento" => "array|between:$minInvi,$maxInvi",
            "Nombre" => "array|between:$minInvi,$maxInvi",

        ];

        for($i = 0; $i < $paquete->min_especiales; $i++){
            $rules["TipoDocumentoEspeciales.".$i] = "required";
            $rules["DocumentoEspeciales.".$i] = "required|string|between:10,11";
            $rules["NombreEspeciales.".$i] = "required|string|min:5";
        }

        for($i = 0; $i < $paquete->max_especiales; $i++){
            $rules["TipoDocumentoEspeciales.".$i] = "required_with:DocumentoEspeciales.$i";
            $rules["DocumentoEspeciales.".$i] = "required_with:TipoDocumentoEspeciales.$i|string|min:10";
            $rules["NombreEspeciales.".$i] = "required_with:DocumentoEspeciales.$i|string|min:10";
        }

        for($i = 0; $i < $minInvi; $i++){
            $rules["TipoDocumento.".$i] = "required";
            $rules["Documento.".$i] = "required|string|min:10";
            $rules["Nombre.".$i] = "required|string|min:10";
        }

        for($i = 0; $i < $paquete->maxInvi; $i++){
            $rules["TipoDocumento.".$i] = "required_with:Documento.$i";
            $rules["Documento.".$i] = "required_with:Documento.$i";
            $rules["Nombre.".$i] = "required_with:TipoDocumento.$i";
        }


        $request->validate($rules);

        // Segunda capa de validación
        $request->validate([
            "TipoDocumentoEspeciales.*" => "exists:tipo_documentos,id",
            "DocumentoEspeciales" => new ArraysCannotShareValues($request->Documento),
            "TipoDocumento.*" => "exists:tipo_documentos,id",
            "DocumentoEspeciales.*" => "distinct",
            "Documento.*" => "distinct",
        ]);

        $invitados = 0;

        if($request->TipoDocumento == null){
            $request->TipoDocumento = [];
        }

        foreach($request->TipoDocumentoEspeciales as $invitado){
            if($request->$invitado != null){
                $invitados++;
            }
        }
        foreach($request->TipoDocumento as $invitado){
            if($request->$invitado != null){
                $invitados++;
            }
        }

        if($invitados != $evento->Numero_invitados){

            $numeroInvitados = $evento->Numero_invitados;

            if($invitados > $evento->Numero_invitados){

                return back()->withInput()->withErrors(['numeroInvitados' => "Los datos enviados superan a el número de invitados especificados en la reservacion, invitados especificados: $invitados, invitados recibidos: $numeroInvitados"]);

            }else{

                return back()->withInput()->withErrors(['numeroInvitados' => "Los datos enviados es menor a el número de invitados especificados en la reservacion, invitados especificados: $invitados, invitados recibidos: $numeroInvitados"]);

            }
        }
    }
}
