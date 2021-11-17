<?php

use Illuminate\Database\Seeder;
use App\Models\UserInfo;
use App\User;

use Faker\Generator as Faker;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach ($users as $user) {            
            $newInfo = new UserInfo();
            $newInfo->user_id = $user->id;
            $newInfo->name = $user->name;
            $newInfo->email = $user->email;
            $newInfo->address = $faker->sentence(5);
            $newInfo->phone = $faker->randomNumber(8,true);
            
            $newInfo->save();
        }
    }
}
