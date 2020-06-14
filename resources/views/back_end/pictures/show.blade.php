@extends('back_end.layouts.master')
@section('page',$picture->image)

@section('style')
    <style>
        .container {
            width: 100%;
        }

        .image {
            display: block;
            width: 100%;
            height: auto;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #000000;

        }


        .container:hover .overlay {
            opacity: .7;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .tag{
            display: block;
        }
    </style>
@endsection
@section('title','Picture')
@section('breadcrumb')
    {{ Breadcrumbs::render('picture.show', $picture) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h3 class="card-header"></h3>
                <div class="card-body">
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                <div class="row">

                                    <div class="col-xl-1 col-lg-1 col-md-1">

                                    </div>

                                    <div class="col-xl-10 col-lg-10 col-md-10">
                                        <img src="{{asset('images/backend_images/pictures/large/'.$picture->image)}}"
                                             alt="Avatar" class="image img img-thumbnail img-responsive">
                                    </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1">

                                    </div>
                                </div>

                            </div>



                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                <h4>Picture Details</h4>

                                <label class="form-spacer"><i class="fa fa-link form-spacer"></i> URL:</label>
                                <pre style="display: block; white-space: pre-line;margin-top: -7.5%"><a href="{{url('/').'/picture/'.$picture->image}}">
                                        {{url('/').'/picture/'.$picture->image}}</a></pre>

                            @if($picture->description != '')
                                <label class="form-spacer"><i class="fa fa-user"></i> Description:</label>
                                <p>{{$picture->description}}</p>
                                @endif

                                <label class="form-spacer"><i class="fa fa-clock"></i> Picture Created on:</label>
                                <p>{{date('M j, Y h:ia',strtotime($picture->created_at))}}</p>

                                <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                                <p>{{date('M j, Y h:ia',strtotime($picture->updated_at))}}</p>

                                 <span><p><a class="btn btn-outline-primary btn-sm btn-block" href="{{route('picture.edit',$picture->id)}}">
                                             <i class="fa fa-edit"></i> Edit Picture</a></p></span>

                            </div>



                        </div>

                        <div style="margin-top: 10px!important;" class="text-center">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection