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
Route::get('/users', ['middleware'=>'is.admin','uses' => 'UserController@list']);
Route::get('/users/edit/{id}', ['middleware'=>'auth','uses' => 'UserController@edit']);
Route::post('/users/update/{id}', ['middleware'=>'auth','uses' => 'UserController@update']);
Route::get('/users/delete/{id}', ['middleware'=>'is.admin','uses' => 'UserController@delete']);
Route::get('/users/revokeAdmin/{id}', ['middleware'=>'is.admin','uses' => 'UserController@revokeAdmin']);
Route::get('/users/becomeAdmin/{id}', ['middleware'=>'is.admin','uses' => 'UserController@becomeAdmin']);
Route::get('/users/blocked/{id}', ['middleware'=>'is.admin','uses' => 'UserController@blocked']);
Route::get('/users/unblocked/{id}', ['middleware'=>'is.admin','uses' => 'UserController@unBlocked']);
Route::get('/register', 'UserController@register');
Route::post('/register', 'UserController@store');
Route::get('/ownAds/{id}', ['middleware'=>'auth','uses' => 'UserController@viewOwnAdvertisements']);


// Advertisements
Route::get('/advertisement/index', ['uses' => 'AdvertisementController@index']);
Route::get('/advertisement/view/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@viewAdvertisement']);
Route::get('/advertisement/edit/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@edit']);
Route::post('/advertisement/edit/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@update']);
Route::get('/advertisement/new', ['middleware'=>'auth','uses' => 'AdvertisementController@newAdvertisement']);
Route::post('/advertisement/save', ['middleware'=>'auth','uses' => 'AdvertisementController@add']);
Route::get('/advertisement/destroy/{id}', ['middleware'=>'auth','uses' => 'AdvertisementController@destroy']);
Route::get('/advertisement/status/{id}', ['middleware'=>'is.admin','uses' => 'AdvertisementController@status']);
Route::get('/advertisement/blocked/', ['middleware'=>'is.admin','uses' => 'AdvertisementController@blocked']);

//bids
Route::post('/advertisement/view/{id}/bid', ['middleware'=>'auth', 'uses' => 'BidsController@placeBid']);
Route::get('/advertisement/view/{id}/viewBids', ['middleware'=>'auth', 'uses' => 'BidsController@viewBids']);
Route::get('/bids/view/{id}', ['middleware'=>'auth','uses' => 'BidsController@showMyBids']);
Route::get('/bids/delete/{id}', ['middleware'=>'auth','uses' => 'BidsController@cancelBid']);
Route::get('/bids/accept/{id}', ['middleware'=>'auth','uses' => 'BidsController@acceptBid']);
Route::get('/bids/refuse/{id}', ['middleware'=>'auth','uses' => 'BidsController@refuseBid']);
Route::post('/bids/change', ['middleware'=>'auth','uses' => 'BidsController@changeBid']);

// images 
Route::get('/images/profile/{id}', 'MediaController@getImageProfile');
Route::get('/images/ads/{id}', 'MediaController@getImageAds');

//comments
Route::post('/comment/new', ['middleware'=>'auth', 'uses' => 'CommentsController@insert']);
Route::get('/comment/delete/{id}', ['middleware'=>'auth', 'uses' => 'CommentsController@delete']);

//bids
Route::post('/advertisement/view/{id}/bid', ['middleware'=>'auth', 'uses' => 'BidsController@placeBid']);

//miscelaneous
Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/', function () {
	$title = "Market Farm";
/*	if(isset(Auth::user()->blocked))
	{
		if(Auth::user()->blocked){
			Auth::logout();
			session()->flash('errors','blocked');
			return view('welcome', compact('title'));
		}
		
	}*/
    return view('welcome', compact('title'));
});

Route::get('/test', function () {
    return view('test');
});