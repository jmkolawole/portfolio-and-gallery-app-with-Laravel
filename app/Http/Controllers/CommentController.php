<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use Session;

class CommentController extends Controller
{
    //
    public function addPostComment(Request $request,Post $post){

        $this->validate($request,[
            'comment'=> 'required',
            'name'=>'required',
            'email'=> 'required'
        ]);



        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->email = $request->email;
        $comment->name = $request->name;


        $post->comments()->save($comment);

        return back();
    }



    public function addReplyComment(Request $request,Comment $comment){
        $this->validate($request,[
            'comment'=> 'required',
            'name'=>'required',
            'email'=> 'required'
        ]);

        /*$reply = new Comment();
        $reply->comment = $request->comment;
        $reply->email = $request->email;
        $reply->name = $request->name;


        $comment->comments()->save($reply);*/
        //$comment->addComment($request->comment,$request->email,$request->name);

        //dd($request);
        $reply = new Comment;
        $reply->comment = $request->comment;
        $reply->email = $request->email;
        $reply->name = $request->name;

        $comment->comments()->save($reply);
        return back();
        // return back()->withMessage('Comment Created');


    }


    public function update(Request $request, $id)
    {
        //

        $this->validate($request,[
            'comment'=> 'required',
            'name'=>'required',
            'email'=> 'required'
        ]);


        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->save();

        Session::flash('success',' Comment Updated Successfully!');
        return back();

    }

    public function hide($id){

        $comment = Comment::findOrFail($id);
        $comment->hide = 0;
        $comment->save();
        Session::flash('success',' Comment Hidden!');
        return back();

    }

    public function show($id){

        $comment = Comment::findOrFail($id);
        $comment->hide = 1;
        $comment->save();
        Session::flash('success',' Comment Visible!');
        return back();

    }


    public function destroy($id)
    {
        //
        $replies = Comment::where('commentable_id',$id)->where('commentable_type','App\Comment')->get();
        foreach($replies as $reply){
            $reply->delete();
        }
        $comment = Comment::findOrFail($id);
        $comment->delete();
        Session::flash('success',' Comment Deleted Successfully!');
        return back();

    }


}
