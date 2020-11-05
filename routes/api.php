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

Route::post('/empleado', 'Empresa\EmpleadoController@setEmpleado');
Route::put('/empleado', 'Empresa\EmpleadoController@updateEmpleado');
Route::get('/empleados/{empresa}', 'Empresa\EmpleadoController@listByEmpresa');

Route::post('/empresa', 'Empresa\EmpresaController@setEmpresa');
Route::post('/activate/empresa', 'Empresa\EmpresaController@activateEmpresa');
Route::post('/pre-registro/empresa', 'Empresa\EmpresaController@preRegisterEmpresa');
Route::put('/empresa/{empresa}', 'Empresa\EmpresaController@updateEmpresa');
Route::put('/fotoEmpresa/{empresa}', 'Empresa\EmpresaController@updateFoto');
Route::post('/empresa/search', 'Empresa\EmpresaController@search');

Route::get('/tipo-entregas/{empresa}', 'Empresa\EmpresaController@tiposEntrega');
Route::put('/tipo-entregas', 'Empresa\EmpresaController@updateTipoEntrega');

Route::get('/tipo-pago/{empresa}', 'TipopagoController@tiposPago');
Route::get('/tipo-pago-front/{empresa}', 'TipopagoController@tiposPagoFront');
Route::put('/tipo-pago', 'TipopagoController@updateTipoPago');

Route::get('/nombre-unico/{empresa}', 'Empresa\EmpresaController@nombreUnico');
Route::get('/token-fb/{empresa}', 'Empresa\EmpresaController@tokenFb');
Route::put('/token-fb', 'Empresa\EmpresaController@updateTokenFb');
Route::post('/nombre-unico', 'Empresa\EmpresaController@validaNombreUnico');
Route::put('/nombre-unico', 'Empresa\EmpresaController@updateNombreUnico');


Route::post('/geo-position/{empresa}', 'Empresa\EmpresaController@geoPosition');

Route::put('/fotoPerfil/{user}', 'UserController@updateFoto');
Route::put('/user', 'UserController@updateUser');
Route::put('/pass', 'UserController@updatePassword');
Route::post('/usuarios', 'UserController@setUser');

Route::get('/notifications/{empresa}', 'GeneralController@notification');

Route::get('/detallePedido/{pedido}', 'PedidosController@show');
Route::post('/entregaPedido', 'PedidosController@entregar');
Route::post('/cancelaPedido', 'PedidosController@cancelaByRepartidor');


Route::get('/bussiness-near/{lat}/{lng}', 'GeneralController@bussinessNear');

Route::post('/visit', 'VisitController@store');

//dashboard
Route::post('/empresa-dashboard', 'Empresa\EmpresaController@getQuanty_money_date');