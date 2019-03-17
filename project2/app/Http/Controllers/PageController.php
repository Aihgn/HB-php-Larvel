<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Hash;
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

    public function getLogin(){
    	return view('auth.login');
    }

    public function postLogin(Request $req){

        $arr = ['email' => $req->email, 'password' => $req->password];
        if(Auth::attempt($arr)){
            dd('thanh cong');
        }else{
            dd('that bai');
        }
    }

    public function getRegister(){
    	return view('auth.register');
    }

    public function postRegister(Request $req){
    	$this->validate($req,
    		[
    			'password'=>'required|min:8|max:20',
                'password_confirmation'=>'required|same:password'
    		]);
    	$user = new User();
    	$user->name = $req->name;
    	$user->email = $req->email;
    	$user->password = Hash::make($req->password);
    	$user->save();
    	return redirect()->back()->with('success','Create account successfully');
    }

    public function getGuestBooking(){
    	return view('page.guestbooking');
    }


}
