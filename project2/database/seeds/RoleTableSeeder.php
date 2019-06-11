<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $role_customer = new Role();
        $role_customer->name = 'customer';
        $role_customer->description = 'A Customer User';
        $role_customer->save();

        $role_receptionist = new Role();
        $role_receptionist->name = 'receptionist';
        $role_receptionist->description = 'A Receptionist User';
        $role_receptionist->save();

        $role_manager = new Role();
        $role_manager->name = 'admin';
        $role_manager->description = 'A Admin User';
        $role_manager->save();
    }
}
