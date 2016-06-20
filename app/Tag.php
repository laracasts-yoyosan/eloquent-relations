<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    /**
     * The posts associated with this tag.
     *
     * @return MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * The videos associated with this tag.
     *
     * @return MorphToMany
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
