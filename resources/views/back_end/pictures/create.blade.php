@extends('back_end.layouts.master')
@section('page','Add Picture')
@section('title','Upload Picture')
@section('breadcrumb')
    {{ Breadcrumbs::render('picture.add') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Picture details</h3>
                <p>Upload Single Pictures / Banners</p>
            </div>
            <div class="card">
                <h5 class="card-header">Album details</h5>
                <div class="card-body">
                    <form action="{{route('picture.add')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}


                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Select Picture</label>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Picture description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>


                        <div class="form-group">
                            <label for="input-select">Category</label>
                            <select class="form-control" id="input-select" name="category_id">
                                <option>Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="feature">
                                <span class="custom-control-label">Feature</span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Upload <i class="fa fa-arrow-up ml-2"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection