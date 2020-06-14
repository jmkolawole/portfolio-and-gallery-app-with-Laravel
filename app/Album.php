<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function photo(){
        return $this->hasMany('App\Photo');
    }

    public function views(){
        return $this->hasMany('App\AlbumView');
    }

}
