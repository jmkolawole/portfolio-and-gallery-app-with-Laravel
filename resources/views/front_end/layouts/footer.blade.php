<footer class="dark-wrapper inverse-text">
    <div class="container inner">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="widget">
                    <h3 class="widget-title">Popular Albums</h3>
                    <ul class="image-list">

                        @foreach($popular as $value)
                        <li>
                            <figure class="rounded"><a href="{{route('album.photo',$value->slug)}}">
                                    <img src="{{asset('images/backend_images/albums/small/'.$value->cover_image)}}" alt="">
                                </a></figure>
                            <div class="post-content">
                                <h6 class="post-title"> <a href="{{route('album.photo',$value->slug)}}">{{$value->name}}</a> </h6>
                                <div class="meta"><span class="date">{{date('M j, Y',strtotime($value->created_at))}}</span>
                                    <i class="fa fa-eye"></i><span> {{$value->views->count()}}</span></div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    <!-- /.image-list -->
                </div>
                <!-- /.widget -->
            </div>


            <div class="col-md-6 col-lg-3">
                <div class="widget">
                    <h3 class="widget-title">From My Blog</h3>
                    <ul class="image-list">

                        @foreach($popular_posts as $value)
                            <li>
                                <figure class="rounded"><a href="{{route('album.photo',$value->slug)}}">
                                        <img src="{{asset('images/backend_images/posts/medium/'.$value->image)}}" alt="">
                                    </a></figure>
                                <div class="post-content">
                                    <h6 class="post-title"> <a href="{{route('single',$value->slug)}}">{{$value->title}}</a> </h6>
                                    <div class="meta"><span class="date">{{date('M j, Y',strtotime($value->created_at))}}</span>
                                        <i class="fa fa-eye"></i><span> {{$value->postviews->count()}}</span></div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                    <!-- /.image-list -->
                </div>
                <!-- /.widget -->
            </div>


            <div class="col-md-6 col-lg-3">
                <div class="widget">
                    <h3 class="widget-title">Get in Touch</h3>
                    <address>
                        <strong>Moh Visual Studios.</strong>
                        <abbr title="Phone">P:</abbr> +2347068551286 <br>
                        <abbr title="Email">E:</abbr> support@mohvisualstudios.com
                    </address>
                </div>
                <!-- /.widget -->
                <div class="widget">
                    <h3 class="widget-title">Elsewhere</h3>
                    <ul class="social social-mute social-s mt-10 mb-0">
                        <li><a href="https://twitter.com/mykelpound"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.facebook.com/mykeldollar"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/moh_visuals/?hl=en"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
            <div class="col-md-6 col-lg-3" style="padding: 0 0!important;position:relative!important;top:-30px!important;">

                <style>
                    ::-webkit-input-placeholder{
                        color:black!important;
                    }
                    ::-moz-placeholder{
                        color:black!important;
                    }
                    ::-ms-input-placeholder{
                        color:black!important;
                    }
                    ::placeholder{
                        color:black!important;
                    }
                </style>
                <div class="widget">
                    <h3 class="widget-title">Newsletter</h3>
                    <ul class="list-unstyled">

                        <li style="color:black!important; display: inline-block!important;width:70%!important;"><input type="email" style="color:black!important;
                        background-color: seashell!important;" name="subscriber_email" class="form-control"
                       id="subscriber_email" onfocus="enableSubscriber();" onfocusout="checkSubscriber();" placeholder="Your Email Address" >

                        </li>
                        <div class="input-group-append" style="display:inline-block!important;width:28%!important;">
                            <input type="button" value="Sign up" id="btnSubmit" style="width:90%!important;padding:18px 4px!important;" onclick="checkSubscriber(); addSubscriber();" class="btn btn-default"/>
                        </div>

                    </ul>

                    <span id="statusSubscribe" style="display: none;color: red;margin-top: 2em!important;"></span>

                    <span id="subscribed" style="display: none;color: green;margin-top: 2em!important;"></span>

                </div>

                <div class="widget">
                    <h3 class="widget-title">Learn More</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{route('about')}}" class="nocolor">About Us</a></li>

                    </ul>
                </div>
                <!-- /.widget -->
                <div class="widget">
                    <h3 class="widget-title">Need Help?</h3>
                    <ul class="list-unstyled">
                        <li><a href="{{route('contact')}}" class="nocolor">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->
        </div>
        <!--/.row -->
        <p class="mb-0"></p>
        <div class="space30"></div>
        <p class="text-center mb-0">© <script>document.write(new Date().getFullYear());</script> MOH visual Studios. All rights reserved.</p>
    </div>

</footer>


<script>





</script>