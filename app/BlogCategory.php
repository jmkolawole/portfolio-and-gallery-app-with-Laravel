<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    //
    protected $table = 'blog_categories';
    public $fillable = ['name'];


    public function posts(){
        return $this->hasMany('App\Post');
    }
}
