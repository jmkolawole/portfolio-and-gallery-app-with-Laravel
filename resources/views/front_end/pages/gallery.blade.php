@extends('front_end.layouts.master')
@section('title', 'Gallery | Moh Visual')
@section('description', 'Irrespective Of The Occasion, Moh Visuals Is Ever Ready To Capture Your Cherished Moments.')
@section('keywords', 'Moh Visual', 'Photography, Nice Pictures')
@section('og_title','Gallery | Moh Visual')
@section('og_url',url('/gallery'))
@section('og_description','Moh Visuals Is Ever Ready To Capture Your Cherished Moments')
<?php
$image = \App\Album::latest()->first();
?>
@section('og_image',asset('images/backend_images/albums/medium/'.$image->cover_image))

@section('content')
    <div class="wrapper light-wrapper">
        <div class="container inner pt-70">
            <h1 class="heading text-center section-head">Hi, This is MOH Visuals</h1>
            <h2 class="sub-heading2 text-center section-head">Check out my works</h2>
            <div class="space50"></div>
            <div class="d-flex flex-row align-items-center">
                <div>
                    <div class="cbp-l-filters-dropdownTitle">Filter By:</div>
                </div>


                <div>
                    <div id="cube-inline-8-filter" class="cbp-l-filters-dropdown">
                        <div class="cbp-l-filters-dropdownWrap">
                            <div class="cbp-l-filters-dropdownHeader">All</div>
                            <div class="cbp-l-filters-dropdownList">
                                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All</div>

                                @foreach($categories as $category)
                                <div data-filter=".{{$category->slug}}" class="cbp-filter-item">{{$category->name}}</div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="space20"></div>
            <div id="cube-inline-8" class="cbp cbp-inline-top cube-inline-8">
                @foreach($albums as $album)
                <div class="cbp-item text-center {{$album->category->slug}}">
                    <figure class="overlay overlay4 rounded">
                        <a href="{{route('album.photo',$album->slug)}}" class="cbp-singlePageInlin">
                            <img src="{{asset('images/backend_images/albums/medium/'.$album->cover_image)}}" alt="" /></a>
                        <figcaption class="d-flex">
                            <div class="align-self-center mx-auto">
                                <h3 class="caption mb-0">{{$album->name}}</h3>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <!--/.cbp-item -->
                    @endforeach
            </div>
            <!--/.cbp -->
            <style>
                .page{
                    margin-top: 2%!important;
                }
                .page li{
                    display: inline-block!important;
                }

            </style>
            <div class="text-center page" style="text-align:center!important;width:50%;margin: 0 auto">

                {!! $albums->links() !!}
            </div>
        </div>
        <!-- /.container -->
    </div>

@endsection


