<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function datos(){
        $data = DB::table('citas')
            ->join('doctors', 'doctors.id', '=', 'citas.doctor_id')
            ->join('consultorios', 'consultorios.id', '=', 'citas.consultorio_id')
            ->join('pacientes', 'pacientes.id', '=', 'citas.paciente_id')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('citas.*', 'especialidads.nombre as especialidad','doctors.nombre as doctor',
                    'consultorios.nombre as consultorio','pacientes.nombre as paciente')
            ->orderBy('id')
            ->get();
        $doctor = DB::table('doctors')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('doctors.*','especialidads.nombre as espNombre','especialidads.id as esp_id')
            ->get();
        $consultorio = DB::table('consultorios')
            ->select('consultorios.*')
            ->get();
        $paciente = DB::table('pacientes')
            ->select('pacientes.*')
            ->get();
        return view('cita',["datos"=>$data,
                    "paciente"=>$paciente, "doctor"=>$doctor,"consultorio"=>$consultorio
        ]);
    }
    public function Guardar(Request $request){
        $request->validate([
            "paciente_id"=>"required|Integer",
            "doctor_id"=>"required|Integer",
            "consultorio_id"=>"required|Integer"
        ]);
        $cita = new \App\Modelos\Cita();
        $cita->paciente_id = $request->paciente_id;
        $cita->doctor_id = $request->doctor_id;
        $cita->consultorio_id = $request->consultorio_id;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        if($cita->save())
            $data = DB::table('citas')
            ->join('doctors', 'doctors.id', '=', 'citas.doctor_id')
            ->join('consultorios', 'consultorios.id', '=', 'citas.consultorio_id')
            ->join('pacientes', 'pacientes.id', '=', 'citas.paciente_id')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('citas.*', 'especialidads.nombre as especialidad','doctors.nombre as doctor',
                    'consultorios.nombre as consultorio','pacientes.nombre as paciente')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
            //return response()->json(['doctor'=>$doctor],200);
        return response()->json(402);
    }
    public function Eliminar(Request $request){
        $id=$request->id;
        $cita = \App\Modelos\Cita::findOrFail($id);
        if($request->ajax())
        {
            $cita->delete();
            
        }else{
            $cita->delete();
            return response()->json("Exito",200);
        }
    }
    public function Actualizar(Request $request,$id){

        $cita = \App\Modelos\Cita::findOrFail($id);
        $cita->paciente_id = $request->paciente_id;
        $cita->doctor_id = $request->doctor_id;
        $cita->consultorio_id = $request->consultorio_id;
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->save();
        if($cita->save())
            $data = DB::table('citas')
            ->join('doctors', 'doctors.id', '=', 'citas.doctor_id')
            ->join('consultorios', 'consultorios.id', '=', 'citas.consultorio_id')
            ->join('pacientes', 'pacientes.id', '=', 'citas.paciente_id')
            ->join('especialidads', 'doctors.especialidad_id', '=', 'especialidads.id')
            ->select('citas.*', 'especialidads.nombre as especialidad','doctors.nombre as doctor',
                    'consultorios.nombre as consultorio','pacientes.nombre as paciente')
            ->orderBy('id','desc')
            ->first();
            return response()->json($data,202);
        return response()->json("Error",400);
    }
}
