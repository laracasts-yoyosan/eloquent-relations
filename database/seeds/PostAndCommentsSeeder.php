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
        $bloggers = App\User::all();
        $bloggersPosts = new Collection();

        $bloggers->each(function ($user) use (&$bloggersPosts) {
            $posts = factory(App\Post::class, random_int(3, 6))->create(
                [
                    'user_id' => $user->getKey(),
                ]
            );

            $bloggersPosts = $bloggersPosts->merge($posts);
        });

        $bloggersPosts->each(function ($post) use ($bloggers) {
            foreach (range(0, random_int(2, 5)) as $value) {
                $post->likes()->save(factory(App\Like::class)->make());
            }

            factory(App\Comment::class, random_int(2, 5))->create(
                [
                    'post_id' => $post->getKey(),
                    'user_id' => function () use ($post, $bloggers) {
                        return $bloggers[random_int(0, count($bloggers) - 1)]->getKey();
                    }
                ]
            )->each(function ($comment) {
                foreach (range(0, random_int(2, 5)) as $value) {
                    $comment->likes()->save(factory(App\Like::class)->make());
                }
            });
        });
    }
}
