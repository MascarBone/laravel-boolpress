<?php

use Illuminate\Database\Seeder;
use App\User;

use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->name = 'User Prova';
        $newUser->email = 'mail@mail.com';
        $newUser->password = bcrypt('ciaociao');        
        $newUser->save();

        for($i = 0; $i < 10; $i++)
        {
            $newUser = new User();
            $newUser->name = $faker->userName();
            $newUser->email = $faker->safeEmail();
            $newUser->password = bcrypt($faker->password(9,14));

            $newUser->save();
        }
            

    }
}
