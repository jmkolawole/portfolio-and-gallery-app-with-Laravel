@extends('front_end.layouts.master')

@section('content')
    <div class="wrapper light-wrapper">

        <div class="container inner pt-60">
            <h2 class="section-title mt-20 mb-60 text-center">All Blog Posts</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="blog grid grid-view boxed boxed-classic-view">

                        @foreach($posts as $post)
                            <div class="post">
                                <div class="box bg-white shadow">
                                    <figure class="main mb-30 overlay overlay1 rounded"><a href="{{route('single',$post->slug)}}">
                                            <img src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" alt="" /></a>
                                        <figcaption>
                                            <h5 class="text-uppercase from-top mb-0">Read More</h5>
                                        </figcaption>
                                    </figure>
                                    <div class="meta mb-10"><span class="category"><a href="{{route('categories.blog',$post->category->slug)}}" class="hover color">{{$post->category->name}}</a></span></div>
                                    <h2 class="post-title"><a href="{{route('single',$post->slug)}}">{{$post->title}}</a></h2>
                                    <div class="post-content">
                                        <p>
                                            {{truncate(strip_tags($post->body), 150)}}
                                        </p>
                                    </div>
                                    <!-- /.post-content -->
                                    <hr />
                                    <div class="meta meta-footer d-flex justify-content-between mb-0">
                                        <span class="date">{{date('M j, Y',strtotime($post->publish_date))}}</span>
                                        @if($post->comments->count() != 0)
                                            <span class="comments"><a href="#">{{$post->comments->count()}}</a></span></div>
                                    @endif
                                </div>
                                <!-- /.box -->
                            </div>
                        @endforeach

                    </div>
                    <!-- /.blog -->
                {{$posts->links('vendor.pagination.bootstrap-4')}}
                <!-- /.pagination -->
                </div>
                <!--/column -->
            @include('front_end.widgets.sidebar')
            <!-- /column .sidebar -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </div>

@endsection
