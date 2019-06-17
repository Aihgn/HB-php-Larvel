<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Room;
use App\Role;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Admin
    public function getAdmin(Request $req)
    {
        $req->user()->authorizeRoles(['receptionist', 'admin']);        
        return view('page.index_admin');
    }

    public function getCheckin1($id)
    {
        Reservation::where('id_customer',$id)->update(array(
                        'status'=>'1',
            ));
        return redirect()->back();
    }

    public function getManagerAcc(Request $req)
    {
        $req->user()->authorizeRoles('admin');
        $acc = DB::table('roles')
        ->join('role_user','roles.id','=','role_user.role_id')
        ->join('users','users.id','=','role_user.user_id')
        ->where('role_user.role_id', '=',3)
        ->orWhere('role_user.role_id', '=',2)
        ->orderBy('role_user.role_id', 'desc')
        ->get();   
        return view('page.manager_account',compact('acc'));
    }

    public function getCheckin(Request $req)
    {
        $req->user()->authorizeRoles(['receptionist', 'admin']);
        $date = date('Y-m-d', strtotime(Carbon::now()));
        $res = DB::table('reservation')
        ->join('customer','customer.id','reservation.id_customer')
        ->where('reservation.date_in', '=',$date)
        ->get();
        return view('page.check_in',compact('res'));
    }


    public function getManagerRoom()
    {

        $room = Room::all();
        return view('page.manager_room',compact('room'));
    }
    

    public function getBookOff()
    {
        $room =Room::all();
        return view('page.book_off',compact('room'));
    }

    public function postBookOff(Request $req)
    {
        $reservation = new Reservation();        
        
        $customer = new Customer();
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone_number = $req->phone_number;
        $customer->save();
        $reservation->id_customer = $customer->id;
        
        $reservation->total=$req->total;            
        $reservation->date_in = date('Y-m-d', strtotime($req->start));
        $reservation->date_out = date('Y-m-d', strtotime($req->end));
        $reservation->save();
        return redirect()->back();
    }
}
