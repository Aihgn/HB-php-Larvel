<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Reservation;
use App\ResDetail;

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

    public function getAdmin(Request $req)
    {       
        return view('page.admin.index_admin');
    }    

    public function getBookOff()
    {
        $room_type = DB::table('room_types')->get();
        $count = DB::table('room_types')->count();
        return view('page.admin.booking', compact('room_type', 'count'));
    }

    public function postBookOff(Request $req)
    {
        $startDate = substr($req->datefilter, 0, -13);
        $endDate = substr($req->datefilter,13);
        $reservation = new Reservation();
        $reservation->name = $req->name;
        $reservation->email = $req->email;
        $reservation->phone_number = $req->phone_number;
        $reservation->save();

        $count = DB::table('room_types')->count();
       
        for($i = 0; $i < $count; $i++)
        {
            $temp_str ='';
            $temp_str .='sel_'.$i.'';
            if($req->$temp_str > 0)
            {
                $res_detail = new ResDetail();
                $res_detail->reservation_id = $reservation->id;
                $res_detail->room_type_id = $i;
                $res_detail->quantity = $req->$temp_str;
                $res_detail->checkin_date = date('Y-m-d', strtotime($startDate));
                $res_detail->checkout_date = date('Y-m-d', strtotime($endDate));
                $res_detail->save();
            }
        }
        return redirect()->back();  
    }

    public function getCheckin(Request $req)
    {
        // $req->user()->authorizeRoles(['receptionist', 'admin']);
        $date = date('Y-m-d', strtotime(Carbon::now()));
        // $res = DB::table('customer')
        // ->join('reservation','customer.id','reservation.id_customer')
        // ->where('reservation.date_in', '=',$date)
        // ->get();
        return view('page.admin.check_in');
            // ,compact('res'));
    }

    public function getCheckout(Request $req)
    {
        // $temp = DB::table('reservation')
        //         // ->join('reservation_detail', 'reservation_detail.id_reservation', 'reservation.id')
        //         // ->join('room','room.id','reservation_detail.id_room')
        //         ->where('reservation.id','=', 3)
        //         ->get();
        //         dd($temp);
        return view('page.admin.check_out');
    }

    public function getAllRes(Request $req)
    {
        return view('page.admin.reservation');
    }

    public function getManagerAcc(Request $req)
    {
        $acc = DB::table('groups')        
        ->join('users','users.group_id','=','groups.id')
        ->where('groups.id', '=',1)
        ->orWhere('groups.id', '=',2)
        ->get();
        return view('page.admin.manager_account',compact('acc'));
    }

    public function getManagerRoom(Request $req)
    {      
        $room_type = DB::table('room_types')->get();
        return view('page.admin.manager_room',compact('room_type'));
    }

    public function genRoom($id_type,$exp_date,$id_res){
        // $room = DB::table('rooms')
        //         ->where('id_type', '=', $id_type)
        //         ->where('status','=',0)
        //         ->first();
        $exp = date('Y-m-d',strtotime(' + 1 day', strtotime($exp_date)));
        // DB::table('rooms')
        //     ->where('id', $room->id)
        //     ->update(['status' => 2,
        //             'expiry_date' => $exp]);
        DB::table('reservation_detail')
            ->insertGetId(['id_reservation' => $id_res,
                         'id_room' => $room->id]);
        return $room->id;
    } 
}
