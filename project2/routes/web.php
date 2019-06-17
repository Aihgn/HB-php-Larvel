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

Route::get('search-res', 'PageController@getSearchRes')->name('search_res');

Auth::routes();

//user
Route::get('myaccount', 'PageController@getMyAccount')->name('myaccount')->middleware('auth');

Route::post('myaccount', 'PageController@postMyAccount')->name('myaccount');

Route::post('myaccount/change-password', 'PageController@changePassword')->name('change-password')->middleware('auth');

Route::get('myaccount/cancel-reservation/{id}', 'PageController@cancelReservation')->name('cancel-res')->middleware('auth');

Route::get('booking', 'PageController@getBooking')->name('booking');

Route::post('booking', 'PageController@postBooking')->name('booking');

Route::get('/booking/add_room', 'AjaxController@addRoom')->name('add_room.action');

Route::get('/booking/remove_room', 'AjaxController@removeRoom')->name('remove_room.action');

//admin
Route::get('admin', 'AdminController@getAdmin')->name('admin')->middleware('auth');

Route::get('admin/manager-account', 'AdminController@getManagerAcc')->name('manager_acc');

Route::get('admin/manager-account/live_search', 'AjaxController@liveSearch')->name('live_search');

Route::post('admin/manager-account/add-role', 'AjaxController@addRole')->name('add_role');

Route::post('admin/manager-account/remove-role', 'AjaxController@removeRole')->name('remove_role');

Route::post('/admin/del-acc', 'AjaxController@deleteAccount')->name('delete_acc');

Route::get('/admin/get-acc', 'AjaxController@getAccount')->name('get_account');

Route::get('/admin/manager-room', 'AdminController@getManagerRoom')->name('manager_room')->middleware('auth');

Route::get('/admin/check-in', 'AdminController@getCheckin')->name('check_in')->middleware('auth');

Route::get('admin/{id}',[
	'as'=>'check-in',
	'uses'=>'AdminController@getCheckin1'
])->middleware('auth');


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