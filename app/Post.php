<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    /**
     * Get the comments for a post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Likes for a post.
     *
     * @return MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
