<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;
use App\RoomType;
use App\Reservation;

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
        $room = RoomType::all();
       if (Auth::check())
        {
            $id = Auth::user()->id;
            $acc_info = Customer::where('id_user',$id)->get();            
            return view('page.booking',compact('room','acc_info'));
        } else{
            return view('page.booking',compact('room'));
        }
        return view('page.booking' ,compact('room'));
    }

    public function postBooking(Request $req){
        // $this->validate(
        // );
        $reservation = new Reservation();
        if (Auth::check()){
            $reservation->id_customer= Auth::user()->id;
        }
        $reservation->total='300';
        $reservation->payment='null';             
        $reservation->start_date = date('Y-m-d', strtotime($req->start));
        $reservation->end_date = date('Y-m-d', strtotime($req->end));
        $reservation->save();
        return redirect()->back();
    }
        
}
