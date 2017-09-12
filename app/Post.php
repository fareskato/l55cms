<?php

namespace App;

class Post extends FaresModel
{
    protected $fillable = ['status'];

    /**
     * Many to Many with tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * one to Many with category
     */
    public function category()
    {
        return$this->belongsTo(Category::class);
    }

}
