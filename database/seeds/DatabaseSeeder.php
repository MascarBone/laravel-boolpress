<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            PostTagSeeder::class,
            UserInfoSeeder::class,
        ]);
    }
}
