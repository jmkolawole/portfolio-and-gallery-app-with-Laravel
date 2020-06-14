<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Category;
use App\Post;
use App\PostView;
use App\Subscriber;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Session;

class BlogController extends Controller
{
    //
    public function index(){

        $posts = Post::with('tags')->with('category')->where('publish',1)->paginate(2);
        return view('front_end.pages.blog.index')->with(compact('posts'));
    }

    public function single($slug){


        $count = Post::with('category')->with('tags')->where('slug',$slug)->count();
        if($count == 0){
            abort(404);
        }


        $post = Post::with('category')->with('tags')->where('slug',$slug)->first();
        PostView::createViewLog($post);

        $related = Post::whereHas('tags', function ($q) use ($post){
            return $q->whereIn('name',$post->tags->pluck('name'));
        })->where('id','!=',$post->id)->take(4)->get();

        return view('front_end.pages.blog.single')->with(compact('post','related'));
    }

    public function categories($slug){
        $count = BlogCategory::where('slug',$slug)->count();
        if($count == 0){
            abort(404);
        }
        $blog_category = BlogCategory::where('slug',$slug)->first();
        $posts = Post::where('category_id',$blog_category->id)->paginate(2);
        return view('front_end.pages.blog.categories')->with(compact('blog_category','posts'));
    }

    public function tags($slug){
        $count = Tag::where('slug',$slug)->count();
        if($count == 0){
            abort(404);
        }
        $tag = Tag::where('slug',$slug)->first();
        $posts = $tag->posts()->orderBy('id','desc')->paginate(2);
        return view('front_end.pages.blog.tags')->with(compact('tag','posts'));

    }

    public function author($slug){

        $user = User::where('slug',$slug)->first();
        $id = $user->id;
        $posts = Post::where('user_id',$user->id)->where('author','<>','')->paginate(2);
        return view('front_end.pages.blog.authors')->with(compact('user','posts','id','slug'));
    }

    public function postArchive($month,$year){

        $categories = BlogCategory::all();
        $mth = date('m', strtotime($month));

        $posts = Post::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->paginate(6);
        $date = $month.', '.$year;

        $count = Post::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $mth)->count();
        if($count == 0){
            abort(404);
        }
        return view('front_end.pages.blog.archives')->with(compact('posts','date','categories','month','year'));
    }

    public function search(Request $request){



        $data = $request['search'];
        $categories = BlogCategory::get();
        $search_term = $data;
        $posts = Post::where('title','like','%'.$search_term.'%')->orWhere('body','like','%'.$search_term.'%')
            ->where('publish',1)->orderBy('id','desc')->paginate(1);

        return view('front_end.pages.blog.search')->with(compact('categories','posts','search_term'));

    }

    public function unsubscribe($email){

        $subscriber = Subscriber::where('email',$email)->first();
        if($subscriber->count() == 0){
            Session::flash('success','We do not have this email in our records.');
            return redirect()->route('home');
        }
        $subscriber->delete();

        Session::flash('success','You won\'t get our Newsletters again!');
        return redirect()->route('home');
    }




}
