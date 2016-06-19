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
                factory(App\Phone::class)->create(
                    [
                        'user_id' => $u->getKey()
                    ]
                );

                $u->roles()->attach($roles->only(range(0, mt_rand(0, count($roles) - 1))));
                $u->country()->associate($countries[random_int(0, count($countries) - 1)]);

                $u->save();
            });
    }
}
