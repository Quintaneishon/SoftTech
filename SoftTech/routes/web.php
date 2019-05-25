<?php

Route::get('/','Auth\LoginController@showLogin')->name("login");

Route::get('/usuarios', 'UserController@index')->middleware('auth');

Route::get('/usuarios/{id}','UserController@show')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/nuevo','UserController@createUser');

Route::post('/usuarios/crearDesarrollador', 'UserController@storeDesarrollador');

Route::post('/usuarios/crearCliente', 'UserController@storeCliente');

Route::post('/login','Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/desarrollador/{id}','UserController@dashboardDesarrollador')->middleware('auth')->where('id','[0-9]+');

Route::post('/usuarios/crearTrato', 'UserController@crearTrato');

Route::get('/usuarios/contestar/{opcion}/{id}','UserController@contestar')->name('contestar')->middleware('auth');

Route::get('/cliente/{id}','UserController@dashboardCliente')->name('dashboard')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/eliminar/{id}','UserController@eliminarPeticion')->name('eliminar')->middleware('auth');

Route::post('/sendMessage','ProjectController@sendMessage');

Route::post('/crearAvance', 'ProjectController@crearAvance');