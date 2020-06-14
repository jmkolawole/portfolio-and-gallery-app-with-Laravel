@extends('back_end.layouts.master')
@section('page','Home Banner')
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
@section('title','Home Page Banner')
@section('breadcrumb')
    {{ Breadcrumbs::render('banner.home.index') }}
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

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <img src="{{asset('images/backend_images/banners/'.$banner->image)}}"
                                             alt="Avatar" class="image img img-thumbnail img-responsive">
                                    </div>
                                </div>

                            </div>



                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Home Banner Details</h4>

                                        <label class="form-spacer" style="color: lightseagreen"><i class="fa fa-pencil"></i> Caption 1</label>
                                        <p>{{$banner->text_1}}</p>

                                        <label class="form-spacer" style="color: lightseagreen"><i class="fa fa-pencil"></i> Caption 2</label>
                                        <p>{{$banner->text_2}}</p>


                                        <div class="row">
                                            <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer">
                                                <button class="btn btn-primary btn-block" onclick="location.href = '{{route('banner.home.edit')}}';">
                                                    <span style="color: white!important;">Change</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection