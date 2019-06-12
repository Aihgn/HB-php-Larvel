<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
