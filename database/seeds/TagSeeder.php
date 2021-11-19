<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

use Faker\Generator as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $tagList = ['Funny','NewProject','Future','Trend','Helpful','Info','Meme','Draft'];

        foreach ($tagList as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->color = $faker->hexColor();

            $newTag->save();

        }

    }
}
