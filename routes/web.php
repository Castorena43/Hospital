<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->get('/', 'Prueba\WelcomeController@datos');
Route::get('/welcome', 'Prueba\WelcomeController@datos');

Route::middleware('auth')->get('/especialidad', function () {
    return view('especialidad');
});
Route::middleware('auth')->post('/especialidad/guardar','Prueba\Especialidad@Guardar');
Route::middleware('auth')->post('/especialidad/eliminar/{id}','Prueba\Especialidad@Eliminar');
Route::middleware('auth')->post('/especialidad/editar/{id}','Prueba\Especialidad@Actualizar');
Route::middleware('auth')->get('/especialidad','Prueba\Especialidad@datos');

Route::middleware('auth')->get('/paciente', function () {
    return view('paciente');
});
Route::middleware('auth')->post('/paciente/guardar','Prueba\PacienteController@Guardar');
Route::middleware('auth')->post('/paciente/eliminar/{id}','Prueba\PacienteController@Eliminar');
Route::middleware('auth')->post('/paciente/editar/{id}','Prueba\PacienteController@Actualizar');
Route::middleware('auth')->get('/paciente','Prueba\PacienteController@datos');

Route::middleware('auth')->get('/consultorio', function () {
    return view('consultorio');
});
Route::middleware('auth')->post('/consultorio/guardar','Prueba\ConsultorioController@Guardar');
Route::middleware('auth')->post('/consultorio/eliminar/{id}','Prueba\ConsultorioController@Eliminar');
Route::middleware('auth')->post('/consultorio/editar/{id}','Prueba\ConsultorioController@Actualizar');
Route::middleware('auth')->get('/consultorio','Prueba\ConsultorioController@datos');

Route::middleware('auth')->get('/doctor', function () {
    return view('doctor');
});
Route::middleware('auth')->post('/doctor/guardar','Prueba\DoctorController@Guardar');
Route::middleware('auth')->post('/doctor/eliminar/{id}','Prueba\DoctorController@Eliminar');
Route::middleware('auth')->post('/doctor/editar/{id}','Prueba\DoctorController@Actualizar');
Route::middleware('auth')->get('/doctor','Prueba\DoctorController@datos');

Route::middleware('auth')->get('/usuario', function () {
    return view('usuario');
});
Route::middleware('auth')->post('/usuario/guardar','Prueba\UsuarioController@Guardar');
Route::middleware('auth')->post('/usuario/eliminar/{id}','Prueba\UsuarioController@Eliminar');
Route::middleware('auth')->post('/usuario/editar/{id}','Prueba\UsuarioController@Actualizar');
Route::middleware('auth')->get('/usuario','Prueba\UsuarioController@datos');

Route::middleware('auth')->get('/cita', function () {
    return view('cita');
});
Route::middleware('auth')->post('/cita/guardar','Prueba\CitaController@Guardar');
Route::middleware('auth')->post('/cita/eliminar/{id}','Prueba\CitaController@Eliminar');
Route::middleware('auth')->post('/cita/editar/{id}','Prueba\CitaController@Actualizar');
Route::middleware('auth')->get('/cita','Prueba\CitaController@datos');
Route::middleware('auth')->post('/cita/cargardoctor/{id}','Prueba\CitaController@cargardoctor');

Auth::routes();

Route::middleware('auth')->get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->post('generar','Prueba\UsuarioController@generar');
Route::middleware('auth')->post('eliminartoken','Prueba\UsuarioController@eliminartoken');
Route::middleware('auth')->get('/profile', function(){
    return view('/profile');
});


