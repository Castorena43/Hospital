<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PacienteController extends Controller
{
    //
    public function datos(){
        $data = \App\Modelos\Paciente::all()->toArray();
        return view('paciente',["datos"=>$data]);
    }

    public function Guardar(Request $request){
        $request->validate([
            "nombre"=>"required|String",
            "apellido_paterno"=>"required|String",
            "apellido_materno"=>"required|String",
            "nss"=>"required|String",
            "direccion"=>"required|String",
            "telefono"=>"required|String"
        ]);
        $paciente = new \App\Modelos\Paciente();
        $paciente->nombre = $request->nombre;
        $paciente->apellido_paterno = $request->apellido_paterno;
        $paciente->apellido_materno = $request->apellido_materno;
        $paciente->nss = $request->nss;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        if($paciente->save())
            return response()->json(['paciente'=>$paciente],200);
        return response()->json(402);
    }

    public function Eliminar(Request $request){
        $id=$request->id;
        $paciente = \App\Modelos\Paciente::findOrFail($id);
        if($request->ajax())
        {
            $paciente->delete();
            
        }else{
            $paciente->delete();
            return response()->json("Exito",200);
        }
    }
    public function Actualizar(Request $request,$id){
        
        $paciente = \App\Modelos\Paciente::findOrFail($id);
        $paciente->nombre = $request->nombre;
        $paciente->apellido_paterno = $request->apellido_paterno;
        $paciente->apellido_materno = $request->apellido_materno;
        $paciente->nss = $request->nss;
        $paciente->direccion = $request->direccion;
        $paciente->telefono = $request->telefono;
        $paciente->save();
        if($paciente->save())
            return response()->json($paciente);
    }
}
