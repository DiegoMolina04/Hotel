<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\pqrs;
use App\Models\tipo_pqrs;
use App\Models\User;

class gestionPqrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $pqrs=pqrs::all();
        
    //     $data=[];
    //     foreach($pqrs as $pqr){

    //         $nombre_cliente=User::find($pqr->id_cliente);
    //         $pqr->id_cliente=$nombre_cliente->nombre;

    //         $tipo_pqr=tipo_pqrs::find($pqr->id_tipo_pqrs);
    //         $pqr->id_tipo_pqrs=$tipo_pqr->nombre;

    //         $nombre_trabajador=User::find($pqr->id_trabajador);
    //         //No permite leer nulls
    //         try {
    //             $pqr->id_trabajador=$nombre_trabajador->nombre;
    //         } catch (\Throwable $th) {
    //             $pqr->id_trabajador="";
    //         }

            
    //     };

    //     return view('admin.pqrs.index',['user' =>(object) [
    //         'rol' => 0, //si es cliente enviar 0
    //         'name' => 'Cliente',
    //         ]], compact('pqrs'));

    // }

    public function index(Request $request){
        
        //Auth::logout();
        $filtro=$request->get('filtro');
        $tipo_filtro=$request->get('tipo_filtro');
        
        //$pqrs=pqrs::all();
        // $pqrs=pqrs::all();

        // return view('admin.pqrs.index',['user' =>(object) [
        //     'rol' => 0, //si es cliente enviar 0
        //     'name' => 'Cliente',
        // ]], compact('pqrs', 'filtro'));

        //if($filtro == ''||($filtro == '' && $tipo_filtro == 1)){
        if(empty($filtro)){
            $pqrs=pqrs::all();
            //showInfo($pqrs);
            
        }else{
            
            switch ($tipo_filtro) {
                case '1':
                    //$pqrs=pqrs::all();
                    $user=DB::select('select * from users where nombre = ?', [$filtro]);
                    try {
                        $user=$user[0]->id;
                        $pqrs=DB::select('select * from pqrs where id_cliente = ?', [$user]);
                        //showInfo($pqrs);
                    } catch (\Throwable $th) {
                        $pqrs=pqrs::all();
                    }
                    break;
                case '2':
                    $tipo_pqrs=DB::select('select * from tipo_pqrs where nombre = ?', [$filtro]);
                    try {
                        $tipo_pqrs=$tipo_pqrs[0]->id;
                        $pqrs=DB::select('select * from pqrs where id_tipo_pqrs = ?', [$tipo_pqrs]);
                        //showInfo($pqrs);
                    } catch (\Throwable $th) {
                        $pqrs=pqrs::all();
                    }
                    break;
  
            }

            // foreach($pqrs as $pqr){

            //     $nombre_cliente=User::find($pqr->id_cliente);
            //     $pqr->id_cliente=$nombre_cliente->nombre;
    
            //     $tipo_pqr=tipo_pqrs::find($pqr->id_tipo_pqrs);
            //     $pqr->id_tipo_pqrs=$tipo_pqr->nombre;
    
            //     $nombre_trabajador=User::find($pqr->id_trabajador);
            //     //No permite leer nulls
            //     try {
            //         $pqr->id_trabajador=$nombre_trabajador->nombre;
            //     } catch (\Throwable $th) {
            //         $pqr->id_trabajador="";
            //     }
    
            //     return view('admin.pqrs.index',['user' =>(object) [
            //         'rol' => 0, //si es cliente enviar 0
            //         'name' => 'Cliente',
            //     ]], compact('pqrs', 'filtro'));
            //};
    
            
            
            //return $request;
            //$pqrs=DB::select('select * from pqrs where id = ?', [$filtro]);
            //$pqrs=DB::select('select * from pqrs where id = ?', [$filtro]);
            //$user=DB::select('select * from users where nombre LIKE C', [$filtro]);
            //$tipo_pqrs=DB::select('select * from tipo_pqrs where nombre = ?', [$filtro]);

            
            //$pqrs=$user;
        }

        foreach($pqrs as $pqr){

            $nombre_cliente=User::find($pqr->id_cliente);
            $pqr->id_cliente=$nombre_cliente->nombre;

            $tipo_pqr=tipo_pqrs::find($pqr->id_tipo_pqrs);
            $pqr->id_tipo_pqrs=$tipo_pqr->nombre;

            $nombre_trabajador=User::find($pqr->id_trabajador);
            //No permite leer nulls
            try {
                $pqr->id_trabajador=$nombre_trabajador->nombre;
            } catch (\Throwable $th) {
                $pqr->id_trabajador="";
            }

        };
        return view('admin.pqrs.index',['user' =>(object) [
            'rol' => 0, //si es cliente enviar 0
            'name' => 'Cliente',
        ]], compact('pqrs', 'filtro'));

        // foreach($pqrs as $pqr){

        //         $nombre_cliente=User::find($pqr->id_cliente);
        //         $pqr->id_cliente=$nombre_cliente->nombre;
    
        //         $tipo_pqr=tipo_pqrs::find($pqr->id_tipo_pqrs);
        //         $pqr->id_tipo_pqrs=$tipo_pqr->nombre;
    
        //         $nombre_trabajador=User::find($pqr->id_trabajador);
        //         //No permite leer nulls
        //         try {
        //             $pqr->id_trabajador=$nombre_trabajador->nombre;
        //         } catch (\Throwable $th) {
        //             $pqr->id_trabajador="";
        //         }
    
        //         return view('admin.pqrs.index',['user' =>(object) [
        //             'rol' => 0, //si es cliente enviar 0
        //             'name' => 'Cliente',
        //         ]], compact('pqrs', 'filtro'));
        //     };

        // $pqrs=DB::table('pqrs')
        //         ->select('id','id_tipo_pqrs','id_cliente','descripcion','id_trabajador','respuesta')
        //         ->where('id','=','%'.$filtro.'%')
        //         ->orWhere('id_tipo_pqrs','=','%'.$filtro.'%')
        //         ->orderBy('id', 'asc');

        //$pqrs=DB::select('select * from pqrs where id = 7');
        /*$pqrs=DB::table('pqrs')
                ->select('*')
                ->where('descripcion','LIKE','%'.$filtro.'%')
                ->orWhere('respuesta','LIKE','%'.$filtro.'%')
                ->orderBy('descripcion', 'asc');*/

        //$pqrs=DB::select('select id from users where nombre = ?', [$nombre]);

        
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
        $pqr=pqrs::findOrFail($id);
        $nombre_cliente=User::find($pqr->id_cliente);
        $pqr->id_cliente=$nombre_cliente->nombre;

        $tipo_pqr=tipo_pqrs::find($pqr->id_tipo_pqrs);
        $pqr->id_tipo_pqrs=$tipo_pqr->nombre;

        //Se coloca unicamente el id del usuario actual
        $nombre_trabajador=User::find(Auth::user()->id);
        //No permite leer nulls
        try {
            $pqr->id_trabajador=$nombre_trabajador->nombre;
        } catch (\Throwable $th) {
            $pqr->id_trabajador="";
        }

        //return $pqr;
        return view('admin.pqrs.edit', compact('pqr'));
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
        $pqr=pqrs::findOrFail($id);
        $pqr->respuesta=$request->input('respuesta');
        $pqr->id_trabajador=Auth::user()->id;
        $pqr->save();

        return redirect()->route('gestion-pqrs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pqr=pqrs::findOrFail($id);
        $pqr->delete();

        return redirect()->route('gestion-pqrs.index');
    }

    public function destroyView($id){

    }
}
