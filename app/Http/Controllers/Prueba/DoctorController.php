<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function datos(){
        $data = \App\Modelos\Doctor::all()->toArray();
        $especialidad = \App\Modelos\Especialidad::all()->toArray();
        $data = DB::table('doctors')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('doctors.*', 'especialidads.nombre as especialidad')
            ->orderBy('id')
            ->get();
        $especialidad = DB::table('especialidads')
            ->select('especialidads.*')
            ->get();
        return view('doctor',["datos"=>$data,"especialidad"=>$especialidad]);
    }

    public function Guardar(Request $request){
        $request->validate([
            "nombre"=>"required|String",
            "apellido_paterno"=>"required|String",
            "apellido_materno"=>"required|String",
            "direccion"=>"required|String",
            "telefono"=>"required|String",
            "especialidad_id"=>"required|Integer",
        ]);
        $doctor = new \App\Modelos\Doctor();
        $doctor->nombre = $request->nombre;
        $doctor->apellido_paterno = $request->apellido_paterno;
        $doctor->apellido_materno = $request->apellido_materno;
        $doctor->direccion = $request->direccion;
        $doctor->telefono = $request->telefono;
        $doctor->especialidad_id = $request->especialidad_id;
        if($doctor->save())
            $data = DB::table('doctors')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('doctors.*', 'especialidads.nombre as especialidad')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
            //return response()->json(['doctor'=>$doctor],200);
        return response()->json(402);
    }

    public function Eliminar(Request $request){
        $id=$request->id;
        $doctor = \App\Modelos\Doctor::findOrFail($id);
        if($request->ajax())
        {
            $doctor->delete();
            
        }else{
            $doctor->delete();
            return response()->json("Exito",200);
        }
    }
    public function Actualizar(Request $request,$id){
        
        $doctor = \App\Modelos\Doctor::findOrFail($id);
        $doctor->nombre = $request->nombre;
        $doctor->apellido_paterno = $request->apellido_paterno;
        $doctor->apellido_materno = $request->apellido_materno;
        $doctor->direccion = $request->direccion;
        $doctor->telefono = $request->telefono;
        $doctor->especialidad_id = $request->especialidad_id;
        $doctor->save();
        if($doctor->save())
            $data = DB::table('doctors')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('doctors.*', 'especialidads.nombre as especialidad')
            ->where('doctors.id','=',$id)
            ->get();
            return response()->json($data,202);
    }
}
