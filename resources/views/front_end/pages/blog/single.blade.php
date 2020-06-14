@extends('front_end.layouts.master')
@section('title', 'Blog | '.$post->title .' |' .' Moh Visuals')
@section('keywords', 'Moh Visual, Photography, Nice Pictures')
@if($post->description != "")
    @section('description', truncate(strip_tags($post->description), 130))
@else
    @section('description', truncate(strip_tags($post->body), 130))
@endif
@section('og_title','| Blog |'.$post->title .' |' .' Moh Visuals')
@section('og_url',url('/blog/'.$post->slug))

@if($post->description != "")
    @section('og_description', truncate(strip_tags($post->description), 60))
@else
    @section('og_description', truncate(strip_tags($post->body), 60))
@endif


@section('og_image',asset('images/backend_images/posts/medium/'.$post->image))

@section('content')
    <style>
        img{
            max-width: 100%!important;
        }
    </style>
    <div class="wrapper light-wrapper">
        <div class="container inner pt-60">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog classic-view boxed">
                        <div class="box bg-white shadow">
                            <div class="post text-center">
                                <figure class="main rounded">
                                    <img src="{{asset('images/backend_images/posts/large/'.$post->image)}}" alt="" style="width:100%!important;" />
                                </figure>
                                <div class="space10"></div>
                                <div class="post-content text-left">
                                    <div class="meta mb-10"><span class="category"><a href="{{route('categories.blog',$post->category->slug)}}" class="hover color">{{$post->category->name}}</a></span></div>
                                    <h1 class="post-title">{{$post->title}}</h1>
                                    <div class="meta"><span class="date">{{date('M j, Y',strtotime($post->publish_date))}}
                                            <?php
                                            $user = \App\User::where('id',$post->user_id)->first();
                                            ?>
                                        </span>
                                        @if(empty($post->author))
                                            <span class="author">By <a href="{{route('author.blog',$user->slug)}}">{{$user->name}}</a></span>
                                        @else
                                            <span class="author">By <span>{{$post->author}}</span></span>
                                        @endif
                                        @if($post->comments->count() != 0)
                                        <span class="comments"><a href="#">{{$post->comments->where('approved',1)->count()}}</a></span>
                                        @endif

                                    </div>
                                    <div>
                                        {!! $post->body !!}
                                    </div>

                                    <div class="tags mb-10 tex-center">

                                        @foreach ($post->tags as $value)
                                            <span class="badge badge-info badge-pill">
                                                <a href="{{route('tags.blog',$value->slug)}}" style="color:white!important;">
                                                    {{$value->name}}
                                                </a>
                                            </span>
                                        @endforeach
                                    </div>


                                    <ul class="social social-mute social-s text-center">
                                        <li><a href="https://www.facebook.com/sharer.php?u={{url('blog/'.$post->slug)}}" rel="noopener" target="_blank">
                                                <i class="fa fa-facebook"></i></a></li>
                                        <li><a href="http://www.twitter.com/share?url={{url('blog/'.$post->slug)}}&text={{truncate(strip_tags($post->body), 50)}}"
                                               rel="noopener" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="whatsapp://?text={{url('blog/'.$post->slug)}}" rel="noopener" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                    </ul>
                                    <!-- /.social -->
                                </div>
                                <!-- /.post-content -->
                            </div>
                            <style>
                                .hide-comment{
                                    margin-bottom: -2.3em!important;
                                }
                                .reply-form{
                                    display: none!important;
                                }
                            </style>

                            <div class="divider-icon"><i class="si-photo_aperture"></i></div>
                            <div id="comments">
                                @if($post->comments->count() != 0)
                                <h4>{{$post->comments->count()}} Comment(s) on "{{$post->title}}"</h4>
                                @endif
                                <ol id="singlecomments" class="commentlist">
                                    @foreach($post->comments as $comment)
                                    <li>
                                        <div class="message">
                                            <figure class="user rounded">
                                                <img alt='' src="{{'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $comment->email ) ) )}}" />
                                            </figure>
                                            <div class="message-inner">
                                                <div class="info">
                                                    <h6><a href="#">{{ucwords($comment->name)}}</a></h6>
                                                    <div style="font-size:12px!important;text-transform:uppercase;
                                                    font-weight:700;color:#909090;letter-spacing:1px;"> <span class="date">
                                                            {{date('M j, Y',strtotime($comment->created_at))}}
                                                            at {{date('h:ia',strtotime($comment->created_at))}}
                                                        </span>
                                                        <span class="reply">
                                                          @if($post->comments->count() != 0)
                                                            <a href="javascript:void(0)" onclick="replyToggle({{$comment->id}})">Reply</a>
                                                          @endif
                                                        </span>

                                                    </div>

                                                </div>
                                                @if($comment->hide == 0)
                                                    <p>Hidden Comment!</p>
                                                @elseif($comment->hide == 1)
                                                    <p>
                                                        {{$comment->comment}}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <br>

                                        @if($post->comments->count() != 0)
                                        <div style="width: 90%!important;margin: auto" class="reply-form-{{$comment->id}} reply-form">
                                            <div class="space20"></div>
                                            <form action="{{route('reply.comment',$comment->id)}}" method="POST" id="replyForm" class="comment-form"
                                                  style="margin-bottom:60px!important; ">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" placeholder="Name*">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Email*" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" rows="5" placeholder="Enter your comment here..."></textarea>
                                                </div>
                                                <button type="submit" style="float: right!important;margin-bottom:30px" class="btn">Reply</button>
                                            </form>
                                        </div>
                                        @endif

                                        <ul class="children">
                                            @foreach($comment->comments as $reply)
                                            <li class="bypostauthor">
                                                <div class="message">
                                                    <figure class="user rounded">
                                                        <img alt='' src="{{'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $reply->email ) ) )}}" />
                                                    </figure>
                                                    <div class="message-inner bypostauthor">
                                                        <div class="info">
                                                            <h6><a href="#">{{ucwords($reply->name)}}</a></h6>
                                                            <div class="meta"> <span class="date">
                                                                    {{date('M j, Y',strtotime($reply->created_at))}}
                                                    at {{date('h:ia',strtotime($reply->created_at))}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        @if($reply->hide == 0)
                                                            <p>Hidden Comment!</p>
                                                        @elseif($reply->hide == 1)
                                                            <p>
                                                                {{$reply->comment}}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                             @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ol>
                            </div>


                            @if($post->comment != 0)
                            <div class="divider-icon"><i class="si-photo_aperture"></i></div>
                            <h4>Would you like to share your thoughts?</h4>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <div class="space20"></div>
                            <form class="comment-form" method="POST" action="{{route('post.comment',$post->id)}}">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name*">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email*" name="email">
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" class="form-control" rows="5" placeholder="Enter your comment here..."></textarea>
                                </div>
                                <button type="submit" class="btn">Submit</button>
                            </form>
                             @endif


                        </div>
                        <!-- /.box -->

                        @if($related->count() != 0)
                        <h2 class="section-title mt-60 mb-60 text-center">You May Also Like</h2>
                        <div class="blog grid grid-view boxed">
                            <div class="row isotope">
                                @foreach($related as $value)
                                <div class="item post grid-sizer col-md-6 col-lg-6">
                                    <div class="box bg-white shadow p-30">
                                        <figure class="main mb-30 overlay overlay1 rounded">
                                            <a href="{{route('single',$value->slug)}}">
                                                <img src="{{asset('images/backend_images/posts/medium/'.$value->image)}}" alt="" />
                                            </a>
                                            <figcaption>
                                                <h5 class="text-uppercase from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>

                                        <span class="meta mb-10"><span class="category" style="display:inline-block!important;">
                                                <a href="{{route('categories.blog',$value->category->slug)}}" class="hover color">{{$value->category->name}}</a></span>
                                        </span>
                                        <span class="right text-right" style="display:inline-block!important;
                                        float: right!important;font-size:.9em!important;color:#ad7c83!important;">
                                            {{date('M j, Y',strtotime($value->publish_date))}}
                                        </span>

                                        <h2 class="post-title"><a href="{{route('single',$value->slug)}}">
                                                {{$value->title}}
                                            </a></h2>


                                    </div>
                                    <!-- /.box -->
                                </div>
                                @endforeach
                                <!-- /.post -->

                            </div>

                        </div>
                        @endif

                    </div>
                    <!-- /.blog -->
                </div>

                @include('front_end.widgets.sidebar')
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </div>

@endsection



<script>
    function replyToggle(commentId) {

        $('.reply-form-'+commentId).toggleClass('reply-form');
    }
</script>


