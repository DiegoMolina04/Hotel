<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\pqrs;

class pqrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function redireccionar(){

        redirect()->route('pqrs.index');
    }

    public function index()
    {
        return view('clients.pqrs.index',['user' =>(object) [
            'rol' => 0, //si es cliente enviar 0
            'name' => 'Cliente',
        ]]);
        /*$pqrs=pqrs::all();
        return $pqrs;*/

        //return view('clients.dashboard');
    }

    /*
    C -> Crear -> Create
    R -> Leer -> Read
    U -> Actualizar -> Update
    D -> Eliminar -> Delete
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pqrs = new pqrs;
        $pqrs->id_tipo_pqrs=$request->input('requerimiento');;
        $pqrs->id_cliente=Auth::user()->id;
        $pqrs->descripcion=$request->input('descripcion');
        $pqrs->id_trabajador=null;
        $pqrs->respuesta=null;
        $pqrs->created_at=date("Y-m-d H:i:s");
        $pqrs->updated_at=date("Y-m-d H:i:s");
        $pqrs->save();

        return redirect()->route('pqrs.index');

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
