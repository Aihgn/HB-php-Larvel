<?php

use Illuminate\Database\Seeder;
use App\RoomType;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rt = new RoomType();
        $rt->id = 1;
        $rt->name = "Grand king";
        $rt->price = 250;
        $rt->image ='room1.jpg';
        $rt->quantity = 10;
        $rt->available =10;
        $rt->save();

        $rt = new RoomType();
        $rt->name = "Luxury";
        $rt->price = 200;
        $rt->image ='room2.jpg';
        $rt->quantity = 10;
        $rt->available =10;
        $rt->save();

        $rt = new RoomType();
        $rt->id = 3;
        $rt->name = "Deluxe";
        $rt->price = 150;
        $rt->image ='room3.jpg';
        $rt->quantity = 10;
        $rt->available =10;
        $rt->save();

        $rt = new RoomType();
        $rt->id = 4;
        $rt->name = "Superior";
        $rt->price = 100;
        $rt->image ='room4.jpg';
        $rt->quantity = 10;
        $rt->available =10;
        $rt->save();
    }
}
