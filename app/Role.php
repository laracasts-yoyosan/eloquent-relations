<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * The users assigned to a role.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
