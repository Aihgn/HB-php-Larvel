<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Room;

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
        $date = date('Y-m-d', strtotime(Carbon::now()));
        // $res = Reservation::where('date_in',$date)->get();
        $res = DB::table('reservation')
        ->join('customer','customer.id','reservation.id_customer')
        ->where('reservation.date_in', '=',$date)
        ->get();
        return view('page.index_admin',compact('res'));
        
        
    }

    public function getCheckin($id)
    {
        Reservation::where('id_customer',$id)->update(array(
                        'status'=>'1',
            ));
        return redirect()->back();
    }

    public function getManagerRoom()
    {

        $room = Room::all();
        // dd($room);
        return view('page.manager_room',compact('room'));
    }
    public function cancelReservation($id)
    {
        $id_c = Auth::user()->id;
        // dd($id,$id_c);
        Reservation::where('id',$id)->where('id_customer',$id_c)->update(array(
                        'status'=>2,
            ));
        return redirect()->back();
        
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
