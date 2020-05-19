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

Route::get('/intranet', 'empresaController@verEmpresa');
Route::get('/intranet/empleados', function () {return view('admin.negocio.empleados', ["empresa" => Session::get('empresa')]);});
Route::get('/intranet/nuevo-empleado', function () {return view('admin.negocio.crearEmpleado', ["empresa" => Session::get('empresa')]);});
Route::get('/intranet/empleado/edit/{id}', 'empleadoController@edit');
// Route::get('/intranet/empleados', function () {return view('admin.negocio.empleados');});
Route::get('/intranet/ventas', function () {return view('admin.negocio.ventas');});
Route::get('/intranet/pagos', function () {return view('admin.negocio.pagos');});
//Route::get('/intranet/categorias', function () {return view('admin.menu.categorias');});
//Route::get('/intranet/productos', function () {return view('admin.menu.productos');});
Route::get('/intranet/pedidos', function () {return view('admin.pedidos.pedidos');});
Route::get('/intranet/pedidos-cocina', function () {return view('admin.pedidos.pedidosRecepcion');});
Route::get('/intranet/asignar-delivery', function () {return view('admin.pedidos.asignacionDelivery');});
Route::get('/intranet/transporte', function () {return view('admin.transporte.transporte');});


Route::get('/intranet/categorias', 'CategoriasMenusController@fn');
Route::post('/intranet/categorias/{funcion}', 'CategoriasMenusController@fn');
Route::get('/intranet/productos', 'ProductosController@fn');
Route::post('/intranet/productos/{funcion}', 'ProductosController@fn');


Route::get('/admin/empresas', 'adminController@listarEmpresas');
Route::get('/admin/empresa/{idEmpresa}', 'adminController@verEmpresa');

//Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/* CLIENTE **/
Route::get('/', function(){return view('front.index');});
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/cart', function(){return view('front.cart');});
Route::get('/login', function(){return view('front.login');});

Route::get('/list', function(){
    return view('front.listEmpresa');
});
