<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('admin.inicio');
});

Route::get('/empleados', function () {return view('admin.negocio.empleados');});
Route::get('/crearEmpleado', function () {return view('admin.negocio.crearEmpleado');});
Route::get('/empleados', function () {return view('admin.negocio.empleados');});
Route::get('/ventas', function () {return view('admin.negocio.ventas');});
Route::get('/pagos', function () {return view('admin.negocio.pagos');});
Route::get('/categorias', function () {return view('admin.menu.categorias');});
Route::get('/productos', function () {return view('admin.menu.productos');});
Route::get('/pedidos', function () {return view('admin.pedidos.pedidos');});
Route::get('/pedidos-cocina', function () {return view('admin.pedidos.pedidosRecepcion');});
Route::get('/asignar-delivery', function () {return view('admin.pedidos.asignacionDelivery');});
Route::get('/transporte', function () {return view('admin.transporte.transporte');});


Route::get('/superadmin/empresas', 'superAdminController@listarEmpresas');
Route::get('/superadmin/empresa/{idEmpresa}', 'superAdminController@verEmpresa');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// FRONT DELIVERY

Route::get('/test', function(){
    return view('front.index');
});

Route::get('/empresa', function(){
    return view('front.empresa');
});

Route::get('/cart', function(){
    return view('front.cart');
});

Route::get('/login', function(){
    return view('front.login');
});

Route::get('/list', function(){
    return view('front.listEmpresa');
});

