<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = new Collection;
        foreach (['power user', 'admin', 'user'] as $role) {
            $roles->add(factory(App\Role::class)->create(['name' => $role]));
        }

        $countries = factory(App\Country::class, 5)->create();

        factory(App\User::class, 10)->create(
            [
                'country_id' => $countries[random_int(0, count($countries) - 1)]->getKey()
            ]
        )
        ->each(function ($u) use ($roles, $countries) {
            $u->phone()->save(factory(App\Phone::class)->make());

            $u->roles()->attach($roles->only(range(1, random_int(1, count($roles)))));
            $u->country()->associate($countries[random_int(0, count($countries) - 1)]);

            $u->save();
        });
    }
}
