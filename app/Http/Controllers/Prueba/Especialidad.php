<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Especialidad extends Controller
{
    //
    public function datos(){
        $data = \App\Modelos\Especialidad::all()->toArray();
        return view('especialidad',["datos"=>$data]);
    }

    public function Guardar(Request $request){
        $request->validate([
            "nombre"=>"required|String",
            "descripcion"=>"required|String"
        ]);
        $especialidad = new \App\Modelos\Especialidad();
        $especialidad->nombre = $request->nombre;
        $especialidad->descripcion = $request->descripcion;
        $especialidad->save();
        return response()->json(['especialidad'=>$especialidad],200);
    }

    public function Eliminar(Request $request){
        $id=$request->id;
        $especialidad = \App\Modelos\Especialidad::findOrFail($id);
        if($request->ajax())
        {
            $especialidad->delete();
            
        }else{
            $especialidad->delete();
            return response()->json("Exito",200);
        }
    }
    public function Actualizar(Request $request,$id){
        
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $especialidad = \App\Modelos\Especialidad::findOrFail($id);
        $especialidad->nombre=$request->nombre;
        $especialidad->descripcion=$request->descripcion;
        if($especialidad->save())
            
            if($request->ajax())
            {
                return response()->json($especialidad);
                
            }else{
                
                return response()->json("Exito",200);
            }
    }
}
