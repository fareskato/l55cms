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
