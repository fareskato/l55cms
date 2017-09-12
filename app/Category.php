<?php

namespace App;


class Category extends FaresModel
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
     * Search scope for all entities
     * @param $query
     * @param $find
     * @param $field1
     * @param $field2
     * @return mixed
     */
    public function scopeGetByNameOrBody($query, $find, $field1, $field2 )
    {
        return $query->where($field1,'like','%'.$find.'%')
            ->orWhere($field2,'like','%'.$find.'%');
    }


}
