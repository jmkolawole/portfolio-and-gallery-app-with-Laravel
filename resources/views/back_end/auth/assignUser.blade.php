@extends('back_end.layouts.master')
@section('page','assign users')
@section('title',"All Users")


@section('content')

    <div>

        <div class="row">
            <div class="col-md-1 col-lg-1"></div>
            <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-2 col-lg-10 col-lg-offset-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>

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
                                <tr id="post{{$user->id}}">
                                    <form action="{{ route('assign.user') }}" method="POST">
                                        <td>{{$no}}<input type="hidden" name="id" value="{{$user->id}}"></td>
                                        <td>{{$user->username}}</td>
                                        <td><input type="checkbox" {{ $user->hasRole('User') ? 'checked' : '' }} name="role_user"></td>
                                        <td><input type="checkbox" {{ $user->hasRole('Author') ? 'checked' : '' }} name="role_author"></td>
                                        <td><input type="checkbox" {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role_admin"></td>
                                        <style>
                                            input[type="checkbox"][readonly]{pointer-events: none}
                                        </style>
                                        <td><input type="checkbox" class="form-control" readonly
                                                   @if($user->active == 1)
                                                   checked ="checked"
                                                    @endif></td>

                                        <td>
                                            <a type="button" href="{{route('show.user',$user->id)}}" class="btn btn-xs btn-success"><span class="fa fa-eye"></span></a>
                                            <a type="button" href="{{route('edit.user',$user->id)}}"class="btn btn-xs btn-primary"><span class="fa fa-edit"></span></a>
                                            <button type="button" class="btn btn-xs btn-danger delete" id="delid" value=""><span class="fa fa-trash"></span>
                                            </button>
                                            <meta name="_token" content="{{csrf_token()}}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-xs btn-default">Assign Role</button>
                                        </td>
                                    </form>
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


@section('script')
@endsection
