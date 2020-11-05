<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/empresas', 'Admin\AdminController@listarEmpresas')->name('admin-total-inicio')->middleware('can:gestionar-panel-general');
Route::get('/admin/solicitudes', 'Admin\AdminController@listarSolicitudes')->middleware('can:gestionar-panel-general');
Route::get('/admin/tipoNegocio', 'Admin\AdminController@tipoNegocio')->middleware('can:gestionar-panel-general');
Route::get('/admin/empresa/{idEmpresa}', 'Admin\AdminController@verEmpresa')->middleware('can:gestionar-panel-general');
Route::post('/admin/empresa/{tipo}', 'Admin\AdminController@funciones')->middleware('can:gestionar-panel-general');
Route::get('/admin/cobros', 'Admin\AdminController@vistaCobros')->middleware('can:gestionar-panel-general');
Route::post('/admin/cobros/{tipo}', 'Admin\AdminController@fn')->middleware('can:gestionar-panel-general');