<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\estados_habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class gestionHabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datosIndividual=DB::select("CALL pedirDatosHabitacionIndividual()");
        $datosDoble=DB::select("CALL pedirDatosHabitacionDoble()");
        $datosDobleTwing=DB::select("CALL pedirDatosHabitacionDobleTwing()");
        $datosEmpresarial=DB::select("CALL pedirDatosHabitacionEmpresarial()");
        $datosMatrimonial=DB::select("CALL pedirDatosHabitacionMatrimonial()");
        $datosSuite=DB::select("CALL pedirDatosHabitacionSuite()");



        return view("admin.gestionHabitaciones.index",
        ["datosIndividual"=>$datosIndividual,
        "datosDoble"=>$datosDoble,
        "datosDobleTwing"=>$datosDobleTwing,
        "datosEmpresarial"=>$datosEmpresarial,
        "datosMatrimonial"=>$datosMatrimonial,
        "datosSuite"=>$datosSuite]);
    }

    public function datos(Request $datos){
        return view("admin.gestionHabitaciones.datos",["datos"=> $datos,
        "estados"=>estados_habitacion::all()]);
    }

    public function estado(Request $datos,$id){

       

        $estado=DB::update("CALL actualizarEstado(".$datos->estado.",$id)");
        return redirect()->route("index_habitaciones");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
