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

//user--------------------------------------------------------------
Route::get('myaccount', 'PageController@getMyAccount')->name('myaccount')->middleware('auth');

Route::post('myaccount', 'PageController@postMyAccount')->name('myaccount');

Route::post('myaccount/change-password', 'PageController@changePassword')->name('change-password')->middleware('auth');

Route::get('myaccount/cancel-reservation/{id}', 'PageController@cancelReservation')->name('cancel-res')->middleware('auth');

Route::get('booking', 'PageController@getBooking')->name('booking');

Route::post('booking', 'PageController@postBooking')->name('booking');

Route::get('/booking/add_room', 'AjaxController@addRoom')->name('add_room.action');

Route::get('/booking/remove_room', 'AjaxController@removeRoom')->name('remove_room.action');

//admin-------------------------------------------------------------------
Route::get('admin', 'AdminController@getAdmin')->name('admin')->middleware('auth');

	//manger account-----------------------------------------------------
Route::get('admin/manager-account', 'AdminController@getManagerAcc')->name('manager_acc');

Route::get('admin/manager-account/live-search', 'AjaxController@liveSearch')->name('live_search');

Route::post('admin/manager-account/add-role', 'AjaxController@addRole')->name('add_role');

Route::post('admin/manager-account/remove-role', 'AjaxController@removeRole')->name('remove_role');

Route::post('admin/del-acc', 'AjaxController@deleteAccount')->name('delete_acc');

Route::get('admin/get-acc', 'AjaxController@getAccount')->name('get_account');

	//manager room-----------------------------------------------------
Route::get('admin/manager-room', 'AdminController@getManagerRoom')->name('manager_room')->middleware('auth');

Route::get('admin/get-room', 'AjaxController@getRoom')->name('get_room');

Route::get('admin/get-room-type', 'AjaxController@getRoomType')->name('get_room_type');

Route::get('admin/manager-room/live-search-room', 'AjaxController@liveSearchRoom')->name('live_search_room');

Route::get('admin/manager-room/fetchdata-room-type', 'AjaxController@fetchdataRoomType')->name('fetchdata_room_type');

Route::post('admin/manager-room/post-room-type', 'AjaxController@postRoomType')->name('post_room_type');

Route::post('admin/del-room-type', 'AjaxController@delRoomType')->name('del_room_type');

Route::get('admin/manager-room/fetchdata-room', 'AjaxController@fetchdataRoom')->name('fetchdata_room');

Route::post('admin/manager-room/post-room', 'AjaxController@postRoom')->name('post_room');



Route::get('admin/pick-date-res', 'AjaxController@getResInfo')->name('res.pick-date');

	//check-in-------------------------------------------------------
Route::get('admin/check-in', 'AdminController@getCheckin')->name('check_in')->middleware('auth');

Route::get('admin/check-in/ci', 'AjaxController@checkin')->name('check_in.action');

Route::get('admin/cancel-res', 'AjaxController@cancelRes')->name('ci.cancel');

	//check-out--------------------------------------------
Route::get('admin/check-out', 'AdminController@getCheckout')->name('check_out')->middleware('auth');

Route::get('admin/check-in/co', 'AjaxController@checkout')->name('check_out.action');


Route::get('admin/all-res', 'AdminController@getAllRes')->name('all_res')->middleware('auth');
	//book off

Route::get('admin/book-off', 'AdminController@getBookOff')->name('book_off')->middleware('auth');

Route::post('admin/book-off', 'AdminController@postBookOff')->name('book_off');

Route::get('admin/manager-account/get-price', 'AjaxController@getPrice')->name('get_price');

Route::get('admin/manager-account/get-profit-td', 'AjaxController@getProfitToday')->name('get_profit_td');

Route::get('admin/manager-account/get-profit-7d', 'AjaxController@getProfit7days')->name('get_profit_7d');

Route::get('admin/manager-account/get-br-7d', 'AjaxController@getBookRate')->name('get_br_7d');

// Route::get('admin/manager-account/get-profit-m', 'AjaxController@getProfitMonth')->name('get_profit_m');
