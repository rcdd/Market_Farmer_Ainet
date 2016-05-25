<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

 // EG.:
Route::get('users', 'UserController@list');
Route::get('users/create', 'UserController@create');
Route::post('users/create', 'UserController@store');
Route::get('users/edit/{id}', 'UserController@edit');
Route::post('users/delete/{id}', 'UserController@delete');
Route::post('login', 'UserController@login');
