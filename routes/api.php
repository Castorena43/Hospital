<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/especialidad/guardar','Prueba\Especialidad@Guardar');
Route::middleware('auth:api')->post('/especialidad/eliminar','Prueba\Especialidad@Eliminar');
Route::middleware('auth:api')->post('/especialidad/editar/{id}','Prueba\Especialidad@Actualizar');

Route::middleware('auth:api')->post('/paciente/guardar','Prueba\PacienteController@Guardar');
Route::middleware('auth:api')->post('/paciente/eliminar','Prueba\PacienteController@Eliminar');
Route::middleware('auth:api')->post('/paciente/editar/{id}','Prueba\PacienteController@Actualizar');

Route::middleware('auth:api')->post('/consultorio/guardar','Prueba\ConsultorioController@Guardar');
Route::middleware('auth:api')->post('/consultorio/eliminar','Prueba\ConsultorioController@Eliminar');
Route::middleware('auth:api')->post('/consultorio/editar/{id}','Prueba\ConsultorioController@Actualizar');

Route::middleware('auth:api')->post('/doctor/guardar','Prueba\DoctorController@Guardar');
Route::middleware('auth:api')->post('/doctor/eliminar','Prueba\DoctorController@Eliminar');
Route::middleware('auth:api')->post('/doctor/editar/{id}','Prueba\DoctorController@Actualizar');

Route::middleware('auth:api')->post('/usuario/guardar','Prueba\UsuarioController@Guardar');
Route::middleware('auth:api')->post('/usuario/eliminar','Prueba\UsuarioController@Eliminar');
Route::middleware('auth:api')->post('/usuario/editar/{id}','Prueba\UsuarioController@Actualizar');

Route::middleware('auth:api')->post('/cita/guardar','Prueba\CitaController@Guardar');
Route::middleware('auth:api')->post('/cita/eliminar','Prueba\CitaController@Eliminar');
Route::middleware('auth:api')->post('/cita/editar/{id}','Prueba\CitaController@Actualizar');

