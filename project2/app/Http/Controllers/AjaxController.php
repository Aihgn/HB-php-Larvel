<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\RoomType;

class AjaxController extends Controller
{
    public function addRoom(Request $req)
    {        
        if($req->ajax())
        {   
            $output1='';
            $output2='';
            $id = $req->get('id');
            $roomID = $req->get('roomIDp');
            $calDate = $req->get('calDate');
            $room = RoomType::find($id);

            $req->session()->push('cart.id', $id);
            
            $output1 .='
                <div class="card m-2 p-0">                             
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="room-img-cart" src="img/'.$room->image.'" alt="Card image cap">
                        </div>
                        <div class="card-body p-0">                                 
                            <span class="col-6 pt-4">'.$room->name.'</span>
                            
                            <a href="#" class="remove-room col-4 pt-3 ml-5 " id="roomid'.$roomID.''.$id.'"><ion-icon name="close" style="font-size: 40px; color:#000;"></ion-icon></a>                
                        </div>
                    </div>      
                </div>
            ';
            $output2 .='
                <div class="roomid'.$roomID.''.$id.'" id="roomid'.$roomID.''.$id.'">
                    <table>
                        <tr>
                            <td class="text-left"><span>'.$room->name.'</span></td>
                            <td><span class="mr-4"> x '.$calDate.' night</span></td>
                            <td class="text-right"><span class="ml-5">$'.$room->price*$calDate.'</span></td>
                        </tr>
                    </table>
                </div>
            ';
            $room_price=$room->price*$calDate;
            $data = array(
                "room" => $output1,
                "detail" =>$output2,    
                "room_price"=>$room_price,
            );
            echo json_encode($data);
        }
    }

    public function removeRoom(Request $req)
    {        
        if($req->ajax())
        {   
            $id = $req->get('id');            
            $calDate = $req->get('calDate');
            $room = RoomType::find($id);           
            $roomPrice=$room->price*$calDate;
            $data = array(                 
                "room_price"=>$roomPrice,
            );
            echo json_encode($data);
        }
    }

    public function getResInfo(Request $req)
    {        
        if($req->ajax())
        {   
            $date = date('Y-m-d', strtotime($req->get('date')));
            $res = DB::table('reservation')
            ->join('customer','customer.id','reservation.id_customer')
            ->where('reservation.date_in', '=',$date)
            ->get();           
            echo json_encode($res);
        }
    }

    public function getBookOffTotal(Request $req)
    {
        if($req->ajax())
        {   
           $id = $req->get('id');  
           $count =RoomType::where('id',$id)->get();           
           echo json_encode($count);
        }
    }

   public function liveSearch(Request $req){
        if($req->ajax())
        {   
            $output = '';
            $query = $req->get('query');
            if($query != '')
            {
                $data = DB::table('users')
                ->join('role_user','users.id','=','role_user.user_id')
                ->where('role_user.role_id', '=',1)
                ->where(function ($q)  use ($query) {
                    $q->where('name', 'like', '%'.$query.'%')
                          ->orWhere('email', 'like', '%'.$query.'%');
                })            
                ->get();
            }
            else
            {
                $data = DB::table('users')
                ->join('role_user','users.id','=','role_user.user_id')
                ->where('role_user.role_id', '=',1)
                ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $i=>$row)
                {
                    $output .= '
                    <tr>
                        <td>'.($i+1).'</td>
                        <td>'.$row->name.'</td>
                        <td>'.$row->email.'</td>     
                        <td><a href="#" id="'.$row->user_id.'" class="add-role btn btn-success pb-2 pt-2 pl-1 pr-1">Add</a></td>                
                    </tr>
                    ';
               }
            }
            else
            {
                $output = '
                   <tr>
                        <td align="center" colspan="5">No Data Found</td>
                   </tr>
                   ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }

    public function addRole(Request $req)
    { 
        if($req->ajax())
        {   
            $id = $req->get('id');
            DB::table('role_user')
                ->where('user_id', $id)
                ->update(['role_id' => 2]);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    public function getAccount(Request $req)
    {
        if($req->ajax())
        {
            $output='';
            $acc = DB::table('roles')
                ->join('role_user','roles.id','=','role_user.role_id')
                ->join('users','users.id','=','role_user.user_id')
                ->where('role_user.role_id', '=',3)
                ->orWhere('role_user.role_id', '=',2)
                ->orderBy('role_user.role_id', 'desc')
                ->get();
            foreach($acc as $i=>$row)
            {
                if($row->role_id==2)
                {
                    $output .= '
                    <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->email.'</td> 
                    <td>'.$row->description.'</td>
                    <td><a href="#" id="'.$row->user_id.' "class="remove-role btn btn-danger pb-2 pt-2 pl-1 pr-1">Remove</a></td>      
                    <td><a href="#" id="'.$row->user_id.'" class="delete-acc btn btn-danger pb-2 pt-2 pl-1 pr-1">Delete</a></td>
                    </tr>
                    ';
                }
                else
                {
                    $output .= '
                    <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->email.'</td>  
                    <td>'.$row->description.'</td>
                    </tr>
                    ';
                }
            }
            $data = array(
                'table_data'  => $output,              
            );
            echo json_encode($data);
        }
    }

    public function removeRole(Request $req)
    { 
        if($req->ajax())
        {   
            $id = $req->get('id');
            DB::table('role_user')
                ->where('user_id', $id)
                ->update(['role_id' => 1]);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    public function deleteAccount(Request $req)
    { 
        if($req->ajax())
        {   
            $id = $req->get('id');
            DB::table('role_user')
                ->where('user_id', $id)
                ->delete();
            DB::table('users')
                ->where('id', $id)
                ->delete();
            DB::table('customer')
                ->where('id_user', $id)
                ->delete();
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }
}
