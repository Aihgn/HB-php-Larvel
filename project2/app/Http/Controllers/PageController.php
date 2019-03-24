<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;

class PageController extends Controller
{
    public function getIndex(){
    	return view('page.index');
    }

    public function getRooms(){
    	return view('page.rooms');
    }

    public function getAbout(){
    	return view('page.about');
    }

    public function getGuestBooking(){
    	return view('page.guestbooking');
    }

    public function getMyAccount(){
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $acc_info = Customer::where('id_user',$id)->get();            
            return view('page.myaccount',compact('acc_info'));
        } 
    }

    public function getBooking(){
        return view('page.booking');
    }
        
}
