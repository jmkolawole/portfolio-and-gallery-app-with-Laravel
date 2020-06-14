<?php

namespace App\Providers;

use App\Album;
use App\BlogCategory;
use App\Picture;
use App\Tag;
use Illuminate\Support\ServiceProvider;
use App\Category;
use View;
use App\Post;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {
        //
        $categories = Category::all();

        $blog_categories = BlogCategory::all();

        $tags = Tag::all();

        $album_archive = Album::orderBy('created_at', 'desc')->whereNotNull('created_at')
            ->get()
            ->groupBy(function(Album $post) {
                return $post->created_at->format('Y');
            })
            ->map(function ($item) {
                return $item
                    ->sortByDesc('created_at')
                    ->groupBy( function ( $item ) {
                        return $item->created_at->format('F');
                    });
            });

        $picture_archive = Picture::orderBy('created_at', 'desc')->whereNotNull('created_at')
            ->get()
            ->groupBy(function(Picture $post) {
                return $post->created_at->format('Y');
            })
            ->map(function ($item) {
                return $item
                    ->sortByDesc('created_at')
                    ->groupBy( function ( $item ) {
                        return $item->created_at->format('F');
                    });
            });


        $post_archive = Post::orderBy('created_at', 'desc')->whereNotNull('created_at')
            ->get()
            ->groupBy(function(Post $post) {
                return $post->created_at->format('Y');
            })
            ->map(function ($item) {
                return $item
                    ->sortByDesc('created_at')
                    ->groupBy( function ( $item ) {
                        return $item->created_at->format('F');
                    });
            });


        $pop = Album::withCount('views')->orderBy('views_count', 'desc')->limit(3)
            ->get();

        $popular_posts = Post::where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 weeks', time())))
            ->where('publish',1)->withCount('postviews')->orderBy('postviews_count', 'desc')->limit(3)
            ->get();


        View::share( 'categories', $categories );
        View::share( 'album_archive',$album_archive );
        View::share( 'picture_archive',$picture_archive );
        View::share( 'post_archive',$post_archive );
        View::share( 'blog_categories',$blog_categories );
        View::share( 'tags',$tags );
        View::share( 'popular',$pop );
        View::share( 'popular_posts',$popular_posts);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
