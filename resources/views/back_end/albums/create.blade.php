@extends('back_end.layouts.master')
@section('page','create album')
@section('title','Create New Album')
@section('breadcrumb')
    {!! Breadcrumbs::render('create.album') !!}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">Album details</h3>
                <p>Create a new album and add pictures to the album</p>
            </div>
            <div class="card">
                <h5 class="card-header">Album details</h5>
                <div class="card-body">
                    <form action="{{route('create.album')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Album Name</label>
                            <input id="inputText3" type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Album description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>



                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="cover_image">
                            <label class="custom-file-label" for="customFile">Select Cover Image</label>
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

                        <button type="submit" class="btn btn-primary">
                            Create <i class="fa fa-arrow-right ml-2"></i>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection