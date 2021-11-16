<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['HTML','CSS','JS','Bootstrap','NODEJS','MAMP','SASS','PHP','MySQL','VueJS','Laravel',];

        foreach ($categories as $name) 
        {
            $category = new Category();

            $category->name = $name;
            $category->slug = Str::slug($name, '-');

            $category->save();

        }
        
    }
}
