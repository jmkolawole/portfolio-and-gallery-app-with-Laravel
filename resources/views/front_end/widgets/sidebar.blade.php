<aside class="col-md-4 sidebar">
    <div class="sidebox widget">
        <h3 class="widget-title">About Us</h3>
        <figure class="rounded mb-20"><img src="style/images/art/about.jpg" alt="" /></figure>
        <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum. Nulla vitae elit libero, a pharetra augue. Donec id elit.</p>
        <ul class="social social-color social-s">
            <li><a href="https://twitter.com/mykelpound"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.facebook.com/mykeldollar"><i class="fa fa-facebook-f"></i></a></li>
            <li><a href="https://www.instagram.com/moh_visuals/?hl=en"><i class="fa fa-instagram"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- /.widget -->
    <div class="sidebox widget">
        <h3 class="widget-title">Popular Posts</h3>
        <ul class="image-list">

            @foreach($popular_posts as $post)
            <li>
                <figure class="rounded"><a href=""><img src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" alt="" /></a></figure>
                <div class="post-content">
                    <h6 class="post-title"> <a href="{{route('single',$post->slug)}}">{{$post->title}}</a> </h6>
                    <div class="meta"><span class="date">{{date('M j, Y',strtotime($post->publish_date))}}</span>
                        @if($post->comments->count() != 0)
                            <span class="comments"><a href="#">{{$post->comments->where('approved',1)->count()}}</a></span>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <!-- /.image-list -->
    </div>
    <!-- /.widget -->
    <div class="sidebox widget">
        <h3 class="widget-title">Categories</h3>
        <ul class="unordered-list">
            @foreach($blog_categories as $category)
            <li><a href="{{route('categories.blog',$category->slug)}}">{{$category->name}}
                    <?php
                      $count = \App\Post::where('category_id',$category->id)->where('publish',1)->count();
                        ?>
                    ({{$count}})</a></li>
            @endforeach
        </ul>
    </div>
    <!-- /.widget -->
    <div class="sidebox widget">
        <h3 class="widget-title">Tags</h3>
        <ul class="list-unstyled tag-list">
            @foreach($tags as $tag)
            <li><a href="{{route('tags.blog',$tag->slug)}}" class="btn btn-white shadow">{{$tag->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <!-- /.widget -->

    <!-- /.widget -->
    <div class="sidebox widget">
        <h3 class="widget-title">Search</h3>
        <form class="search-form" action="{{route('search')}}" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search something">
            </div>
            <!-- /.form-group -->
        </form>
        <!-- /.search-form -->
    </div>




    @include('front_end.widgets.blog_archive')
</aside>
