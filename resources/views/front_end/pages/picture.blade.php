@extends('front_end.layouts.master')
@section('title', $picture->image .' |' .' Moh Visuals')
@section('keywords', 'Moh Visual, Photography, Nice Pictures, portraits, arts, ceremonies')
@if($picture->description != "")
    @section('description', truncate(strip_tags($picture->description), 120))
@else
    @section('description', 'I take pictures from weddings to portraits, lifestyle, fashion and arts photography without exception to families and ceremonies')
@endif
@section('og_title',$picture->image .'|' .' Moh Visual')
@section('og_url',url('/picture/'.$picture->image))
@if($picture->description != '')
    @section('og_description', truncate(strip_tags($picture->description), 60))
@else

    @section('og_description', 'We Always Capture Your Moments Perfectly')
@endif

@section('og_image',asset('images/backend_images/pictures/medium/'.$picture->image))

@section('content')


    <div class="wrapper bg-pastel-default">
        <div class="container inner">
            <h2 class="section-title mb-40 text-center"></h2>
            <div class="flickity-slider-container fullscreen">
                <div class="flickity flickity-slider-main">


                        <div class="item"><img src="{{asset('images/backend_images/pictures/large/'.$picture->image)}}" alt="" /></div>

                </div>
                <p style="text-align: center" class="center text-center item">
                    @if($previous)
                    <a href="{{route('picture',$previous->image)}}"> << Previous</a> @endif&nbsp; &nbsp;
                    @if($next)
                    <a href="{{route('picture',$next->image)}}">Next >></a>
                        @endif

                </p>
                @if(!empty($picture->description))
                    <p class="postslider-title">{{$picture->description}}</p>
                    <label class="form-spacer"><i class="icon revicon-picture"></i> Created:</label>
                    <p>{{date('M j, Y',strtotime($picture->created_at))}}</p>
                    <label class="form-spacer"><i class="fa fa-eye"></i> Views:</label>
                    <p>{{$picture->views->count()}}</p>
                    @endif
                <!-- /.flickity -->
            </div>
            <!-- /.flickity-slider-container -->
        </div>
        <!-- /.container -->
    </div>


@endsection