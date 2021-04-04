<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title', 'body', 'thumbnail',
    ];

    protected function getTitleAttribute($value)
    {
        return ucFirst($value);
    }

    protected function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }
}
