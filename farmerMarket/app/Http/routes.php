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
Route::get('users', ['middleware'=>'auth','UserController@list']);
//Route::get('users/create', 'UserController@create');
//Route::post('users/create', 'UserController@store');
Route::get('users/edit/{id}', ['middleware'=>'auth','UserController@edit']);
Route::post('users/delete/{id}', ['middleware'=>'auth', 'UserController@delete']);
//Route::post('login', 'UserController@l');


Route::post('login', ['middleware'=>'auth', function(){
	
}]);


Route::auth();
Route::get('/home', 'HomeController@index');
Route::post('/register', 'UserController@store');