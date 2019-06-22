<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Room;
use App\Role;
use App\Customer;
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

    //Admin
    public function getAdmin(Request $req)
    {
        $req->user()->authorizeRoles(['receptionist', 'admin']);        
        return view('page.index_admin');
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
        $res = DB::table('customer')
        ->join('reservation','customer.id','reservation.id_customer')
        ->where('reservation.date_in', '=',$date)
        ->get();
        return view('page.check_in',compact('res'));
    }

    public function getCheckout(Request $req)
    {
        // $temp = DB::table('reservation')
        //         // ->join('reservation_detail', 'reservation_detail.id_reservation', 'reservation.id')
        //         // ->join('room','room.id','reservation_detail.id_room')
        //         ->where('reservation.id','=', 3)
        //         ->get();
        //         dd($temp);
        return view('page.check_out');
    }

    public function getAllRes(Request $req)
    {
        return view('page.all_reservation');
    }

    public function getManagerRoom(Request $req)
    {
        $req->user()->authorizeRoles(['admin']);        
        $room_type = DB::table('type_room')->get();
        return view('page.manager_room',compact('room_type'));
    }
    

    public function getBookOff()
    {
        $room =Room::all();
        return view('page.book_off',compact('room'));
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
                         'id_room' => $room->id],            
        );
        return $room->id;
    } 
}
