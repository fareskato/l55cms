<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * Many to Many with tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
