<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use App\User;

use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $categories = Arr::pluck(Category::all(),'id');
        $categories_ids = Category::pluck('id')->toArray();
        $user_ids = User::pluck('id')->toArray();

        for($i = 0; $i < 50; $i++)
        {
            $newPost = new Post();
            $newPost->title = $faker->words(15, true);
            $newPost->category_id = Arr::random($categories_ids);
            $newPost->user_id = Arr::random($user_ids);            
            $newPost->image_url = $faker->imageUrl(640, 480, 'Post of: ', true, $newPost->author);
            $newPost->content = $faker->text(500);
            $newPost->post_date = $faker->date('Y_m_d');
            $newPost->slug = Str::slug($newPost->title, '-');

            $newPost->save();
        }
    }
}
