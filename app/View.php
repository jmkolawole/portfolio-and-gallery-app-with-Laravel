<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    //
    public function pictures(){
        return $this->belongsTo('App\Picture');
    }



    public static function createViewLog($picture) {

        $postViews= new View;
        $postViews->pic_id = $picture->id;
        $postViews->url = \Request::url();
        $postViews->session_id = \Request::getSession()->getId();
        //$postViews->user_id = (\Auth::check())?\Auth::id():null; //this check will either put the user  id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $postViews->ip = \Request::getClientIp();
        $postViews->agent = \Request::header('User-Agent');

        //($postViews->post_id);
        $view = View::where([['session_id',$postViews->session_id],['pic_id',$postViews->pic_id]])->first();
        if(!$view){
            $postViews->save();
        }
    }
}
