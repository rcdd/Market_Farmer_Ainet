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

 // users
Route::get('users', ['middleware'=>'is.admin','uses' => 'UserController@list']);
Route::get('users/edit/{id}', ['middleware'=>'is.own','middleware'=>'is.admin','uses' => 'UserController@edit']);
Route::post('users/update/{id}', ['middleware'=>'auth','uses' => 'UserController@update']);
Route::get('/register', 'UserController@register');
Route::post('/register', 'UserController@store');
Route::get('/ownAds/{id}', 'UserController@viewOwnAdvertisements');
//Route::post('users/delete/{id}', ['middleware'=>'auth', 'uses' => 'UserController@delete']);


// products
Route::get('/advertisement/index', ['uses' => 'AdvertisementController@index']);
Route::get('/advertisement/view/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@viewAdvertisement']);
Route::get('/advertisement/new', ['middleware'=>'auth','uses' => 'AdvertisementController@newAdvertisement']);
Route::post('/advertisement/save', ['middleware'=>'auth','uses' => 'AdvertisementController@add']);
Route::get('/advertisement/destroy/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@destroy']);

// images router
Route::get('/images/profile/{id}', 'MediaController@getImageProfile');
Route::get('/images/ads/{id}', 'MediaController@getImageAds');

//comments
Route::post('/comment/new', ['middleware'=>'auth', 'uses' => 'CommentsController@insert']);

//miscelaneous
Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/', function () {
	$title = "Market Farm";
    return view('welcome', compact('title'));
});

Route::get('/test', function () {
    return view('test');
});