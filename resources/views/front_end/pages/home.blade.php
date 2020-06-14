@extends('front_end.layouts.master')
@section('title', 'Home | Moh Visual')
@section('description', 'Moh Visual Is One Of The Most Creative, Skillful And Professional Photographers In Nigeria. His Work Is Excellent')
@section('keywords', 'Moh Visual', 'Photography, Nice Pictures','Creative Photographer','Skillful Photographer')
@section('og_title','Home | Moh Visual')
@section('og_url',url('/'))
@section('og_description','One Of The Most Creative, Skillful Photographers In Nigeria')
<?php
$image = \App\Picture::latest()->first();
?>
@section('og_image',asset('images/backend_images/pictures/medium/'.$image->image))


@section('content')
<div class="content-wrapper">
    <div class="wrapper bg-pastel-default">
        <div class="container inner pt-50">
            <div class="flickity-carousel-container fullscreen">
                <div class="flickity flickity-carousel">

                    @foreach($pictures as $picture)
                        <div class="item mr-15"><a href="{{route('picture',$picture->image)}}">
                                <img src="{{asset('images/backend_images/pictures/medium/'.$picture->image)}}" alt="" />
                            </a></div>
                    @endforeach

                </div>
                <!-- /.flickity-carousel -->
                <p class="flickity-status"></p>
            </div>
            <!-- /.flickity-carousel-container -->
        </div>
        <!-- /.container -->
    </div>
    <div class="wrapper light-wrapper">
        <div class="container inner">
            <div class="row">
                <div class="col-md-12 text-right pr-35 pr-sm-15">
                    <h2 class="sub-heading" style="text-align: center!important;"><p style="font-weight: bold; font-size: 2em;text-align: center!important;color:#800000">Welcome!</p>
                        <span style="font-weight: bold;font-style: italic;color:maroon">Moh Visuals</span> <span style="color: #800000">offers you professional photography services.</span></h2>
                </div>
            </div>
            <!-- /.row -->
            <div class="space60"></div>
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-md-6 pr-35 pr-sm-15">
                    <figure class="overlay caption light rounded mb-30"><a href="{{route('portfolio',$banner->category->slug)}}">
                            <img src="{{asset('images/backend_images/banners/'.$banner->image)}}" alt="" />
                        </a>
                        <figcaption class="d-flex">
                            <div class="align-self-center mx-auto">
                                <div class="caption-inner">
                                    <h3 class="text-uppercase mb-0">{{$banner->category->name}}</h3>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                @endforeach
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <div class="wrapper light-wrapper">
        <div class="container inner">
            <h2 class="section-title text-center section-head">Featured Shots</h2>
            <div class="cube-carousel cbp boxed grid-view text-center">
                @foreach($albums as $album)
                <div class="cbp-item">
                    <div class="box bg-white shadow p-30">
                        <figure class="main polaroid overlay overlay1"><a href="{{route('album.photo',$album->slug)}}">
                                <img src="{{asset('images/backend_images/albums/medium/'.$album->cover_image)}}" alt="" /></a>
                            <figcaption>
                                <h5 class="text-uppercase from-top mb-0">See Photos</h5>
                            </figcaption>
                        </figure>
                        <h4 class="text-uppercase mb-0">{{$album->name}}</h4>
                        <div class="meta">
                            <span class="count">{{$album->photo->count()}} Photos</span>
                            <span class="category">{{$album->category->name}}</span>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                @endforeach

            </div>
            <!-- /.cbp -->
        </div>
        <!-- /.container -->
    </div>
    <div class="wrapper image-wrapper bg-image inverse-text"  data-image-src="{{asset('images/backend_images/banners/'.$home_banner->image)}}">
        <div class="container inner pt-150 pb-150">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cube-slider cbp-slider-edge cbp">
                        <div class="cbp-item">
                            <blockquote class="icon icon-top larger text-center pl-60 pr-60">
                                <p>{{$home_banner->text_1}}</p>
                            </blockquote>
                        </div>
                        <div class="cbp-item">
                            <blockquote class="icon icon-top larger text-center pl-60 pr-60">
                                <p>{{$home_banner->text_2}}</p>
                             </blockquote>
                        </div>

                    </div>
                    <!-- /.cbp -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <div class="wrapper gray-wrapper">
        <div class="container inner">
            <h2 class="section-title section-head text-center">Testimonials</h2>
            <div class="space30"></div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="cube-slider cbp-slider-edge cbp">
                        @foreach($testimonies as $testimony)
                        <div class="cbp-item pl-60 pr-60 pb-10">
                            <div class="row d-flex">
                                <div class="col-md-6 pr-35 pr-sm-15">
                                    <figure><img src="{{asset('images/backend_images/testimonies/' . $testimony->image)}}" alt="" /></figure>
                                </div>
                                <!--/column -->
                                <div class="col-md-6 align-self-center">
                                    <blockquote class="icon icon-left">
                                        <p>{{$testimony->body}}</p>
                                        <footer class="blockquote-footer">{{$testimony->name}}</footer>
                                    </blockquote>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                            @endforeach

                    </div>
                    <!-- /.cbp -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <div class="wrapper light-wrapper">
        <div class="container inner">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 pr-35 pr-sm-15" style="position: relative;top: -6.4em;">
                    <h2 class="section-title section-head text-center">My Story</h2>
                    <p class="lead">
                        My name is Mohammed Adedeji and photography is my passion.
                        It's what I love to do and I do it with apt attention to my art and to my customers.
                        I take pictures from weddings to potraits, lifestyle, fashion and arts photography without exception to families and ceremonies.

                        There are moments we cherish, moments we love and moments we adore.
                        The best way to relive these moments is to capture them.
                        You can count on me to capture your perfect and cherished moments.

                        What I think makes photography great is ...
                    </p>
                    <p></p>
                    <div class="space10"></div>
                    <a href="{{route('about')}}" class="btn btn-white shadow">More About Me</a>
                </div>
                <!-- /column -->
                <div class="space30 d-block d-lg-none d-xl-none"></div>
                <div class="col-lg-6">
                    <figure class="rounded"><img src="{{asset('front_end/images/Moh.jpg')}}" alt=""></figure>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="space70"></div>
            <div class="row">
                <div class="col-md-4">
                    <h4 class="section-title section-head text-center">My Skills</h4>
                    <ul class="progress-list">
                        <li>
                            <p>Photoshop</p>
                            <div class="progressbar line pastel-default" data-value="90"></div>
                        </li>
                        <li>
                            <p>Colouring</p>
                            <div class="progressbar line pastel-default" data-value="80"></div>
                        </li>
                        <li>
                            <p>Studio Photography</p>
                            <div class="progressbar line pastel-default" data-value="85"></div>
                        </li>
                    </ul>
                    <!-- /.progress-list -->
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    @include('front_end.widgets.archives')
                </div>
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </div>


</div>
@endsection
