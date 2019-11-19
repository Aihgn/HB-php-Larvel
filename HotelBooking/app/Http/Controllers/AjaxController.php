<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon;
use App\RoomType;

class AjaxController extends Controller
{
    //user----------------------------------------------
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
                <div class="row roomid'.$roomID.''.$id.'" id="roomid'.$roomID.''.$id.'">
                    <div class="col-4">'.$room->name.'</div>
                    <div class="col-4"> x '.$calDate.' night</div>
                    <div class="col-4">$'.$room->price*$calDate.'</div>
                    <input type="hidden" name="type_room_'.$roomID.'" id="type_room" value="'.$id.'" />                    
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

    //admin---------------------------------------------



    //book off
    public function getResInfo(Request $req)
    {        
        if($req->ajax())
        {   
            $date = date('Y-m-d', strtotime($req->get('date')));
            $stt =(int)($req->get('stt'));

            if($stt == 0 )
            {
                $res = DB::table('customer')
                ->join('reservation','customer.id','reservation.id_customer')
                ->where('reservation.date_in', '=', $date)
                ->where('status', '=', $stt)
                ->get();              
            }
            else if($stt == 1)
            {
                $res = DB::table('customer')
                ->join('reservation','customer.id','reservation.id_customer')
                ->where('reservation.date_out', '=', $date)
                ->where('status', '=', $stt)
                ->get();                  
            }
            else
            {
               $res = DB::table('customer')
                ->join('reservation','customer.id','reservation.id_customer')
                ->where('reservation.date_in', '=', $date)
                ->orWhere('reservation.date_out', '=', $date)
                ->get(); 
            }       
            $output='';   
            foreach($res as $i=>$row)
            {
                $output .= '
                <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->phone_number.'</td>
                    <td>'.$row->email.'</td>
                    <td>'.$row->date_in.'</td>
                    <td>'.$row->date_in.'</td>
                ';
                if($row->status == 0)
                {
                    if($stt == 2)
                    {
                        $output .= '<td><span class="stt-p p-2">Pending</span></td></tr>';
                    }
                    else
                    {
                        $output .= '                       
                            <td><span class="stt-p p-2">Pending</span></td>
                            <td class="p-1"><button class="btn-check-in btn btn-success" id="'.$row->id.'">Check-in</button></td>
                            <td class="p-1"><button class="btn-cancel btn btn-danger"  id="'.$row->id.'">Cancel</button></td>
                        </tr>';
                    }
                    
                }
                else if($row->status == 1)
                {
                     if($stt == 2)
                    {
                        $output .= '<td><span class="stt-p p-2">Pending</span></td></tr>';
                    }
                    else
                    {
                        $output .= '                       
                            <td><span class="stt-p p-2">Pending</span></td>
                            <td class="p-1"><button class="btn-check-out btn btn-success" id="'.$row->id.'">Check-out</button></td>                        
                        </tr>';
                    }
                }
                else if($row->status == 2)
                {
                    $output .= '<td><span class="stt-d p-2">Done</span></td></tr>';
                }
                else
                {
                     $output .= '<td><span class="stt-c p-2">Cancel</span></td></tr>';
                }                       
           } 

            echo json_encode($output);
        }
    }

    public function checkin(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');
            DB::table('reservation')
                ->where('id', $id)
                ->update(['status' => 1]);   
        }
    }

    public function checkout(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');
            DB::table('reservation')
                ->where('id', $id)
                ->update(['status' => 2]);   
                
            DB::table('reservation')
                ->join('reservation_detail', 'reservation_detail.id_reservation', 'reservation.id')
                ->join('room','room.id','reservation_detail.id_room')
                ->where('reservation.id','=', 3)
                // ->where('reservation.date_out', '=')
                ->update(['room.status'=>0,
                            'room.expiry'=>NULL]);
        }
    }

    public function cancelRes(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');
            DB::table('reservation')
                ->where('id', $id)
                ->update(['status' => 3]);   
        }
    }

    public function liveSearch(Request $req)
    {
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
            $output = '';
            $output .= '<div class="alert alert-success">Data Updated</div>';
            echo json_encode($output);
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
                $output .= '
                    <tr>
                        <td>'.($i+1).'</td>
                        <td>'.$row->name.'</td>
                        <td>'.$row->email.'</td>  
                        <td>'.$row->description.'</td>                
                    ';
                if($row->role_id==2)
                {
                    $output .= '                    
                        <td><a href="#" id="'.$row->user_id.' "class="remove-role btn btn-danger pb-2 pt-2 pl-1 pr-1">Remove</a></td>      
                        <td><a href="#" id="'.$row->user_id.'" class="delete-acc btn btn-danger pb-2 pt-2 pl-1 pr-1">Delete</a></td>
                    </tr>
                    ';
                }
                else{
                    $output .= '</tr>';
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
            $output = '';
            $output .= '<div class="alert alert-success">Data Updated</div>';
            echo json_encode($output);
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
            $output = '';
            $output .= '<div class="alert alert-danger">Data Deleted</div>';
            echo json_encode($output);            
        }
    }
