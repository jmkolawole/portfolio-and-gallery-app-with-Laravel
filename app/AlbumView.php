<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumView extends Model
{
    //
    public function albums(){
        return $this->belongsTo('App\Album');
    }




    public static function createViewLog($album) {

        $postViews= new AlbumView;
        $postViews->album_id = $album->id;
        $postViews->url = \Request::url();
        $postViews->session_id = \Request::getSession()->getId();
        //$postViews->user_id = (\Auth::check())?\Auth::id():null; //this check will either put the user  id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $postViews->ip = \Request::getClientIp();
        $postViews->agent = \Request::header('User-Agent');

        //($postViews->post_id);
        $view = AlbumView::where([['session_id',$postViews->session_id],['album_id',$postViews->album_id]])->first();
        if(!$view){
            $postViews->save();
        }
    }
}
