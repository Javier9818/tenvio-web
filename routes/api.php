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

Route::get('/roles', 'GeneralController@roles');
Route::get('/ciudades/{distrito}', 'GeneralController@ciudades');
Route::get('/categorias', 'GeneralController@categoriasEmpresa');
Route::get('/cargos', 'GeneralController@cargosEmpleado');
Route::get('/username/{username}', 'GeneralController@validateUsername');
Route::get('/email/{email}', 'GeneralController@validateEmail');

Route::post('/empleado', 'EmpleadoController@setEmpleado');
Route::put('/empleado', 'EmpleadoController@updateEmpleado');
Route::get('/empleados/{empresa}', 'EmpleadoController@listByEmpresa');

Route::post('/empresa', 'EmpresaController@setEmpresa');
Route::put('/empresa/{empresa}', 'EmpresaController@updateEmpresa');
Route::put('/fotoEmpresa/{empresa}', 'EmpresaController@updateFoto');

Route::get('/tipo-entregas/{empresa}', 'EmpresaController@tiposEntrega');
Route::put('/tipo-entregas', 'EmpresaController@updateTipoEntrega');

Route::get('/nombre-unico/{empresa}', 'EmpresaController@nombreUnico');
Route::post('/nombre-unico', 'EmpresaController@validaNombreUnico');
Route::put('/nombre-unico', 'EmpresaController@updateNombreUnico');


Route::put('/fotoPerfil/{empresa}', 'UserController@updateFoto');
Route::put('/user', 'UserController@updateUser');
Route::put('/pass', 'UserController@updatePassword');
Route::post('/usuarios', 'UserController@setUser');

Route::get('/notifications/{empresa}', 'GeneralController@notification');
Route::get('/detallePedido/{pedido}', 'PedidosController@show');
Route::post('/entregaPedido', 'PedidosController@entregar');
