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


Route::get('/intranet', 'empresaController@verEmpresa')->middleware('auth');
Route::get('/intranet/empleados', function () {return view('admin.negocio.empleados', ["empresa" => Session::get('empresa')]);})->middleware('auth');
Route::get('/intranet/nuevo-empleado', function () {return view('admin.negocio.crearEmpleado', ["empresa" => Session::get('empresa')]);})->middleware('auth');
Route::get('/intranet/empleado/edit/{id}', 'empleadoController@edit')->middleware('auth');
Route::get('/intranet/ventas', function () {return view('admin.negocio.ventas');})->middleware('auth');
Route::get('/intranet/pagos', function () {return view('admin.negocio.pagos');})->middleware('auth');
Route::get('/intranet/pedidos', function () {return view('admin.pedidos.pedidos');})->middleware('auth');
Route::get('/intranet/pedidos-cocina', function () {return view('admin.pedidos.pedidosRecepcion');})->middleware('auth');
Route::get('/intranet/asignar-delivery', function () {return view('admin.pedidos.asignacionDelivery');})->middleware('auth');
Route::get('/intranet/transporte', function () {return view('admin.transporte.transporte');})->middleware('auth');


Route::get('/intranet/categorias', 'CategoriasMenusController@fn')->middleware('auth');
Route::post('/intranet/categorias/{funcion}', 'CategoriasMenusController@fn')->middleware('auth');
Route::get('/intranet/productos', 'ProductosController@fn')->middleware('auth');
Route::post('/intranet/productos/{funcion}', 'ProductosController@fn')->middleware('auth');


Route::get('/admin/empresas', 'adminController@listarEmpresas')->name('admin-total-inicio')->middleware('auth');
Route::get('/admin/empresa/{idEmpresa}', 'adminController@verEmpresa')->middleware('auth');

Auth::routes();
Route::get('/login', function(){return view('front.login');})->name('loginForm');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::get('/perfil', 'UserController@getUser');
Route::get('/home', 'HomeController@index')->name('home');

/* CLIENTE **/
Route::get('/', function(){return view('front.index');});
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/cart', function(){return view('front.cart');});


Route::get('/list', function(){ return view('front.listEmpresa');});
