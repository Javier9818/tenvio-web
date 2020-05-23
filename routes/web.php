<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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


Route::get('/intranet', 'empresaController@verEmpresa')->middleware('can:visit-company');
Route::get('/intranet/empleados', 'generalController@vistaEmpleados')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/nuevo-empleado', 'generalController@vistaNuevoEmpleado')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/empleado/edit/{id}', 'empleadoController@edit')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/configuraciones', 'generalController@vistaConfiguraciones')->middleware('can:edit-company, visit-company');
Route::get('/intranet/ventas', function () {return view('admin.negocio.ventas');})->middleware('can:gestionar-contabilidad, visit-company');
Route::get('/intranet/pagos', function () {return view('admin.negocio.pagos');})->middleware('can:gestionar-contabilidad, visit-company');
Route::get('/intranet/pedidos', function () {return view('admin.pedidos.pedidos');})->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos-cocina', function () {return view('admin.pedidos.pedidosRecepcion');})->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/asignar-delivery', function () {return view('admin.pedidos.asignacionDelivery');})->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/transporte', function () {return view('admin.transporte.transporte');})->middleware('can:gestionar-entregas, visit-company');


Route::any('/extras/{funcion}', 'ExtrasController@fn');

Route::get('/intranet/categorias', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/{funcion}', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::get('/intranet/productos', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/productos/{funcion}', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');


Route::get('/admin/empresas', 'adminController@listarEmpresas')->name('admin-total-inicio')->middleware('can:gestionar-panel-general');
Route::get('/admin/empresa/{idEmpresa}', 'adminController@verEmpresa')->middleware('can:gestionar-panel-general');

Auth::routes();
Route::get('/login', function(){return view('front.login');})->name('loginForm');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::get('/perfil', 'UserController@getUser')->middleware('auth');

/* CLIENTE **/
Route::get('/', function(){return view('front.index');});
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/cart', function(){return view('front.cart');});


Route::get('/list','empresaController@listarEmpresas');
