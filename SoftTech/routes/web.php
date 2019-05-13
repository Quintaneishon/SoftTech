<?php

Route::get('/','Auth\LoginController@showLogin')->name("login");

Route::get('/usuarios', 'UserController@index')->middleware('auth');

Route::get('/usuarios/{id}','UserController@show')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/nuevo','UserController@createUser');

Route::post('/usuarios/crearDesarrollador', 'UserController@storeDesarrollador');

Route::post('/usuarios/crearCliente', 'UserController@storeCliente');

Route::post('/login','Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/desarrollador/{id}','UserController@dashboard')->middleware('auth')->where('id','[0-9]+');

Route::post('/usuarios/crearTrato', 'UserController@crearTrato');