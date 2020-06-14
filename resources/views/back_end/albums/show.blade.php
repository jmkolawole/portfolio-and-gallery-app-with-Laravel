@extends('back_end.layouts.master')
@section('page',$pictures->name)
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
@section('title','Albums')
@section('breadcrumb')
    {{ Breadcrumbs::render('album.show', $pictures) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h3 class="card-header">{{$pictures->name}}</h3>
                <div class="card-body">
                    <div class="container" style="padding: 2px!important;">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                <div class="row" style="margin-bottom:5%!important;">
                                    <a href="{{route('album.index')}}" class="btn btn-primary" style="margin-right: 2%!important;">
                                        <i class="fa fa-arrow-left ml-2"></i> Go back
                                    </a>
                                    <a href="{{route('photo.add',$pictures->id)}}" class="btn btn-success">
                                        <i class="fa fa-plus ml-2"></i> Add Photos to album
                                    </a>

                                </div>
                                <div class="row">
                                    @foreach($images as $value)

                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6" style="padding: 2px!important;">
                                            <a href="{{url('admin/album'.'/'.$pictures->id.'/'.$value->image)}}"><img src="{{asset('images/backend_images/photos/medium/'.$value->image)}}"
                                                 alt="Avatar" class="image img img-thumbnail img-responsive"></a>

                                          <div class="btn-group" style="float: right!important;">
                                            <button type="button" class="btn btn-dark">Action</button>
                                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{url('admin/album'.'/'.$pictures->id.'/'.$value->image)}}">Open</a>
                                                <a class="dropdown-item" href="{{route('photo.delete',$value->id)}}"
                                                onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
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
                                        <p style="margin-left: 2em!important;">{{$images->links()}}</p>

                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">

                                    </div>
                                </div>
                            </div>


                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                              <h4>Album Details</h4>
                                <div>
                                    <img src="{{asset('images/backend_images/albums/small/' . $pictures->cover_image)}}" class="img img-responsive img-thumbnail">
                                </div>

                                <label class="form-spacer"><i class="fa fa-link form-spacer"></i> URL:</label>
                                <pre style="display: block; white-space: pre-line;margin-top: -7.5%"><a href="{{url('/').'/album/'.$pictures->slug}}">
                                    {{url('/').'/album/'.$pictures->slug}}</a></pre>

                                <label class="form-spacer"><i class="fa fa-user"></i> Description:</label>
                                <p>{{$pictures->description}}</p>

                                <label class="form-spacer"><i class="fa fa-clock"></i> Album Created on:</label>
                                <p>{{date('M j, Y h:ia',strtotime($pictures->created_at))}}</p>

                                <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                                <p>{{date('M j, Y h:ia',strtotime($pictures->updated_at))}}</p>

                                 <span><p><a class="btn btn-outline-success btn-sm btn-block" href="{{route('album.edit',$pictures->id)}}">
                                 <i class="fa fa-edit"></i> Edit album</a></p></span>
                                 </div>

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