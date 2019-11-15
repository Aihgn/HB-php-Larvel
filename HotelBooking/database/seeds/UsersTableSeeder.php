<?php

use Illuminate\Database\Seeder;
use App\user;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
       	$user->id = 1;
       	$user->name = 'Admin';
       	$user->email = 'admin@gm.com';
       	$user->password = bcrypt('123456');
       	$user->address = 'Hanoi';
       	$user->group_id = '1';
      	$user->save();

      	$user = new User();
       	$user->id = 2;
       	$user->name = 'Manager';
       	$user->email = 'manager@gm.com';
       	$user->password = bcrypt('123456');
       	$user->address = 'Hanoi';
       	$user->group_id = '2';
      	$user->save();

      	$user = new User();
       	$user->id = 3;
       	$user->name = 'Customer';
       	$user->email = 'customer@gm.com';
       	$user->password = bcrypt('123456');
       	$user->address = 'Hanoi';
       	$user->group_id = '3';
      	$user->save();
    }
}
