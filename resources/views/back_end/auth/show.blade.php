@extends('back_end.layouts.master')
@section('page',$user->username .'/ Profile')
@section('title',"Show-profile | $user->username")

@section('breadcrumb')
    {{ Breadcrumbs::render('show.profile') }}
@endsection



@section('content')


    <div>

        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <style>
                            .emp-profile{
                                padding: 3%;
                                margin-top: 3%;
                                margin-bottom: 3%;
                                border-radius: 0.5rem;
                                background: #fff;
                            }
                            .profile-img{
                                text-align: center;
                            }
                            .profile-img img{
                                width: 70%;
                                height: 100%;
                            }
                            .profile-img .file {
                                position: relative;
                                overflow: hidden;
                                margin-top: -20%;
                                width: 70%;
                                border: none;
                                border-radius: 0;
                                font-size: 15px;
                                background: #212529b8;
                            }
                            .profile-img .file input {
                                position: absolute;
                                opacity: 0;
                                right: 0;
                                top: 0;
                            }
                            .profile-head h5{
                                color: #333;
                            }
                            .profile-head h6{
                                color: #0062cc;
                            }

                            .proile-rating{
                                font-size: 12px;
                                color: #818182;
                                margin-top: 5%;
                            }
                            .proile-rating span{
                                color: #495057;
                                font-size: 15px;
                                font-weight: 600;
                            }
                            .profile-head .nav-tabs{
                                margin-bottom:5%;
                            }
                            .profile-head .nav-tabs .nav-link{
                                font-weight:600;
                                border: none;
                            }
                            .profile-head .nav-tabs .nav-link.active{
                                border: none;
                                border-bottom:2px solid #0062cc;
                            }
                            .profile-work{
                                padding: 14%;
                                margin-top: -15%;
                            }
                            .profile-work p{
                                font-size: 12px;
                                color: #818182;
                                font-weight: 600;
                                margin-top: 10%;
                            }
                            .profile-work a{
                                text-decoration: none;
                                color: #495057;
                                font-weight: 600;
                                font-size: 14px;
                            }
                            .profile-work ul{
                                list-style: none;
                            }
                            .profile-tab label{
                                font-weight: 600;
                            }
                            .profile-tab p{
                                font-weight: 600;
                                color: #0062cc;
                            }


                        </style>
                        <h4 class="card-title">User Profile</h4>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="profile-img col-md-12" style="padding-left: 0!important;">
                                        <img class="img img-rounded" style="float: left!important;" src="{{asset('images/backend_images/users/'.$user->image)}}" alt=""/>
                                    </div>
                                    <div class="tag">
                                        @foreach($user->roles as $role)
                                            <span class="label label-info">{{$role->name}}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h5>
                                        {{$user->name}}
                                    </h5>
                                    <h6>
                                        {{-- {{$user->role->name}} --}}
                                    </h6>

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a type="button" class="profile-edit-btn btn btn-primary" style="color: white!important;" href="{{route('edit.profile')}}">Edit Profile</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-work">

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->username}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-6">
                                                @if($user->active == 1)
                                                    <p>Active</p>
                                                @elseif($user->active != 1)
                                                    <p>Inactive</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Created</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->created_at->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Last Updated</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->updated_at->diffForHumans()}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12 form-spacer float-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

@endsection

