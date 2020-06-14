<?php

namespace App\Http\Controllers;

use App\Album;
use App\BlogCategory;
use App\Category;
use App\Picture;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all()->first();
        $categories = Category::all()->first();
        $blog_categories = BlogCategory::all()->first();
        $tags = Tag::all()->first();
        $pictures = Picture::all()->first();
        $albums = Album::all()->first();

        return response()->view('front_end.sitemaps.index', [
            'posts' => $posts,
            'categories' => $categories,
            'blog_categories' => $blog_categories,
            'tags' => $tags,
            'pictures' => $pictures,
            'albums' => $albums,
        ])->header('Content-Type', 'text/xml');
    }



    public function posts()
    {
        $posts = Post::latest()->get();

        return response()->view('front_end.sitemaps.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');

    }

    public function albums()
    {
        $albums = Album::latest()->get();

        return response()->view('front_end.sitemaps.albums', [
            'albums' => $albums,
        ])->header('Content-Type', 'text/xml');

    }


    public function pictures()
    {
        $pictures = Picture::latest()->get();

        return response()->view('front_end.sitemaps.pictures', [
            'pictures' => $pictures,
        ])->header('Content-Type', 'text/xml');

    }


    public function categories()
    {
        $categories = Category::latest()->get();

        return response()->view('front_end.sitemaps.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');

    }


    public function tags()
    {
        $tags = Tag::latest()->get();

        return response()->view('front_end.sitemaps.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');

    }


    public function blog_categories()
    {
        $blog_categories = BlogCategory::latest()->get();

        return response()->view('front_end.sitemaps.blog_categories', [
            'blog_categories' => $blog_categories,
        ])->header('Content-Type', 'text/xml');

    }


}
