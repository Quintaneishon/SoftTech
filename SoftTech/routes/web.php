<?php

Route::get('/','Auth\LoginController@showLogin')->name("login");

Route::get('/usuarios', 'UserController@index')->middleware('auth');

Route::get('/usuarios/{id}','UserController@show')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/nuevo','UserController@createDesarrollador');

Route::post('/usuarios/crearDesarrollador', 'UserController@storeDesarrollador');

Route::post('/login','Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');
