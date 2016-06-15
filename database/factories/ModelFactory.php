<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$generateId = function ($class) {
    return factory($class)->create()->getKey();
};

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Phone::class, function (Faker\Generator $faker) use ($generateId) {
    return [
        'number' => $faker->phoneNumber,
        'user_id' => $generateId(App\User::class),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) use ($generateId) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => $generateId(App\User::class),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) use ($generateId) {
    return [
        'body' => $faker->sentence,
        'user_id' => $generateId(App\User::class),
        'post_id' => $generateId(App\Post::class),
    ];
});
