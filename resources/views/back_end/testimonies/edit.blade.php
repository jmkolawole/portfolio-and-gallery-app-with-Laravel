@extends('back_end.layouts.master')
@section('page','Edit Testimony')
@section('title','Edit Testimony')
@section('breadcrumb')
    {{ Breadcrumbs::render('testimony.edit', $testimony) }}
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <p>Edit Testimony</p>
            </div>
            <div class="card">
                <h5 class="card-header">Testimony details</h5>
                <div class="card-body">
                    <form action="{{route('testimony.edit',$testimony->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputText3" class="col-form-label">Customer Name(s)</label>
                            <input id="inputText3" type="text" class="form-control" name="name" value="{{$testimony->name}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Body</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body">{{$testimony->body}}</textarea>
                        </div>


                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Select Image</label>
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