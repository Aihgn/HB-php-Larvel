<?php

use Illuminate\Database\Seeder;
use App\RoomType;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room_type = new RoomType();
        $room_type->id = '1';
        $room_type->name = 'Family room';
        $room_type->image = 'room1.jpg';
        $room_type->price = '300';
        $room_type->description ='The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.';
        $room_type->save(); 

        $room_type = new RoomType();
        $room_type->id = '2';
        $room_type->name = 'Luxury room';
        $room_type->image = 'room2.jpg';
        $room_type->price = '350';
        $room_type->description ='The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.';
        $room_type->save(); 

        $room_type = new RoomType();
        $room_type->id = '3';
        $room_type->name = 'Couple room';
        $room_type->image = 'room3.jpg';
        $room_type->price = '250';
        $room_type->description ='The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.';
        $room_type->save(); 

        $room_type = new RoomType();
        $room_type->id = '4';
        $room_type->name = 'Standard room';
        $room_type->image = 'room4.jpg';
        $room_type->price = '200';
        $room_type->description ='The hotel provides smoking rooms. Please kindly inform the hotel in advance and the room is reserved subject to availability. Smoking in non-smoking rooms will get a penalty of $200/case.';
        $room_type->save(); 
    }
}
