<?php

use Illuminate\Database\Seeder;

class TagsForVideosAndPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = factory(App\Tag::class, 20)->create();
        $videos = factory(App\Video::class, 10)->create();
        $posts = App\Post::all();

        $videos->each(function ($video) use ($tags) {
            $video->tags()->attach($tags->only(range(0, random_int(0, count($tags) - 1))));
        });
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->only(range(0, random_int(0, count($tags) - 1))));
        });
    }
}
