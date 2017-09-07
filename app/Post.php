<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
