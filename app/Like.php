<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    /**
     * @return MorphTo
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
