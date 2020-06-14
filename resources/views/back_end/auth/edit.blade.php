@extends('back_end.layouts.master')
@section('page',$user->username)
@section('title',"Edit-profile | $user->username")
@section('breadcrumb')
    {{ Breadcrumbs::render('edit.profile') }}
@endsection
@section('content')

    <div>
        {!! Form::model($user, ['route' => ['edit.profile'],'class'=> 'form-horizontal', 'data-parsley-validate'=> '','method' => 'POST','files' => true]) !!}
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Your Profile</h4>

                        <div><label for="name">Username:</label></div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fa fa-user-circle"></i></span>
                            </div>

                            {{Form::text('name',null,array('class' => 'form-control', 'required' => '','maxlength' => '255','minlength' => '4'))}}
                        </div>


                        <div><label for="email" class="form-spacer">Email:</label></div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class=" fa fa-envelope"></i></span>
                            </div>
                            {{Form::text('email',null,array('class' => 'form-control', 'required' => '','maxlength' => '255','minlength' => '4'))}}
                        </div>

                        <div>{{Form::label('image', 'Upload Account Profile Picture',['class' => 'form-spacer'])}}</div>
                        {{form::file('image')}}






                        <div class="row form-spacer">
                            <div class="col-md-6 col-lg-6 form-spacer">
                                <div class="form-group form-spacer">
                                    <div class="p-t-20">
                                        <a href="" class="btn btn-block btn-lg btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 form-spacer">
                                <div class="form-group form-spacer">
                                    <div class="p-t-20">
                                        <button type ="submit" class="btn btn-block btn-lg btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2"></div>
        </div>

        {!! Form::close() !!}

    </div>
@endsection


