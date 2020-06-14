@extends('back_end.layouts.master')
@section('page','Edit Home banner')
@section('title','Edit Home Banner')
@section('breadcrumb')
    {{ Breadcrumbs::render('banner.home.edit') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('banner.home.edit')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Select Image</label>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Caption 1</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text_1">{{$banner->text_1}}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Caption 2</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text_2">{{$banner->text_2}}</textarea>
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

                    <h4 class="card-title">Home Banner Details</h4>

                    <div>
                        <img src="{{asset('images/backend_images/banners/' . $banner->image)}}" class="img img-responsive img-thumbnail">
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection