<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use App\RoomType;
use App\Reservation;
use App\User;
include ("AdminController.php");

class PageController extends Controller
{    
    //page
    public function getIndex(){
        $room = RoomType::all();
        return view('page.index', compact('room'));
    }

    public function getRooms(){
        $room = RoomType::all();
        return view('page.rooms', compact('room'));
    }

    public function getAbout(){
        return view('page.about');
    }

    public function getSearchRes(){
        return view('page.search_reservation');
    }

    //user
    public function getMyAccount()
    {       
        $id = Auth::user()->id;
        $acc_info = User::where('id',$id)->get();   
        $booking_info = Reservation::where('user_id',$id)->get();
        return view('page.my_account', compact('acc_info','booking_info'));        
    }

    public function postMyAccount(Request $req)
    {          
        $id_user = Auth::id();
        $user=User::findOrFail($id_user);
        if(Hash::check($req->password, $user->password)){
            User::where('id',$id_user)->update(array(
                        'name'=>$req->name,
            ));
            Customer::where('id_user',$id_user)->update(array(
                        'name'=>$req->name,
                        'phone_number'=>$req->phone_number,
                        'address'=>$req->address,

            ));
            return response()->json([
                'status' => 'success',
                'msg' => 'Update successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => 'failed',
                'msg' => 'Wrong password',
            ]);
        }
        
    }

    public function changePassword(Request $req)
    {
        $rules = [
            'npass' => 'required|min:8',
            'cnpass' =>'required|same:npass',
        ];
        $messages = [    
            'npass.required' => 'Please enter new password',
            'npass.min' => 'Password must be at least 8 characters',
            'cnpass.required' => 'Please enter comfirm password',
            'cnpass.same' => 'Comfirm password does not match.',
        ];
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) 
        {
            return response()->json([
                    'error' => true,
                    'msg' => $validator->errors()
                ]);
            
        } 
        else {
            $id_user = Auth::id();
            $user=User::findOrFail($id_user);
            if(Hash::check($req->cpass, $user->password)){
                User::where('id',$id_user)->update(array(
                             'password'=>Hash::make($req->npass),
                ));

                return response()->json([
                    'error' => false,
                    'msg' => 'Update successfully'
                ]);    
            }
            else{
                $errors = new MessageBag(['errorlogin' => 'Wrong password']);
               return response()->json([
                    'error' => true,
                    'msg' => $errors,
                ]);
            }
        }        
    }

    public function cancelReservation($id)
    {
        $id_c = Auth::user()->id;
        Reservation::where('id',$id)->where('id_customer',$id_c)->update(array(
                        'status'=>2,
            ));
        return redirect()->back();
        
    }

    public function getBooking()
    {
        $room = RoomType::all();
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $acc_info = User::where('id',$id)->get();            
            return view('page.booking', compact('room','acc_info'));
        } else{
            return view('page.booking', compact('room'));
        }
        return view('page.booking', compact('room'));
    }

    public function postBooking(Request $req)
    {
        $qty = $req->qty_r;
        $AdminController = new AdminController();
        
        $reservation = new Reservation();        
        if (Auth::check()){
            $reservation->id_customer= Auth::user()->id;
        }else{
            $customer = new Customer();
            $customer->name = $req->name;
            $customer->email = $req->email;
            $customer->phone_number = $req->phone_number;
            $customer->save();
            $reservation->id_customer = $customer->id;
        }
        $reservation->total=$req->total_amount;            
        $reservation->date_in = date('Y-m-d', strtotime($req->start));
        $reservation->date_out = date('Y-m-d', strtotime($req->end));
        $reservation->save();
        for($i = 1; $i <= $qty; $i++)
        {
            $temp_str ='';
            $temp_str .='type_room_'.$i.'';
            // dd($req->$temp_str);
            $AdminController->genRoom($req->$temp_str, date('Y-m-d', strtotime($req->start)),$reservation->id);
        }
        return redirect('/');
    }
    
}
