<?php

Route::get('/','Auth\LoginController@showLogin');

Route::get('/usuarios', 'UserController@index')->middleware('auth');

Route::get('/usuarios/{id}','UserController@show')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/nuevo','UserController@create')->middleware('auth');

Route::post('/usuarios/crear', 'UserController@store')->middleware('auth');

Route::post('/login','Auth\LoginController@login');
