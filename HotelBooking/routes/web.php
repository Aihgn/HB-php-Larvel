<?php

//page
Route::get('/', 'PageController@getIndex')->name('home');

Route::get('home', 'PageController@getIndex')->name('home');

Route::get('rooms', 'PageController@getRooms')->name('rooms');

Route::get('about', 'PageController@getAbout')->name('about');

Route::get('reservations', 'PageController@getRes')->name('res');

Route::post('reservations', 'PageController@postRes')->name('res');

Route::get('reservations/get-total', 'AjaxController@getTotal')->name('r_get_total');

Route::get('search-res', 'PageController@getSearchRes')->name('search_res');

Auth::routes();


//user--------------------------------------------------------------
Route::get('myaccount', 'PageController@getMyAccount')->name('myaccount')->middleware('auth');

Route::post('myaccount', 'PageController@changeAccInfo')->name('myaccount');

Route::post('myaccount/change-password', 'PageController@changePassword')->name('change-password')->middleware('auth');

Route::get('myaccount/cancel-reservation/{id}', 'PageController@cancelReservation')->name('cancel-res')->middleware('auth');


//admin-------------------------------------------------------------------
Route::middleware('manager')->group(function () {
	Route::prefix('admin')->group(function () {
		Route::get('/', 'AdminController@getAdmin')->name('admin');

		//check-in-------------------------------------------------------
		Route::get('check-in', 'AdminController@getCheckin')->name('check_in');

		Route::get('check-in/ci', 'AjaxController@checkin')->name('check_in.action');

		Route::get('check-in/cancel-res', 'AjaxController@cancelRes')->name('ci.cancel');


		//check-out--------------------------------------------
		Route::get('check-out', 'AdminController@getCheckout')->name('check_out');

		Route::get('check-out/co', 'AjaxController@checkout')->name('check_out.action');
		


		//book off--------------------------------------------

		Route::get('book-off', 'AdminController@getBookOff')->name('book_off');

		Route::post('book-off', 'AdminController@postBookOff')->name('book_off');

		Route::get('book-off/get-total', 'AjaxController@getTotal')->name('get_total');

		// ============================
		Route::get('all-res', 'AdminController@getAllRes')->name('all_res');

		Route::get('all-res/pick-date-res', 'AjaxController@getResInfo')->name('res.pick-date');
		
		Route::get('all-res/res-stt', 'AjaxController@getResByStt')->name('res-stt');

		Route::get('all-res/confirm-res', 'AjaxController@confirmRes')->name('confirm-res');

		Route::get('all-res/cancel-res', 'AjaxController@cancelRes')->name('cancel-ad-res');
	});
});

Route::middleware('admin')->group(function () {
	Route::prefix('admin')->group(function () {
	//manger account-----------------------------------------------------
		Route::get('manager-account', 'AdminController@getManagerAcc')->name('manager_acc');

		Route::post('manager-account/add-manager', 'AjaxController@addManager')->name('add_manager');

		Route::post('manager-account/remove-role', 'AjaxController@removeRole')->name('remove_role');

		Route::post('manager-account/del-acc', 'AjaxController@deleteAccount')->name('delete_acc');

		Route::get('manager-account/get-acc', 'AjaxController@getAccount')->name('get_account');
	//manager room-----------------------------------------------------
		Route::get('manager-room', 'AdminController@getManagerRoom')->name('manager_room');

		Route::get('manager-room/get-room-type', 'AjaxController@getRoomType')->name('get_room_type');

		Route::get('manager-room/fetchdata-room-type', 'AjaxController@fetchdataRoomType')->name('fetchdata_room_type');

		Route::post('manager-room/post-room-type', 'AjaxController@postRoomType')->name('post_room_type');

		Route::post('manager-room/del-room-type', 'AjaxController@delRoomType')->name('del_room_type');
	});
});