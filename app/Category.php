<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public $fillable = ['name','description'];


    public function albums(){
        return $this->hasMany('App\Album');

    }

    public function pictures(){
        return $this->hasMany('App\Picture');

    }

    public function banners(){
        return $this->hasMany('App\Banner');
    }


}
