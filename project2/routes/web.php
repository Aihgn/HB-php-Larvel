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

//page
Route::get('/', [
	'as'=>'home',
	'uses'=>'PageController@getIndex'
]);

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

//user
Route::get('myaccount',[
	'as'=>'myaccount',
	'uses'=>'PageController@getMyAccount'
])->middleware('auth');

Route::post('myaccount',[
	'as'=>'myaccount',
	'uses'=>'PageController@postMyAccount'
]);

Route::post('myaccount/change-password',[
	'as'=>'change-password',
	'uses'=>'PageController@changePassword'
]);

route::get('guestbooking', [
	'as'=>'guestbooking',
	'uses'=>'PageController@getGuestBooking'
]);

Auth::routes();

route::get('booking',[
	'as'=>'booking',
	'uses'=>'PageController@getBooking'
]);
route::post('booking', [
	'as'=>'booking',
	'uses'=>'PageController@postBooking'
]);

Route::get('/booking/add_room',[
	'as'=>'add_room.action',
	'uses'=>'AjaxController@addRoom'
]);

Route::get('/booking/remove_room',[
	'as'=>'remove_room.action',
	'uses'=>'AjaxController@removeRoom'
]);

//admin
Route::get('admin',[
	'as'=>'admin',
	'uses'=>'AdminController@getAdmin'
])->middleware('auth');

Route::get('admin/{id}',[
	'as'=>'check-in',
	'uses'=>'AdminController@getCheckin'
])->middleware('auth');

Route::get('manager-room',[
	'as'=>'manager-room',
	'uses'=>'AdminController@getManagerRoom'
])->middleware('auth');

Route::get('cancel-reservation/{id}',[
	'as'=>'cancel-res',
	'uses'=>'AdminController@cancelReservation'
]);

Route::get('pick-date',[
	'as'=>'admin.action',
	'uses'=>'AjaxController@getResInfo'
]);

Route::get('book-off',[
	'as'=>'book-off',
	'uses'=>'AdminController@getBookOff'
])->middleware('auth');

Route::post('book-off',[
	'as'=>'book-off',
	'uses'=>'AdminController@postBookOff'
]);

Route::get('book-off/count',[
	'as'=>'book-off.action',
	'uses'=>'AjaxController@getBookOffTotal'
]);