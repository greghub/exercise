<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'v1', 'before' => ''), function()
{
	Route::enableFilters();

	# Cities
	Route::get('states/cities.json', 'CitysController@show');

	# User
	Route::get('users/visits.json', 'UsersController@visits');
	Route::post('users/visits.json', 'UsersController@update');
});

Route::get('seed', function()
{
	Iseed::generateSeed('users');	
	Iseed::generateSeed('citys');	
	Iseed::generateSeed('user_citys');	
});