<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Reservation;

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
        // $req->user()->authorizeRoles(['receptionist', 'admin']);        
        return view('page.admin.index_admin');
    }    

    public function getBookOff()
    {
        $room_type = DB::table('room_types')->get();
        return view('page.admin.booking', compact('room_type'));
    }

    public function postBookOff(Request $req)
    {
        $qty= $req->qty_room;
        $startDate = substr($req->datefilter, 0, -13);
        $endDate = substr($req->datefilter,13);
        
        $customer = new Customer();
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone_number = $req->phone_number;
        $customer->save();

        $reservation = new Reservation(); 
        $reservation->id_customer = $customer->id;        
        $reservation->total=$req->total;            
        $reservation->date_in = date('Y-m-d', strtotime($startDate));
        $reservation->date_out = date('Y-m-d', strtotime($endDate));
        $reservation->save();

        for($i = 0; $i < $qty; $i++)
        {
            $temp_str ='';
            $temp_str .='sel_'.$i.'';
            $this->genRoom($req->$temp_str,$startDate,$reservation->id);
        }

        return redirect()->back()->with('success', 'Book room success!');  
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
        // $req->user()->authorizeRoles('admin');
        $acc = DB::table('groups')        
        ->join('users','users.group_id','=','groups.id')
        ->where('groups.id', '=',1)
        ->orWhere('groups.id', '=',2)
        ->get();   

        // dd($acc);
        return view('page.admin.manager_account',compact('acc'));
    }

    public function getManagerRoom(Request $req)
    {
        // $req->user()->authorizeRoles(['admin']);        
        $room_type = DB::table('room_types')->get();
        return view('page.admin.manager_room',compact('room_type'));
    }

    public function genRoom($id_type,$exp_date,$id_res){
        $room = DB::table('room')
                ->where('id_type', '=', $id_type)
                ->where('status','=',0)
                ->first();
        $exp = date('Y-m-d',strtotime(' + 1 day', strtotime($exp_date)));
        DB::table('room')
            ->where('id', $room->id)
            ->update(['status' => 2,
                    'expiry_date' => $exp]);
        DB::table('reservation_detail')
            ->insertGetId(['id_reservation' => $id_res,
                         'id_room' => $room->id]);
        return $room->id;
    } 
}
