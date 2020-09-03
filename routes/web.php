<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================================================ CPANEL =================================================*/
Route::get('/comand2', function (){Artisan::call('storage:link');});

// ================================================ LANDING PAGES =================================================*/
Route::get('/quienes-somos', 'GeneralController@vistaPromocional');
// Route::get('/indexv2',function (){ return view('front.components.index_alternativo');});


// ================================================ BLOQUE EMPRESA =================================================*/
Route::get('/intranet', 'EmpresaController@verEmpresa')->middleware('can:visit-company');
Route::get('/intranet/empleados', 'GeneralController@vistaEmpleados')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/nuevo-empleado', 'GeneralController@vistaNuevoEmpleado')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/empleado/edit/{id}', 'EmpleadoController@edit')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/configuraciones', 'GeneralController@vistaConfiguraciones')->middleware('can:edit-company, visit-company');
Route::get('/intranet/ubicacion', 'GeneralController@vistaUbicacion')->middleware('can:edit-company, visit-company');
Route::get('/intranet/transporte', 'GeneralController@vistaTransporte')->middleware('can:gestionar-entregas, visit-company');

Route::get('/intranet/ventas', 'ContabilidadController@fn1')->middleware('can:gestionar-contabilidad, visit-company');
Route::get('/intranet/pagos', 'ContabilidadController@fn2')->middleware('can:gestionar-contabilidad, visit-company');
Route::post('/intranet/ventas/{funcion}', 'ContabilidadController@fn')->middleware('can:gestionar-contabilidad, visit-company');
Route::post('/intranet/pagos/{funcion}', 'ContabilidadController@fn')->middleware('can:gestionar-contabilidad, visit-company');

Route::get('/intranet/asignar-delivery', 'PedidosController@fn3')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/estado-pedido', 'PedidosController@fn4')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/estado-pedido/{funcion}', 'PedidosController@DetalleAsignacion')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos-cocina', 'PedidosController@fn2')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos', 'PedidosController@fn')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/{funcion}', 'PedidosController@fn')->middleware('can:gestionar-pedidos, visit-company');


Route::get('/intranet/categorias', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/{funcion}', 'CategoriasMenusController@fn')->middleware('can:gestionar-productos, visit-company');
Route::get('/intranet/productos', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/productos/{funcion}', 'ProductosController@fn')->middleware('can:gestionar-productos, visit-company');

Route::any('/extras/{funcion}', 'ExtrasController@fn');

// ======================================== BLOQUE SUPER ADMINISTRADOR ===============================================*/
Route::get('/admin/empresas', 'AdminController@listarEmpresas')->name('admin-total-inicio')->middleware('can:gestionar-panel-general');
Route::get('/admin/solicitudes', 'AdminController@listarSolicitudes')->middleware('can:gestionar-panel-general');
Route::get('/admin/tipoNegocio', 'AdminController@tipoNegocio')->middleware('can:gestionar-panel-general');
Route::get('/admin/empresa/{idEmpresa}', 'AdminController@verEmpresa')->middleware('can:gestionar-panel-general');
Route::post('/admin/empresa/{tipo}', 'AdminController@funciones')->middleware('can:gestionar-panel-general');
Route::get('/admin/cobros', 'AdminController@vistaCobros')->middleware('can:gestionar-panel-general');
Route::post('/admin/cobros/{tipo}', 'AdminController@fn')->middleware('can:gestionar-panel-general');

// ======================================== BLOQUE AUTENTICACIÓN ====================================================*/
Route::get('/login', function(){return view('front.login');})->name('loginForm')->middleware('guest');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::post('/logout', function(){ Auth::logout(); return redirect('/');})->name('logout');
Route::get('/registro', function(){return view('front/regist');})->name('registro')->middleware('guest');
Route::get('/perfil', 'UserController@getUser')->middleware('auth');

Route::get('/recoverypassword/{cifrado}', 'FrontController@Recover')->name('Recover');

// ======================================== BLOQUE CLIENTE ==========================================================*/
Route::get('/', 'FrontController@categoriasIndex')->name('inicio');
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/micarrito', function(){return view('front.cart');})->middleware('auth');
Route::get('/pedidos', function(){return view('front.pedidos');})->middleware('auth');
Route::get('/list', 'FrontController@ListEmpresas')->name('list');
Route::get('/list/{Categoria}', 'FrontController@BuscaxCategoria')->name('BuscaxCategoria');
Route::get('/seguimiento/{cifrado}', 'FrontController@seguimiento')->name('seguimiento');
Route::get('/empresa/{nombre}', 'FrontController@Empresa')->name('empresa');
Route::post('/front/{opcion}', 'FrontController@Funciones')->name('Front');
Route::get('/mi-perfil', 'UserController@getUser2')->middleware('auth');
Route::get('/negocios-cercanos', 'GeneralController@viewBussinessNear')->name('negocios_cercanos');

Route::get('/{Ubicacion}', 'FrontController@BuscaxUbicacion')->name('BuscaxUbicacion');//RUTA DE BUSQUEDA SIEMPRE AL FINAL

