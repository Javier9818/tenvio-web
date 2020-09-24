<?php

use Illuminate\Support\Facades\Route;

Route::get('/intranet', 'Empresa\GeneralController@showCompany')->middleware('can:visit-company');
Route::get('/intranet/configuraciones', 'Empresa\GeneralController@showConfigurations')->middleware('can:edit-company, visit-company');
Route::get('/intranet/ubicacion', 'Empresa\GeneralController@showLocation')->middleware('can:edit-company, visit-company');
Route::get('/intranet/transporte', 'Empresa\GeneralController@showTransport')->middleware('can:gestionar-entregas, visit-company');


Route::get('/intranet/empleados', 'Empresa\EmpleadoController@showEmployees')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/nuevo-empleado', 'Empresa\EmpleadoController@showNewEmployee')->middleware('can:gestionar-personal, visit-company');
Route::get('/intranet/empleado/edit/{id}', 'Empresa\EmpleadoController@editEmployee')->middleware('can:gestionar-personal, visit-company');



Route::get('/intranet/ventas', 'ContabilidadController@fn1')->middleware('can:gestionar-contabilidad, visit-company');
Route::get('/intranet/pagos', 'ContabilidadController@fn2')->middleware('can:gestionar-contabilidad, visit-company');
Route::post('/intranet/ventas/{funcion}', 'ContabilidadController@fn')->middleware('can:gestionar-contabilidad, visit-company');
Route::post('/intranet/pagos/{funcion}', 'ContabilidadController@fn')->middleware('can:gestionar-contabilidad, visit-company');

Route::get('/intranet/asignar-delivery', 'Empresa\PedidosController@vista_asignar')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/estado-pedido', 'Empresa\PedidosController@vista_estado')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos-cocina', 'Empresa\PedidosController@vista_cocina')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/pedidos', 'Empresa\PedidosController@vista_pedidos')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/listartodo', 'Empresa\PedidosController@listartodo')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/listarrecepcion', 'Empresa\PedidosController@listarrecepcion')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/listardelivery', 'Empresa\PedidosController@listardelivery')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/listarempleados', 'Empresa\PedidosController@listarempleados')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/aceptar', 'Empresa\PedidosController@aceptar')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/cancelar', 'Empresa\PedidosController@cancelar')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/entregar', 'Empresa\PedidosController@entregar')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/asignar', 'Empresa\PedidosController@asignar')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/cancelartodos', 'Empresa\PedidosController@cancelartodos')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/ListaPedidos', 'Empresa\PedidosController@ListaPedidos')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/montoPedido', 'Empresa\PedidosController@montoPedido')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/MontoAsignacion', 'Empresa\PedidosController@MontoAsignacion')->middleware('can:gestionar-pedidos, visit-company');
Route::post('/intranet/pedidos/ListaAsignaciones', 'Empresa\PedidosController@ListaAsignaciones')->middleware('can:gestionar-pedidos, visit-company');
Route::get('/intranet/estado-pedido/{funcion}', 'Empresa\PedidosController@DetalleAsignacion')->middleware('can:gestionar-pedidos, visit-company');


Route::get('/intranet/categorias', 'Empresa\CategoriasMenusController@vista')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/listar', 'Empresa\CategoriasMenusController@listar')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/setupddel', 'Empresa\CategoriasMenusController@setupddel')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/categorias/listarvselect', 'Empresa\CategoriasMenusController@listarvselect')->middleware('can:gestionar-productos, visit-company');

Route::get('/intranet/productos', 'Empresa\ProductosController@vista')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/productos/listar', 'Empresa\ProductosController@listar')->middleware('can:gestionar-productos, visit-company');
Route::post('/intranet/productos/setupddel', 'Empresa\ProductosController@setupddel')->middleware('can:gestionar-productos, visit-company');

Route::any('/extras/{funcion}', 'ExtrasController@fn');
