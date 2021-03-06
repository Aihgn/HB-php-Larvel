<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
		$group->id = 1;
		$group->group_name = 'Admin';
		$group->save();

		$group = new Group();
		$group->id = 2;
		$group->group_name = 'Manager';
		$group->save();

		$group = new Group();
		$group->id = 3;
		$group->group_name = 'Customer';
		$group->save();
    }
}
