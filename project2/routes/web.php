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
Route::get('/', 'PageController@getIndex')->name('home');

Route::get('home', 'PageController@getIndex')->name('home');

Route::get('rooms', 'PageController@getRooms')->name('rooms');

Route::get('about', 'PageController@getAbout')->name('about');

Auth::routes();

//user
Route::get('myaccount', 'PageController@getMyAccount')->name('myaccount')->middleware('auth');

Route::post('myaccount', 'PageController@postMyAccount')->name('myaccount');

Route::post('myaccount/change-password', 'PageController@changePassword')->name('change-password')->middleware('auth');

Route::get('search-res', 'PageController@getSearchRes')->name('search-res');

Route::get('search-res', 'PageController@getSearchRes')->name('search-res');


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



Route::get('/manager-account',[
	'as'=>'manager_acc',
	'uses'=>'AdminController@getManagerAcc'
]);

Route::get('/live_search',[
	'as'=>'live_search',
	'uses'=>'AjaxController@liveSearch'
]);

Route::post('/admin/add-role', 'AjaxController@addRole')->name('add_role');

Route::post('/manager-account/remove-role',[
	'as'=>'remove_role',
	'uses'=>'AjaxController@removeRole'
]);

Route::post('/admin/del-acc', 'AjaxController@deleteAccount')->name('delete_acc');

Route::get('/admin/get-acc', 'AjaxController@getAccount')->name('get_account');

Route::get('manager-room',[
	'as'=>'manager_room',
	'uses'=>'AdminController@getManagerRoom'
])->middleware('auth');

Route::get('check-in',[
	'as'=>'check_in',
	'uses'=>'AdminController@getCheckin'
])->middleware('auth');

Route::get('admin/{id}',[
	'as'=>'check-in',
	'uses'=>'AdminController@getCheckin1'
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
	'as'=>'book_off',
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