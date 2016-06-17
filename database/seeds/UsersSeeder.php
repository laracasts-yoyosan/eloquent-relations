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

        factory(App\User::class, 10)->create()
            ->each(function ($u) use ($roles) {
                factory(App\Phone::class)->create(
                    [
                        'user_id' => $u->getKey()
                    ]
                );

                $u->roles()->attach($roles->only(range(0, mt_rand(0, count($roles) - 1))));
            });
    }
}
