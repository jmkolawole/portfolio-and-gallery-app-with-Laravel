@extends('back_end.layouts.master')
@section('page',$testimony->name)
@section('title',$testimony->name)
@section('breadcrumb')
    {{ Breadcrumbs::render('testimony.show', $testimony) }}
@endsection

@section('content')


    <div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body show-post">
                        <h3 class="card-title d-inline-block">{{$testimony->name}}</h3>
                        <p>{!!html_entity_decode($testimony->body) !!}</p>

                    </div>
                </div>
            </div>


            <div class="col-sm-12 col--12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Testimony Details</h4>

                        <div>
                            <img src="{{asset('images/backend_images/testimonies/' . $testimony->image)}}" class="img img-responsive img-thumbnail">
                        </div>


                        <label class="form-spacer"><i class="fa fa-clock"></i> Testimony Created on:</label>
                        <p>{{date('M j, Y h:ia',strtotime($testimony->created_at))}}</p>

                        <label class="form-spacer"><i class="fa fa-clock"></i> Last Updated:</label>
                        <p>{{date('M j, Y h:ia',strtotime($testimony->updated_at))}}</p>





                        <div class="row">
                            <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer">
                              <button class="btn btn-primary btn-block" onclick="location.href = '{{route('testimony.edit',$testimony->id)}}';">
                                  <span style="color: white!important;">Edit</span></button>
                            </div>
                            <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer bottom-button">
                                <a class="btn btn-danger btn-block" onclick="location.href = '{{route('testimony.delete',$testimony->id)}}';">
                                    <span style="color: white!important;">Delete</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


