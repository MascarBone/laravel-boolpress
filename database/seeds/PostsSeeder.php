<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Post;

use Faker\Generator as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 50; $i++)
        {
            $newPost = new Post();
            $newPost->title = $faker->words(15, true);
            $newPost->author = $faker->words(4, true);            
            $newPost->image_url = $faker->imageUrl(640, 480, 'Post of: ', true, $newPost->author);
            $newPost->content = $faker->text(500);
            $newPost->post_date = $faker->date('Y_m_d');
            $newPost->slug = Str::slug($newPost->title, '-');

            $newPost->save();
        }
    }
}
