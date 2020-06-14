<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    //rotected $table = 'roles';
    //protected $fillable = ['name'];
    //protected $primaryKey = 'id';
    //public $timestamps = false;



    public function users()
    {
        return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
    }


}
