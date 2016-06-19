<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Country extends Model
{
    /**
     * A country's users.
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The posts for a country.
     *
     * @return HasManyThrough
     */
    public function posts()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}