// Manager Room
    public function getRoomType(Request $req)
    {
        if($req->ajax())
        {
            $output='';
            $room_types = DB::table('room_types')->get();
            foreach($room_types as $i=>$rt)
            {                
                $output .= '
                    <tr>
                        <td>'.($i+1).'</td>
                        <td>'.$rt->name.'</td>
                        <td>'.$rt->price.'</td>
                        <td>'.$rt->quantity.'</td>
                        <td>'.$rt->available.'</td>     
                        <td>'.$rt->description.'</td>                
                        <td><button id="'.$rt->id.'"  type="button" data-toggle="modal" class="edit-type-btn btn btn btn-success pb-2 pt-2 pl-1 pr-1">Edit</button></td>
                        <td><button id="'.$rt->id.'"  type="button" data-toggle="modal" class="del-type-btn btn btn btn-danger pb-2 pt-2 pl-1 pr-1">Delete</button></td>
                    </tr>
                    ';                
            }
            $data = array(
                'table_data'  => $output,              
            );
            echo json_encode($data);
        }
    }

    public function fetchdataRoomType(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');            
            $room_type = RoomType::find($id);
            $data = array(
                'type'    =>  $room_type->name,
                'price'     =>  $room_type->price,
                'quantity' => $room_type->quantity,
                'available' => $room_type->available,
                'description' => $room_type->description
            );
            echo json_encode($data);
        }
    }

    public function postRoomType(Request $req)
    {      
        if($req->ajax())
        {    
            $id = $req->get('room_type_id');
            $type = $req->get('room_type');
            $price = $req->get('room_price');
            $qty = $req->get('room_quantity');
            $available = $req->get('room_available');
            $des = $req->get('room_description');
            $btn_action = $req->get('btn_action');
            
            $validation = Validator::make($req->all(), [
                'room_type' => 'required',
                'room_price'  => 'required|integer',
                'room_quantity'  => 'required|integer',
                'room_available'  => 'required|integer',
                'room_description' => 'required',
            ]);
            
            $error_array = array();
            $success_output = '';

            if ($validation->fails())
            {
                foreach ($validation->messages()->getMessages() as $field_name => $messages)
                {
                    $error_array[] = $messages; 
                }
            }
            else
            {                
                if($btn_action == 'insert')
                {
                    $room_type = new RoomType([
                        'name'    =>  $type,
                        'price'     =>  $price,
                        'quantity' => $qty,
                        'available' => $available,
                        'description' => $des,
                    ]);
                    $room_type->save();
                    $success_output = '<div class="alert alert-success">Data Inserted</div>';
                }

                if($btn_action == 'update')
                {
                    $room_type = RoomType::find($id);
                    $room_type->name = $type;
                    $room_type->price =  $price;
                    $room_type->quantity = $qty;
                    $room_type->available = $available;
                    $room_type->description = $des;
                    $room_type->save();
                    
                    $success_output = '<div class="alert alert-success">Data Updated</div>';
                }
                
            }
            
            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output
            );
            echo json_encode($output);
        }
    }

    public function delRoomType(Request $req)
    {
        if($req->ajax())
        {   
            $id = $req->get('id');
            DB::table('room_types')
                ->where('id', $id)
                ->delete();       
            $output = '';
            $output .= '<div class="alert alert-danger">Data Deleted</div>';
            echo json_encode($output); 
        }
    }

    public function getPrice(Request $req){
        if($req->ajax())
        {    
            $id = $req->get('p_id');
            $price = DB::table('type_room')
            ->where('id','=',$id)
            ->value('price');
            // dd($price);
            echo json_encode($price);
        }
    }
}
