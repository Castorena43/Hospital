<?php

namespace App\Http\Controllers\Prueba;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    //
    public function datos(){
        $data = \App\User::all()->toArray();
        return view('usuario',["datos"=>$data]);
    }

    public function Guardar(Request $request){
        $request->validate([
            "name"=>"required|String",
            "email"=>"required|email",
            "status"=>"required|Integer",
            "password"=>"required|String",

        ]);
        $usuario = new \App\User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->status = $request->status;
        $usuario->password = bcrypt($request->password);

        if($usuario->save())
            return response()->json(['usuario'=>$usuario],200);
        return response()->json(402);
    }

    public function Eliminar(Request $request){
        $id=$request->id;
        $usuario = \App\User::findOrFail($id);
        if($request->ajax())
        {
            $usuario->delete();

        }else{
            $usuario->delete();
            return response()->json('Eliminado',200);
            
        }
    }
    public function Actualizar(Request $request,$id){

        $request->validate([
            "name"=>"required|String",
            "email"=>"required|email",
            "status"=>"required|Integer",
            "password"=>"required|String",

        ]);
        $usuario = \App\User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->status = $request->status;
        $usuario->password = bcrypt($request->password);
        if($usuario->save())
            return response()->json($usuario);
    }
    public function generar(Request $request){
        $token = Str::random(80);

        Auth::user()->forceFill([
            'remember_token' => $token,
            'api_token' => hash('sha256', $token)
        ])->save();

        return response()->json(['token' => $token],200);
    }
    public function eliminartoken(Request $request){
        Auth::user()->forceFill([
            'remember_token' => null,
            'api_token' => null,
        ])->save();

        return 'done';
    }
}
