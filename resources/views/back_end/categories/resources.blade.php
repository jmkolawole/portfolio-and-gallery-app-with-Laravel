@extends('back_end.layouts.master')
@section('page',$name)
@section('title',$name)
@section('breadcrumb')
    {{ Breadcrumbs::render('category.resources', $category) }}
@endsection

@section('style')
    <style>

        *, *:before, *:after{
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing:border-box;
            box-sizing: border-box;
        }


        .container{
            padding: 1em 0;
            float: left;
            width: 100%;
        }

        .content {
            position: relative;
            width: 90%;
            max-width: 400px;
            margin: auto;
            overflow: hidden;
        }

        .content .content-overlay {
            background: rgba(0,0,0,0.7);
            position: absolute;
            height: 99%;
            width: 100%;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            opacity: 0;
            -webkit-transition: all 0.4s ease-in-out 0s;
            -moz-transition: all 0.4s ease-in-out 0s;
            transition: all 0.4s ease-in-out 0s;
        }

        .content:hover .content-overlay{
            opacity: 1;
        }

        .content-image{
            width: 100%;
        }

        .content-details {
            position: absolute;
            text-align: center;
            padding-left: 1em;
            padding-right: 1em;
            width: 100%;
            top: 50%;
            left: 50%;
            opacity: 0;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-transition: all 0.3s ease-in-out 0s;
            -moz-transition: all 0.3s ease-in-out 0s;
            transition: all 0.3s ease-in-out 0s;
        }

        .content:hover .content-details{
            top: 50%;
            left: 50%;
            opacity: 1;
        }

        .content-details h3{
            color: #fff;
            font-weight: 500;
            font-size: 90%!important;
            letter-spacing: 0.15em;
            margin-bottom: 0.5em;
            text-transform: uppercase;
        }

        .content-details p{
            color: antiquewhite;
            font-size: 0.7em;
            font-weight: 400;
        }

        .fadeIn-bottom{
            top: 80%;
        }

        .fadeIn-top{
            top: 20%;
        }

        .fadeIn-left{
            left: 20%;
        }

        .fadeIn-right{
            left: 80%;
        }
    </style>
@endsection




@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-header" style="margin-left: -1.2em;!important;">Albums in "{{$name}}" category</h4>
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            @foreach($albums as $value)
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6" style="padding: 0!important;">
                                    <div class="container">
                                        <div class="content">
                                            <a href="{{route('album.show',$value->id)}}">
                                                <div class="content-overlay"></div>
                                                <img class="content-image image img img-thumbnail" src="{{asset('images/backend_images/albums/small/'.$value->cover_image)}}">
                                                <div class="content-details fadeIn-top">
                                                    <h3>{{$value->name}}</h3>
                                                    <p>{{$value->category->name}}</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="btn-group" style="float: right!important;position: relative;right: 5%;">
                                            <button type="button" class="btn btn-primary">Action</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('album.show',$value->id)}}">Open</a>
                                                <a class="dropdown-item" href="{{route('album.edit',$value->id)}}">Edit</a>
                                                <a class="dropdown-item" href="{{route('album.delete',$value->id)}}"
                                                   onclick="return confirm('Are you sure you want to delete this Album? Note that you cant retrieve all the pictures inside')">Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" style="text-align:center;padding-left: 10%!important;">
                                <p style="margin-left: 2em!important;">{{$albums->links()}}</p>

                            </div>

                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            @foreach($pictures as $value)

                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-header" style="margin-left: -1.2em;!important;">Pictures</h4>
                    <div class="row">
                        @foreach($pictures as $value)

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6" style="padding: 0!important;">
                                <div class="container">
                                    <div class="content">
                                        <a href="{{route('picture.show',$value->id)}}">
                                            <div class="content-overlay"></div>
                                            <img class="content-image image img img-thumbnail" src="{{asset('images/backend_images/pictures/small/'.$value->image)}}">
                                            <div class="content-details fadeIn-top">
                                                <p>{{$value->category->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="btn-group" style="float: right!important;position: relative;right: 5%;">
                                        <button type="button" class="btn btn-dark">Action</button>
                                        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('picture.show',$value->id)}}">Open</a>
                                            <a class="dropdown-item" href="{{route('picture.edit',$value->id)}}">Edit</a>
                                            <a class="dropdown-item" href="{{route('picture.delete',$value->id)}}"
                                               onclick="return confirm('Are you sure you want to delete this picture?')">Delete</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12" style="text-align:center;padding-left: 10%!important;">
                            <p style="margin-left: 2em!important;">{{$pictures->links()}}</p>

                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection


