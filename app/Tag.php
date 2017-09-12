<?php

namespace App;

class Tag extends FaresModel
{
    protected $fillable = ['name', 'post_id'];

    /**
     * Many to Many with posts
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Search scope for all entities
     * @param $query
     * @param $find
     * @param $field1
     * @return mixed
     */
    public function scopeGetByNameOrBody($query, $find, $field1)
    {
        return $query->where($field1,'like','%'.$find.'%');
    }


}
