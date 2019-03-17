<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('home', [
	'as'=>'home',
	'uses'=>'PageController@getIndex'
]);

Route::get('rooms', [
	'as'=>'rooms',
	'uses'=>'PageController@getRooms'
]);

Route::get('about', [
	'as'=>'about',
	'uses'=>'PageController@getAbout'
]);

Route::get('login', [
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);

Route::post('login', [
	'as'=>'login',
	'uses'=>'PageController@postLogin'
]);

Route::get('register', [
	'as'=>'register',
	'uses'=>'PageController@getRegister'
]);

Route::post('register', [
	'as'=>'register',
	'uses'=>'PageController@postRegister'
]);

route::get('guestbooking', [
	'as'=>'guestbooking',
	'uses'=>'PageController@getGuestBooking'
]);

// Auth::routes();
