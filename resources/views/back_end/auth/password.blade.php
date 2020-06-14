@extends('back_end.layouts.master')
@section('page','change password')
@section('title',"Change-password | $user->username")
@section('breadcrumb')
    {{ Breadcrumbs::render('edit.password') }}
@endsection

@section('content')

    <div>
        {!! Form::model($user, ['route' => ['edit.password'],'class'=> 'form-horizontal', 'data-parsley-validate'=> '','method' => 'POST','files' => true]) !!}
        <div class="row">
            <div class="col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>

                        <div><label for="name" class="form-spacer">New Password:</label></div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            {{Form::password('password',array('class' => 'form-control', 'required' => '','maxlength' => '255','minlength' => '4'))}}
                        </div>


                        <div><label for="name" class="form-spacer">Confirm Password:</label></div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="fa fa-user"></i></span>
                            </div>
                            {{Form::password('password_confirmation',array('class' => 'form-control', 'required' => '','maxlength' => '255','minlength' => '4'))}}
                        </div>



                        <div class="row form-spacer">
                            <div class="col-md-6 col-lg-6 form-spacer">
                                <div class="form-group form-spacer">
                                    <div class="p-t-20">
                                        <a href="{{route('show.profile')}}" class="btn btn-block btn-lg btn-warning">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 form-spacer">
                                <div class="form-group form-spacer">
                                    <div class="p-t-20">
                                        <button type ="submit" class="btn btn-block btn-lg btn-info">Update</button>
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

