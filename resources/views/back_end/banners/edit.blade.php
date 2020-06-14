@extends('back_end.layouts.master')
@section('page','change page banner')
@section('title','Change Banner')
@section('breadcrumb')
    {{ Breadcrumbs::render('banner.edit',$banner) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Change banner in use</h3>
            </div>
            <div class="card">
                <h5 class="card-header">{{$banner->category->name}} Banner</h5>
                <div class="card-body">
                    <form action="{{route('banner.edit',$banner->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Select Image</label>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Change <i class="fa fa-arrow-right ml-2"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>

        <div class="col-sm-12 col--12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Banners currently in use</h4>


                    <div class="row">
                        <div class="col-md-6 no-space col-sm-12 col-xs-12">
                            <div class="cbp-item">
                                <div class="box bg-white shadow p-30">
                                    <figure class="main polaroid overlay overlay1">
                                            <img src="{{asset('images/backend_images/banners/'.$lifestyle->image)}}" alt=""
                                                 class="img-responsive" style="width: 100%!important;"/></a>
                                    </figure>
                                    <h4 class="text-uppercase mb-0"></h4>
                                    <div class="meta">
                                        <span class="category">{{$lifestyle->category->name}}</span>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                        <div class="col-md-6 no-space col-sm-12 col-xs-12" style="margin-bottom: 20px!important;">
                            <div class="cbp-item">
                                <div class="box bg-white shadow p-30">
                                    <figure class="main polaroid overlay overlay1">
                                        <img src="{{asset('images/backend_images/banners/'.$wedding->image)}}" alt=""
                                             class="img-responsive" style="width: 100%!important;"/></a>
                                    </figure>
                                    <h4 class="text-uppercase mb-0"></h4>
                                    <div class="meta">
                                        <span class="category">{{$wedding->category->name}}</span>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                        <div class="col-md-6 no-space col-sm-12 col-xs-12">
                            <div class="cbp-item">
                                <div class="box bg-white shadow p-30">
                                    <figure class="main polaroid overlay overlay1">
                                        <img src="{{asset('images/backend_images/banners/'.$fashion->image)}}" alt=""
                                             class="img-responsive" style="width: 100%!important;"/></a>
                                    </figure>
                                    <h4 class="text-uppercase mb-0"></h4>
                                    <div class="meta">
                                        <span class="category">{{$fashion->category->name}}</span>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                        <div class="col-md-6 no-space col-sm-12 col-xs-12">
                            <div class="cbp-item">
                                <div class="box bg-white shadow p-30">
                                    <figure class="main polaroid overlay overlay1">
                                        <img src="{{asset('images/backend_images/banners/'.$portrait->image)}}" alt=""
                                             class="img-responsive" style="width: 100%!important;"/></a>
                                    </figure>
                                    <h4 class="text-uppercase mb-0"></h4>
                                    <div class="meta">
                                        <span class="category">{{$portrait->category->name}}</span>
                                    </div>
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection