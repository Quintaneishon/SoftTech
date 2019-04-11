<?php

Route::get('/','Auth\LoginController@showLogin')->name("login");

Route::get('/usuarios', 'UserController@index')->middleware('auth');

Route::get('/usuarios/{id}','UserController@show')->middleware('auth')->where('id','[0-9]+');

Route::get('/usuarios/nuevo','UserController@create');

Route::post('/usuarios/crear', 'UserController@store');

Route::post('/login','Auth\LoginController@login');
