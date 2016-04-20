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

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('client', 'ClientController');

/**
 * Api routes here
 */
Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function() {

	// Auth create/destroy
	Route::post('tokens', 'AuthController@create');
	Route::delete('tokens', 'AuthController@destroy');

	// API routes requiring auth access
	Route::group(['middleware' => 'auth.jwt'], function() {

		Route::get('clients', 'ClientApiController@get');
		Route::post('clients', 'ClientApiController@create');

	});

});