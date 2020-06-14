@extends('back_end.layouts.master')
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
@section('page',$image->image)
@section('title','Album Photos')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h3 class="card-header"></h3>
                <div class="card-body">
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                <div class="row" style="margin-bottom:5%!important;">
                                    <a href="{{route('album.show',$image->album_id)}}" class="btn btn-primary" style="margin-right: 2%!important;">
                                        <i class="fa fa-arrow-left ml-2"></i> Back to Gallery
                                    </a>


                                </div>
                                <div class="row">

                                    <div class="col-xl-1 col-lg-1 col-md-1">

                                    </div>

                                  <div class="col-xl-10 col-lg-10 col-md-10">
                                      <img src="{{asset('images/backend_images/photos/large/'.$image->image)}}"
                                           alt="Avatar" class="image img img-thumbnail img-responsive">
                                  </div>

                                    <div class="col-xl-1 col-lg-1 col-md-1">

                                    </div>
                                </div>

                            </div>



                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                <h4>Image Details</h4>

                                <label class="form-spacer"><i class="fa fa-clock"></i> Image Created on:</label>
                                <p>{{date('M j, Y h:ia',strtotime($image->created_at))}}</p>

                                <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                                <p>{{date('M j, Y h:ia',strtotime($image->updated_at))}}</p>

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