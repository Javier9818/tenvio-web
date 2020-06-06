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


Route::get('/intranet', 'EmpresaController@verEmpresa')->middleware('can:visit-company');
Route::get('/intranet/empleados', 'GeneralController@vistaEmpleados')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/nuevo-empleado', 'GeneralController@vistaNuevoEmpleado')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/empleado/edit/{id}', 'EmpleadoController@edit')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/configuraciones', 'GeneralController@vistaConfiguraciones')->middleware('can:edit-company, visit-company');
Route::get('/intranet/ventas', function () {return view('admin.negocio.ventas');})->middleware('can:gestionar-contabilidad, visit-company');
Route::get('/intranet/pagos', function () {return view('admin.negocio.pagos');})->middleware('can:gestionar-contabilidad, visit-company');

Route::get('/intranet/transporte', function () {return view('admin.transporte.transporte');})->middleware('can:gestionar-entregas, visit-company');

//Route::get('/intranet/pedidos-cocina', function () {return view('admin.pedidos.pedidosRecepcion');})->middleware('can:gestionar-pedidos, visit-company');
//Route::get('/intranet/pedidos', function () {return view('admin.pedidos.pedidos');})->middleware('can:gestionar-pedidos, visit-company');
//Route::get('/intranet/asignar-delivery', function () {return view('admin.pedidos.asignacionDelivery');})->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/asignar-delivery', 'PedidosController@fn3')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos-cocina', 'PedidosController@fn2')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos', 'PedidosController@fn')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/{funcion}', 'PedidosController@fn')->middleware('can:gestionar-pedidos, visit-company');


Route::get('/intranet/categorias', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/{funcion}', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::get('/intranet/productos', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/productos/{funcion}', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');

Route::any('/extras/{funcion}', 'ExtrasController@fn');

Route::get('/admin/empresas', 'AdminController@listarEmpresas')->name('admin-total-inicio')->middleware('can:gestionar-panel-general');
Route::get('/admin/empresa/{idEmpresa}', 'AdminController@verEmpresa')->middleware('can:gestionar-panel-general');

Auth::routes();
Route::get('/login', function(){return view('front.login');})->name('loginForm');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::get('/registro', function(){
    return view('front/regist');
})->name('registro');
Route::get('/perfil', 'UserController@getUser')->middleware('auth');

/* CLIENTE **/
// Route::get('/', function(){return view('front.index');});
Route::get('/', 'FrontController@categoriasIndex')->name('inicio');
//Route::get('/lista', function(){return view('front.empresa');});
 Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/cart', function(){return view('front.cart');});
Route::get('/pedidos', function(){return view('front.pedidos');});
Route::get('/list', 'FrontController@ListEmpresas')->name('list');
Route::get('/list/{Categoria}', 'FrontController@BuscaxCategoria')->name('BuscaxCategoria');
Route::get('/seguimiento/{cifrado}', 'FrontController@seguimiento')->name('seguimiento');
Route::get('/empresa/{nombre}', 'FrontController@Empresa')->name('empresa');
Route::post('/front/{opcion}', 'FrontController@Funciones')->name('Front');
Route::get('/profile', 'UserController@getUser2')->middleware('auth');
//Route::get('/list', function(){ return view('front.listEmpresa');});

//Route::get('/list','EmpresaController@listarEmpresas');
