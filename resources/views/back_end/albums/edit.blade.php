@extends('back_end.layouts.master')
@section('page','edit album')
@section('title','Edit Album')
@section('breadcrumb')
    {{ Breadcrumbs::render('album.edit', $album) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <p>Edit and update Album details</p>
            </div>
            <div class="card">
                <h5 class="card-header">Album details</h5>
                <div class="card-body">
                    <form action="{{route('album.edit',$album->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Album Name</label>
                            <input id="inputText3" type="text" class="form-control" name="name" value="{{$album->name}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Album description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$album->description}}</textarea>
                        </div>


                        <div class="custom-file mb-3">
                            <div class="row" style="padding-left: 15px!important;">

                                <div class="col-md-9 col-lg-9">

                                    <input type="file" class="custom-file-input" id="customFile" name="cover_image">

                                    <label class="custom-file-label" for="customFile">Select Cover Image</label>
                                </div>

                            <div class="col-md-3 col-lg-3">
                                @if(!empty($album->cover_image))
                                    <img src="{{asset('/images/backend_images/albums/small/'.$album->cover_image)}}" width="70" height="70" class="img img-thumbnail">
                                    | <a href="{{route('album.delete-image',$album->id)}}" onclick="return confirm('Do you really want to delete this image?' +
                                      ' Note that your album will appear without a cover image');">Delete</a>
                                @endif
                            </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-select">Category</label>
                            <select class="form-control" id="input-select" name="category_id">

                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $album->category_id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Edit <i class="fa fa-arrow-right ml-2"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection