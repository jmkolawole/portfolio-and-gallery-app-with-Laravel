@extends('back_end.layouts.master')
@section('page','All users')
@section('title',"All Users")
@section('breadcrumb')
    {{ Breadcrumbs::render('show.users') }}
@endsection


@section('content')

    <div>

        <div class="row">
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <button href="" class="create-modal btn btn-success btn-sm" style="float: right!important;margin-bottom: 10px;" data-toggle="modal" data-target="#myModal">
                            Add New Admin <i class="fa fa-plus"></i>
                        </button>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form class="form-horizontal" role="form" method="POST" action="{{route('add.user')}}">
                                    {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-group row add">
                                                <label class="control-label col-sm-2" for="name">Username:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="name" name="username"
                                                           placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row add">
                                                <label class="control-label col-sm-2" for="name">Email:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="name" name="email"
                                                           placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="form-group row add">
                                                <label class="control-label col-sm-2" for="name">Password:</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="name" name="password"
                                                           placeholder="" required>

                                                </div>
                                            </div>

                                            <div class="form-group row add">
                                                <label class="control-label col-sm-2" for="name">Confirm <br> Password:</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="name" name="password_confirmation"
                                                           placeholder="" required>
                                                </div>
                                            </div>


                                        </div>



                                        <div class="modal-footer">
                                            <button class="btn btn-success" type="submit" id="add">
                                                <span class="fa fa-save"></span> Add
                                            </button>
                                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                                <span class="fa fa-window-close"></span> Close
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table table-bordered table-responsive-md table-responsive-xs">
                            <thead>
                            <tr>
                                <th><b>No:</b></th>
                                <th><b>Username</b></th>
                                <th colspan="3" style="text-align: center!important;"><b>Role(s)</b></th>
                                <th><b>Active</b></th>
                                <th><b>Action</b></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><b>User</b></th>
                                <th><b>Author</b></th>
                                <th><b>Admin</b></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php $no = 0;?>

                            @foreach($users as $user)
                                <?php $no++;?>
                                <tr>
                                    <form action="{{ route('assign.user') }}" method="POST">
                                        {{csrf_field()}}
                                        <td>{{$no}}<input type="hidden" name="id" value="{{$user->id}}"></td>
                                        <td>{{$user->name}}</td>
                                        <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                                        <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                                        <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                                        <style>
                                            input[type="checkbox"][readonly]{pointer-events: none}
                                        </style>
                                        <td style="">
                                            <div style="text-align: center!important;">
                                            <input type="checkbox" class=""  readonly
                                                   @if($user->active == 1)
                                                   checked ="checked"
                                                    @endif >

                                            </div>
                                        </td>


                                        <td>
                                            <button type="submit" class="btn btn-xs btn-secondary">Assign Role</button>
                                    </form>
                                    <a type="button" href="#show{{$user->id}}" class="btn btn-xs btn-success" data-toggle="modal"><span class="fa fa-eye"></span></a>

                                    <div  class="modal fade" id="show{{$user->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">User Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-10 col-lg-10">


                                                            <div class="form-group">
                                                                <label for="">Username:</label>
                                                                <b>{{$user->name}}</b>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">Email Address:</label>
                                                                <b>{{$user->email}}</b>
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">Created:</label>
                                                                <b>{{$user->updated_at->diffForHumans()}}</b>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Last Updated:</label>
                                                                <b>{{$user->updated_at->diffForHumans()}}</b>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Roles:</label>
                                                                @foreach($user->roles as $level)
                                                                    <b>{{$level->name}}</b>
                                                                @endforeach

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Status:</label>
                                                                @if($user->active == 1)
                                                                    <b style="color: green!important;">Active</b>
                                                                @else
                                                                    <b style="color: red!important;">Inactive</b>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="col-md-2 col-lg-2">
                                                            <img src="{{asset('images/backend_images/users/'.Auth::user()->image)}}" alt="" class="user-avatar-md rounded-circle">
                                                        </div>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <a type="button" href="#edit{{$user->id}}" class="btn btn-xs btn-primary" data-toggle="modal"><span class="fa fa-edit"></span></a>
                                    <div class="modal fade" id="edit{{$user->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Edit User</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <form class="form-horizontal" method="POST" role="form" action="{{route('edit.user')}}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$user->id}}">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <label for="name" class="control-label">Username</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$user->name}}"
                                                                       id="name" name="username">
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="control-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                       value="{{$user->email}}"
                                                                       id="name" name="email">
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="custom-control custom-checkbox">

                                                                    <input type="checkbox" @if($user->active == 1)checked @endif class="custom-control-input" name="active">
                                                                    <span class="custom-control-label">Active</span>
                                                                </label>
                                                            </div>





                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>

                                    <form method="POST" action="{{route('delete.user')}}" class="d-inline-block">
                                        <input type="hidden" value="{{$user->id}}" name="id">
                                        {{csrf_field()}}
                                        <button type= "submit" class="btn btn-xs btn-danger d-inline-block"  onclick="return confirm('Are you sure you want to delete this user?')">

                                            <span class="fa fa-trash"></span></button>

                                    </form>

                                    </td>



                                </tr>

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-lg-1"></div>
        </div>
    </div>

@endsection



