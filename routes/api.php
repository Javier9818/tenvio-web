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
Route::get('/categorias/{tiponegocio}', 'GeneralController@categoriasEmpresa');
Route::get('/tipoNegocios', 'GeneralController@tipoNegociosEmpresa');
Route::get('/cargos', 'GeneralController@cargosEmpleado');
Route::get('/username/{username}', 'GeneralController@validateUsername');
Route::get('/email/{email}', 'GeneralController@validateEmail');

Route::post('/empleado', 'EmpleadoController@setEmpleado');
Route::put('/empleado', 'EmpleadoController@updateEmpleado');
Route::get('/empleados/{empresa}', 'EmpleadoController@listByEmpresa');

Route::post('/empresa', 'EmpresaController@setEmpresa');
Route::post('/activate/empresa', 'EmpresaController@activateEmpresa');
Route::post('/pre-registro/empresa', 'EmpresaController@preRegisterEmpresa');
Route::put('/empresa/{empresa}', 'EmpresaController@updateEmpresa');
Route::put('/fotoEmpresa/{empresa}', 'EmpresaController@updateFoto');
Route::post('/empresa/search', 'EmpresaController@search');

Route::get('/tipo-entregas/{empresa}', 'EmpresaController@tiposEntrega');
Route::put('/tipo-entregas', 'EmpresaController@updateTipoEntrega');

Route::get('/tipo-pago/{empresa}', 'TipopagoController@tiposPago');
Route::get('/tipo-pago-front/{empresa}', 'TipopagoController@tiposPagoFront');
Route::put('/tipo-pago', 'TipopagoController@updateTipoPago');

Route::get('/nombre-unico/{empresa}', 'EmpresaController@nombreUnico');
Route::get('/token-fb/{empresa}', 'EmpresaController@tokenFb');
Route::put('/token-fb', 'EmpresaController@updateTokenFb');
Route::post('/nombre-unico', 'EmpresaController@validaNombreUnico');
Route::put('/nombre-unico', 'EmpresaController@updateNombreUnico');


Route::post('/geo-position/{empresa}', 'EmpresaController@geoPosition');

Route::put('/fotoPerfil/{user}', 'UserController@updateFoto');
Route::put('/user', 'UserController@updateUser');
Route::put('/pass', 'UserController@updatePassword');
Route::post('/usuarios', 'UserController@setUser');

Route::get('/notifications/{empresa}', 'GeneralController@notification');

Route::get('/detallePedido/{pedido}', 'PedidosController@show');
Route::post('/entregaPedido', 'PedidosController@entregar');
Route::post('/cancelaPedido', 'PedidosController@cancelaByRepartidor');


Route::get('/bussiness-near/{lat}/{lng}', 'GeneralController@bussinessNear');