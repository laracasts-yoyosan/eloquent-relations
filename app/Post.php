<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the comments for a post.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
