<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'body'];

    /**
     * one to Many with posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Search scope
     * @param $query
     * @param $find
     * @return mixed
     */
    public function scopeGetByNameOrBody($query, $find)
    {
        return $query->where('name','like','%'.$find.'%')
                     ->orWhere('body','like','%'.$find.'%');
    }

}
