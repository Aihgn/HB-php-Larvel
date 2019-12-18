<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon;
use App\RoomType;
use App\User;

class AjaxController extends Controller
{


//book off
    public function getTotal(Request $req)
    {
        if($req->ajax())
        {
            $qty = $req->get('qty');
            $count = DB::table('room_types')->count();
            $total =0;
            for($i=0; $i<$count; $i++)
            {
                $id = $i+1;
                $price = DB::table('room_types')
                ->where('id','=',$id)
                ->value('price');
                $total += $price*$qty[$i];
            }
            echo json_encode($total);
        }
    }

    public function getResByStt(Request $req)
    {        
        if($req->ajax())
        {  
            $res = DB::table('reservations')
                ->where('status', '=', $req->stt)
                ->get();
            $output='';
            foreach($res as $i=>$row)
            {
                $output .= '
                <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$row->name.'</td>
                    <td>'.$row->phone_number.'</td>
                    <td>'.$row->email.'</td>
                    <td>'.$row->checkin_date.'</td>
                    <td>'.$row->checkout_date.'</td>
                ';
                if($row->status == 0)//Done
                {
                        $output .= '<td><span class="stt-d p-2">Confirm</span></td></tr>';
                }
                else if($row->status == 1)//Pending
                {
                    $output .= '<td><span class="stt-p p-2">Pending</span></td>
                                    <td class="p-1"><button class="btn-confirm btn btn-success" id="'.$row->id.'">Confirm</button></td>
                                    <td class="p-1"><button class="btn-cancel btn btn-danger"  id="'.$row->id.'">Cancel</button></td>
                                </tr>';
                }
                else if($row->status == 2)
                {
                     $output .= '<td><span class="stt-c p-2">Cancel</span></td></tr>';
                }
                else
                {
                    $output .= '<td><span class="stt-d p-2">Done</span></td></tr>';
                }
            }
            echo json_encode($output);
        }
    }

    public function getResInfo(Request $req)
    {        
        if($req->ajax())
        {   
            $date = date('Y-m-d', strtotime($req->date));
            $stt =(int)($req->stt);
            if($stt == 1 )
            {
                $res = DB::table('customer')
                ->join('reservation','customer.id','reservation.id_customer')
                ->where('reservation.date_in', '=', $date)
                ->where('status', '=', $stt)
                ->get();              
            }
            else if($stt == 0)
            {
                $res = DB::table('reservations')
                ->where('status', '=', $stt)
                ->get();                  
            }
            else
            {
               $res = DB::table('reservations')
                // ->where('checkin_date', '=', $date)
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
                    <td>'.$row->checkin_date.'</td>
                    <td>'.$row->checkout_date.'</td>
                ';
                if($row->status == 0)//Done
                {
                    if($stt == 2)
                    {
                        $output .= '<td><span class="stt-d p-2">Confirm</span></td></tr>';
                    }
                    else
                    {
                        $output .= '                       
                            <td><span class="stt-d p-2">Confirm</span></td>
                            <td class="p-1"><button class="btn-check-out btn btn-danger" id="'.$row->id.'">Check-out</button></td>
                        </tr>';
                    }                    
                }
                else if($row->status == 1)//Pending
                {
                     if($stt == 2)
                    {
                        $output .= '<td><span class="stt-p p-2">Pending</span></td>
                                    <td class="p-1"><button class="btn-confirm btn btn-success" id="'.$row->id.'">Confirm</button></td>
                                    <td class="p-1"><button class="btn-cancel btn btn-danger"  id="'.$row->id.'">Cancel</button></td>
                                </tr>';
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
                     $output .= '<td><span class="stt-c p-2">Cancel</span></td></tr>';
                }
                else
                {
                    $output .= '<td><span class="stt-d p-2">Done</span></td></tr>';
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
            DB::table('reservations')
                ->where('id', $id)
                ->update(['status' => 3]);
            $res = DB::table('reservations')
                ->join('res_details','reservations.id','res_details.reservation_id')
                ->where('reservations.id', '=', $id)
                ->get();
            foreach ($res as $i => $r) 
            {
                DB::table('room_types')
                ->where('id', $r->room_type_id)
                ->increment('available', $r->quantity);
            }
        }
    }

    public function cancelRes(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');
            DB::table('reservations')
                ->where('id', $id)
                ->update(['status' => 2]);   
        }
    }


    public function confirmRes(Request $req)
    {
        if($req->ajax())
        {
            $id = $req->get('id');
            DB::table('reservations')
                ->where('id', $id)
                ->update(['status' => 0]);
            $res = DB::table('reservations')
                ->join('res_details','reservations.id','res_details.reservation_id')
                ->where('reservations.id', '=', $id)
                ->get();
            foreach ($res as $i => $r) 
            {
                DB::table('room_types')
                ->where('id', $r->room_type_id)
                ->decrement('available', $r->quantity);
            }
        }
    }

// Manager account gr
    public function addManager(Request $req)
    { 
        if($req->ajax())
        {   
            $name = $req->get('name');
            $email = $req->get('email');
            $group = $req->get('group');

             $validation = Validator::make($req->all(), [
                'name' => 'required',
                'email'  => 'required|unique:users',
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
                $manager = new User([
                            'name'    =>  $name,
                            'email'     =>  $email,
                            'group_id' => $group,
                            'password' => Hash::make('123456'),
                        ]);
                $manager->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }
            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output
            );
            echo json_encode($output);
        }
    }

    public function getAccount(Request $req)
    {
        if($req->ajax())
        {
            $output='';
            $acc = DB::table('groups')        
                ->join('users','users.group_id','=','groups.id')
                ->where('groups.id', '=',1)
                ->orWhere('groups.id', '=',2)
                ->get();
            foreach($acc as $i=>$r)
            {
                $output .= '
                    <tr>
                        <td>'.($i+1).'</td>
                        <td>'.($r->name).'</td>
                        <td>'.($r->email).'</td>                
                    ';
                if($r->group_id==2)
                {
                    $output .= '                    
                        <td>'.($r->group_name).'</td>
                            <td><a href="#" id="'.($r->id).'" class="remove-role btn btn-danger pb-2 pt-2 pl-1 pr-1">Remove</a></td>
                            <td><a href="#" id="'.($r->id).'" class="delete-acc btn btn-danger pb-2 pt-2 pl-1 pr-1">Delete</a></td>
                    ';
                }
                else{
                    $output .= '<td>'.($r->group_name).'</td>
                            <td colspan="2"></td>';
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
            DB::table('users')
                ->where('id', $id)
                ->update(['group_id' => 3]);
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
            DB::table('users')
                ->where('id', $id)
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
                'room_description' => '',
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
}
