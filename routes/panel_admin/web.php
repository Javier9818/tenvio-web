<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/empresas', 'AdminController@listarEmpresas')->name('admin-total-inicio')->middleware('can:gestionar-panel-general');
Route::get('/admin/solicitudes', 'AdminController@listarSolicitudes')->middleware('can:gestionar-panel-general');
Route::get('/admin/tipoNegocio', 'AdminController@tipoNegocio')->middleware('can:gestionar-panel-general');
Route::get('/admin/empresa/{idEmpresa}', 'AdminController@verEmpresa')->middleware('can:gestionar-panel-general');
Route::post('/admin/empresa/{tipo}', 'AdminController@funciones')->middleware('can:gestionar-panel-general');
Route::get('/admin/cobros', 'AdminController@vistaCobros')->middleware('can:gestionar-panel-general');
Route::post('/admin/cobros/{tipo}', 'AdminController@fn')->middleware('can:gestionar-panel-general');