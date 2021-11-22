<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesList = ['PrimaryRole', 'Authorizator', 'BreakController', 'TeaMaker', 'Knocker', 'OnHeavensDoor', 'Optimistic'];

        foreach ($rolesList as $key => $roleName) {
            $newRole = new Role();
            
            $newRole->name = $roleName;
            $newRole->level = $key;

            $newRole->save();
        }
    }
}
