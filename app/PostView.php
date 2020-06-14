<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    //
    public function posts(){
        return $this->belongsTo('App\Post');
    }


    public static function createViewLog($post) {

        $postViews = new PostView;
        $postViews->post_id = $post->id;
        $postViews->url = \Request::url();
        $postViews->session_id = \Request::getSession()->getId();
        //$postViews->user_id = (\Auth::check())?\Auth::id():null; //this check will either put the user
        //  id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $postViews->ip = \Request::getClientIp();
        $postViews->agent = \Request::header('User-Agent');

        //($postViews->post_id);
        $view = PostView::where([['session_id',$postViews->session_id],['post_id',$postViews->post_id]])->first();
        if(!$view){
            $postViews->save();
        }
    }

}



