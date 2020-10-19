<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontController@categoriasIndex')->name('inicio');
Route::get('/quienes-somos', 'GeneralController@vistaPromocional');
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/micarrito', function(){return view('front.cart');})->middleware('auth');
Route::get('/micarrito-bot/{bot}', function($bot){$let = base64_decode($bot);return view('front.cart',['data'=>$let]);});
Route::get('/mipago/{id}', function($id){return view('front.detailPago',['id'=>$id]);})->middleware('auth');
Route::get('/pedidos', function(){return view('front.pedidos');})->middleware('auth');
Route::get('/list', 'FrontController@ListEmpresas')->name('list');
Route::get('/list/{Categoria}', 'FrontController@BuscaxCategoria')->name('BuscaxCategoria');
Route::get('/seguimiento/{cifrado}', 'FrontController@seguimiento')->name('seguimiento');
Route::get('/empresa/{nombre}', 'FrontController@Empresa')->name('empresa');
Route::post('/front/{opcion}', 'FrontController@Funciones')->name('Front');
Route::get('/mi-perfil', 'UserController@getUser2')->middleware('auth');
Route::get('/negocios-cercanos', 'GeneralController@viewBussinessNear')->name('negocios_cercanos');

Route::get('/{Ubicacion}', 'FrontController@BuscaxUbicacion')->name('BuscaxUbicacion');//RUTA DE BUSQUEDA SIEMPRE AL FINAL