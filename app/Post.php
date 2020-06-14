<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function category(){
        return $this->belongsTo('App\BlogCategory');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable')->latest();
    }

    public function postviews(){
        return $this->hasMany('App\PostView');
    }

}
