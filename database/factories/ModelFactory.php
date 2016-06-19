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

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['admin', 'user', 'power user']),
    ];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->country
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) use ($generateId) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'country_id' => function () use ($generateId) {
            return $generateId(App\Country::class);
        }
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
