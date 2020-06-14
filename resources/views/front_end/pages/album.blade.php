@extends('front_end.layouts.master')
@section('title', $album->name .' |' .' Moh Visuals')
@section('keywords', 'Moh Visual, Photography, Nice Pictures')
@if($album->description != "")
    @section('description', truncate(strip_tags($album->description), 120))
@else
    @section('description', 'We Always Capture Your Moments Perfectly. Your Satisfaction Is My Motivation')
@endif
@section('og_title',$album->name .'|' .' Moh Visual')
@section('og_url',url('/album/'.$album->slug))
@if($album->description != '')
    @section('og_description', truncate(strip_tags($album->description), 60))
@else

    @section('og_description', 'We Always Capture Your Moments Perfectly')
@endif

@section('og_image',asset('images/backend_images/albums/medium/'.$album->cover_image))



@section('content')

    <div class="wrapper bg-pastel-default">
    <div class="container inner">
        <h2 class="section-title mb-40 text-center section-head">{{$album->name}}</h2>
        <div class="flickity-slider-container fullscreen">
            <div class="flickity flickity-slider-main">

                @foreach($album->photo as $photo)
                <div class="item"><img src="{{asset('images/backend_images/photos/large/'.$photo->image)}}" alt="" /></div>
                 @endforeach

            </div>
            <!-- /.flickity -->
            <div class="flickity flickity-slider-nav">

                @foreach($album->photo as $photo)
                <div class="item"><img src="{{asset('images/backend_images/photos/large/'.$photo->image)}}" alt="" /></div>

                    @endforeach
            </div>
            <!-- /.flickity -->

            <h1 class="post-title section-head">Album Story</h1>
            <p>{{$album->description}}</p>
            <label class="form-spacer section-head"><i class="icon revicon-picture"></i> Created:</label>
            <p>{{date('M j, Y',strtotime($album->created_at))}}</p>
            <label class="form-spacer section-head"><i class="fa fa-eye"></i> Views:</label>
            <p>{{$album->views->count()}}</p>

        </div>
        <!-- /.flickity-slider-container -->
    </div>
    <!-- /.container -->
</div>


@endsection