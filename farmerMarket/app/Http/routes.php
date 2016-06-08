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
Route::get('users', ['middleware'=>'auth','uses' => 'UserController@list']);

Route::get('users/edit/{id}', ['middleware'=>'auth','uses' => 'UserController@edit']);
Route::post('users/update/{id}', ['middleware'=>'auth','uses' => 'UserController@update']);

//Route::post('users/delete/{id}', ['middleware'=>'auth', 'uses' => 'UserController@delete']);

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/register', 'UserController@register');
Route::post('/register', 'UserController@store');


// products
Route::get('/advertisement/index', ['middleware'=>'auth','uses' => 'AdvertisementController@index']);
Route::get('/advertisement/view/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@viewAdvertisement']);
Route::get('/advertisement/new', ['middleware'=>'auth','uses' => 'AdvertisementController@newAdvertisement']);
Route::post('/advertisement/save', ['middleware'=>'auth','uses' => 'AdvertisementController@add']);

// images router
Route::get('/images/profile/{id}', 'MediaController@getImageProfile');
Route::get('/images/ads/{id}', 'MediaController@getImageAds');

//comments
Route::post('/comment/new', ['middleware'=>'auth', 'uses' => 'CommentsController@insert']);