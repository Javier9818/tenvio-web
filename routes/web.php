<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


// ================================================ CPANEL =================================================*/
Route::get('/comand-link', function (){Artisan::call('storage:link');});
Route::get('/comand-view', function (){Artisan::call('view:cache');});
// Route::get('/mongo', 'VisitController@show');


Route::get('/login', 'Auth\LoginController@show')->name('loginForm')->middleware('guest');
Route::post('/login', 'Auth\LoginController@authenticate')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/registro', 'Auth\LoginController@showRegister')->name('registro')->middleware('guest');
Route::get('/perfil', 'UserController@getUser')->middleware('auth');
Route::get('/recoverypassword/{cifrado}', 'FrontController@Recover')->name('Recover');

Route::get('/cars','CarController@index');
Route::get('/car/{id}','CarController@edit');
Route::put('/car/{id}','CarController@update');
Route::post('/car','CarController@store');
Route::get('/crear-carro','CarController@create');
