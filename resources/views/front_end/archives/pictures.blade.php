@extends('front_end.layouts.master')

@section('content')
    <div class="wrapper light-wrapper">
        <div class="container inner pt-70">
            <h1 class="heading text-center">Hi, This is MOH Visuals</h1>
            <h2 class="sub-heading2 text-center">{{$date}} </h2>
            <div class="space50"></div>

            <div class="clearfix"></div>
            <div class="space20"></div>
            <div id="cube-inline-8" class="cbp cbp-inline-top cube-inline-8">
                @foreach($pictures as $picture)
                    <div class="cbp-item text-center">
                        <figure class="overlay overlay4 rounded"><a href="{{route('picture',$picture->image)}}" class="">
                                <img src="{{asset('images/backend_images/pictures/medium/'.$picture->image)}}" alt="" /></a>
                            <figcaption class="d-flex">
                                <div class="align-self-center mx-auto">
                                    <h3 class="caption mb-0">{{$picture->name}}</h3>
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

                {!! $pictures->links() !!}
            </div>
        </div>
        <!-- /.container -->
    </div>

@endsection


