<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'post_id'];

    /**
     * Many to Many with posts
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
