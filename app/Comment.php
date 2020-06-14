<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['comment','email','name'];

    public function commentable(){
        return $this->morphTo();
    }


    public function comments(){
        return $this->morphMany('App\Comment','commentable')->latest();
    }

}
