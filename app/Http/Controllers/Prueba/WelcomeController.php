<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function datos(){
        $cita = \App\Modelos\Cita::all()->count();
        $paciente = \App\Modelos\Paciente::all()->count();
        $consultorio = \App\Modelos\Consultorio::all()->count();
        $doctor = \App\Modelos\Doctor::all()->count();
        $especialidad = \App\Modelos\Especialidad::all()->count();

        return view('welcome',[
            "cita"=>$cita,
            "paciente"=>$paciente,
            "doctor"=>$doctor,
            "consultorio"=>$consultorio,
            "especialidad"=>$especialidad
        ]);
    }
}
