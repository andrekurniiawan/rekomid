<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'post';
    }
}
