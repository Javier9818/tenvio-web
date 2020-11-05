<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente\FrontController;

Route::get('/', [FrontController::class, 'categoriasIndex'])->name('inicio');
Route::get('/list/{Categoria}', [FrontController::class, 'BuscaxCategoria'])->name('BuscaxCategoria');
Route::get('/seguimiento/{cifrado}', [FrontController::class, 'seguimiento'])->name('seguimiento');
Route::get('/empresa/{nombre}', [FrontController::class, 'Empresa'])->name('empresa');
Route::post('/front/{opcion}', [FrontController::class, 'Funciones'])->name('Front');
Route::get('/list', [FrontController::class, 'ListEmpresas'])->name('list');

Route::get('/ciudad', function(){return view('front.pages.city');});

Route::get('/quienes-somos', 'GeneralController@vistaPromocional');
Route::get('/empresa', function(){return view('front.empresa');});
Route::get('/micarrito', function(){return view('front.cart');})->middleware('auth');
Route::get('/micarrito-bot/{bot}', function($bot){$let = base64_decode($bot);return view('front.cart',['data'=>$let]);});
Route::get('/mipago/{id}', function($id){return view('front.detailPago',['id'=>$id]);})->middleware('auth');
Route::get('/pedidos', function(){return view('front.pedidos');})->middleware('auth');


Route::get('/mi-perfil', 'UserController@getUser2')->middleware('auth');
Route::get('/negocios-cercanos', 'GeneralController@viewBussinessNear')->name('negocios_cercanos');

Route::get('/{Ubicacion}', [FrontController::class, 'BuscaxUbicacion'])->name('BuscaxUbicacion');//RUTA DE BUSQUEDA SIEMPRE AL FINAL