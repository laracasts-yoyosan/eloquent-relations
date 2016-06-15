<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class PostAndCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $bloggers = factory(App\User::class, 5)->create();
        $bloggersPosts = new Collection();
        $bloggers->each(function ($user) use (&$bloggersPosts) {
            $posts = factory(App\Post::class, mt_rand(3, 6))->create(
                [
                    'user_id' => $user->getKey(),
                ]
            );

            $bloggersPosts = $bloggersPosts->merge($posts);
        });

        $bloggersPosts->each(function ($post) {
            factory(App\Comment::class, mt_rand(2, 5))->create(
                [
                    'post_id' => $post->getKey(),
                ]
            );
        });
    }
}
