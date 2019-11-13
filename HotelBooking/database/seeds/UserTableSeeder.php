<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_customer = Role::where('name', 'customer')->first();
        $role_manager  = Role::where('name', 'admin')->first();
        $role_receptionist = Role::where('name', 'receptionist')->first();

        $employee = new User();
        $employee->name = 'Nguyen Van A';
        $employee->email = 'customer@gm.com';
        $employee->password = bcrypt('123456');
        $employee->save();
        $employee->roles()->attach($role_customer);

        $saler = new User();
        $saler->name = 'Tran Thi T';
        $saler->email = 'receptionist@gm.com';
        $saler->password = bcrypt('123456');
        $saler->save();
        $saler->roles()->attach($role_receptionist);

        $manager = new User();
        $manager->name = 'Admin';
        $manager->email = 'admin@gm.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
