@extends('front_end.layouts.master')
@section('title', "$user->name's posts' | Moh Visual")
@section('description','Moh Visual: Check Out All Blog Posts By '.$user->name)
@section('keywords', 'Moh Visual Studios, Best Photographer,Posts, Pictures, Arts, Lifestyles, Weddings, Portraits,'.$user->name)
@section('og_title',"$user->name's posts' | Moh Visual")
@section('og_url',url('/blog/author/'.$slug))
@section('og_description','Check Out All Blog Posts By '.$user->name)

<?php

$image = \App\Post::where('user_id',$id)->where('author','<>','')->latest()->first();
?>
@section('og_image',asset('images/backend_images/posts/medium/'.$image->image))


@section('content')

    <div class="wrapper light-wrapper">
        <div class="container inner pt-60">
            <h2 class="section-title mt-20 mb-60 text-center">Posts By "{{$user->name}}"</h2>
            <div class="blog grid grid-view boxed">

                <div class="row">

                    <div class="col-md-8 col-lg-8">
                        @if($posts->count() == 0)
                            <h3>No Post Found</h3>
                        @else
                            <div class="row isotope">
                                @foreach($posts as $post)
                                    <div class="item post grid-sizer col-md-6 col-lg-6">
                                        <div class="box bg-white shadow p-30">
                                            <figure class="main mb-30 overlay overlay1 rounded">
                                                <a href="{{route('single',$post->slug)}}">
                                                    <img src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" alt="" />
                                                </a>
                                                <figcaption>
                                                    <h5 class="text-uppercase from-top mb-0">Read More</h5>
                                                </figcaption>
                                            </figure>
                                            <div class="meta mb-10"><span class="category"><a href="{{route('categories.blog',$post->category->slug)}}" class="hover color">{{$post->category->name}}</a></span></div>
                                            <h2 class="post-title"><a href="{{route('single',$post->slug)}}">{{$post->title}}</a></h2>
                                            <div class="post-content">
                                                <p>
                                                    {{truncate(strip_tags($post->body), 100)}}
                                                </p>
                                            </div>
                                            <!-- /.post-content -->
                                            <hr />
                                            <div class="meta meta-footer d-flex justify-content-between mb-0">
                                                <span class="date">{{date('M j, Y',strtotime($post->publish_date))}}</span>
                                                @if($post->comments->where('approved',1)->count() != 0)
                                                    <span class="comments"><a href="#">{{$post->comments->where('approved',1)->count()}}</a></span>
                                                @endif

                                            </div>
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                @endforeach

                            </div>


                            {{$posts->links('vendor.pagination.bootstrap-4')}}
                        @endif

                    </div>


                    @include('front_end.widgets.sidebar')


                </div>

                <!-- /.row -->
            </div>
            <!-- /.blog -->
            <div class="space30 d-block d-md-none"></div>
            <!-- /.pagination -->
        </div>
        <!-- /.container -->
    </div>
@endsection

