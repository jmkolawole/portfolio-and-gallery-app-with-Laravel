@extends('front_end.layouts.master')
@section('title', 'Portfolio | Moh Visual')
@section('description','Moh Visual: I Take All Sorts Of Pictures Ranging From Fashion, Arts, Lifestyles, Portraits, Weddings Amongst Others')
@section('keywords', 'Moh Visual Studios, Best Photographer, Pictures, Arts, Lifestyles, Weddings, Portraits')
@section('og_title','Portfolio | Moh Visual')
@section('og_url',url('/portfolio/'.$slug))
@section('og_description','I Take Excellent Lifestyles, Arts And Portrait Pictures')

<?php
$image = \App\Picture::where('category_id',$id_number)->latest()->first();
?>

@section('og_image',asset('images/backend_images/pictures/medium/'.$image->image))

@section('content')

    <div class="wrapper light-wrapper">
        <div class="container inner pt-70">
            <h1 class="heading text-center section-head">Hi, This is MOH Visuals</h1>
            <h2 class="sub-heading2 text-center section-head">{{$category_name}} Pictures</h2>
            <div class="space50"></div>
        <div class="row">
    @foreach($pictures as $picture)
        <div class="col-md-2 col-lg-2">
            <figure class="overlay overlay4 rounded">

                <a href="{{route('picture',$picture->image)}}"><img src="{{asset('images/backend_images/pictures/small/'.$picture->image)}}" alt="" /></a>
                <figcaption class="d-flex">
                    <div class="align-self-center mx-auto">
                        <h3 class="caption mb-0">{{$picture->name}}</h3>
                    </div>
                </figcaption>

            </figure>

        </div>
    @endforeach
        </div>


        <div class="text-center page" style="text-align:center!important;width:50%;margin: 0 auto">

            {!! $pictures->links() !!}
        </div>

        </div>
    </div>

@endsection


