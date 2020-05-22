<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/roles', 'generalController@roles');
Route::get('/categorias', 'generalController@categoriasEmpresa');
Route::get('/tipo-entregas', 'generalController@tiposEntrega');
Route::get('/cargos', 'generalController@cargosEmpleado');
Route::get('/username/{username}', 'generalController@validateUsername');
Route::get('/email/{email}', 'generalController@validateEmail');

Route::post('/empleado', 'empleadoController@setEmpleado');
Route::put('/empleado', 'empleadoController@updateEmpleado');
Route::get('/empleados/{empresa}', 'empleadoController@listByEmpresa');
Route::post('/empresa', 'empresaController@setEmpresa');
Route::put('/empresa/{empresa}', 'empresaController@updateEmpresa');
Route::put('/fotoEmpresa/{empresa}', 'empresaController@updateFoto');

Route::put('/fotoPerfil/{empresa}', 'UserController@updateFoto');
Route::put('/user', 'UserController@updateUser');
Route::put('/pass', 'UserController@updatePassword');
