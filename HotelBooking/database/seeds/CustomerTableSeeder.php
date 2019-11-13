<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $customer->id_user = '1';
        $customer->name = 'Nguyen Van A';
        $customer->email = 'customer@example.com';
        $customer->phone_number ='0345678987';
        $customer->address = 'Hanoi';
        $customer->note = 'test';
        $customer->save();

        $customer = new Customer();
        $customer->id_user = '2';
        $customer->name = 'Tran Thi T';
        $customer->email = 'receptionist@example.com';
        $customer->phone_number ='0345678988';
        $customer->address = 'Hanoi';
        $customer->note = 'test';
        $customer->save();

        $customer = new Customer();
        $customer->id_user = '3';
        $customer->name = 'Admin';
        $customer->email = 'admin@example.com';
        $customer->phone_number ='0345678989';
        $customer->address = 'Hanoi';
        $customer->note = 'test';
        $customer->save();
    }
}
