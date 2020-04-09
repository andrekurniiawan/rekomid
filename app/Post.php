<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getRouteKeyName()
    {
        return 'post';
    }
}
