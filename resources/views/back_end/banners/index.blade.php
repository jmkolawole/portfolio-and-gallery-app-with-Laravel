@extends('back_end.layouts.master')
@section('page','Page Banners')


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
@section('title','All Banners')
@section('breadcrumb')
    {{ Breadcrumbs::render('banner.index') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-10 col-lg-10 col-sm-9 col-xl-10">
                        <h5 class="card-header">Banners</h5>
                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-3 col-xl-2">
                    </div>

                </div>

                <div class="card-body">
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            @foreach($banners as $value)
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6" style="padding: 2px!important;">
                                    <img src="{{asset('images/backend_images/banners/'.$value->image)}}"
                                         alt="Avatar" class="image img img-thumbnail">
                                    <div class="">
                                        <div class="text text-center">
                                            <span class="tag">{{$value->category->name}}</span>
                                        </div>
                                    </div>
                                    <div class="btn-group" style="float: right!important;">
                                        <button type="button" class="btn btn-secondary">Action</button>
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('banner.edit',$value->id)}}"
                                               onclick="return confirm('Are you sure you want to change this banner?')">Change</a>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection