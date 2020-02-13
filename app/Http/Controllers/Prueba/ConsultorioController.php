<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultorioController extends Controller
{
    public function datos(){
        $data = \App\Modelos\Consultorio::all()->toArray();
        return view('consultorio',["datos"=>$data]);
    }

    public function Guardar(Request $request){
        $request->validate([
            "nombre"=>"required|String"
        ]);
        $consultorio = new \App\Modelos\Consultorio();
        $consultorio->nombre = $request->nombre;
        $consultorio->save();
        return response()->json(['consultorio'=>$consultorio],200);
    }

    public function Eliminar(Request $request){
        $id=$request->id;
        $consultorio = \App\Modelos\Consultorio::findOrFail($id);
        if($request->ajax())
        {
            $consultorio->delete();
            
        }else{
            $consultorio->delete();
            return response()->json("Exito",200);
        }
    }
    public function Actualizar(Request $request,$id){
        $consultorio = \App\Modelos\Consultorio::findOrFail($id);
        $consultorio->nombre=$request->nombre;
        
        if($consultorio->save())
            return response()->json($consultorio);
    }
}
