<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

Collection::macro('dd', function () {
    dd($this);
});

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PostAndCommentsSeeder::class);
    }
}
