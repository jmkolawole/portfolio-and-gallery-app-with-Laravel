@extends('back_end.layouts.master')
@section('page','tags')
@section('title','Tags')


@section('breadcrumb')
    {{ Breadcrumbs::render('tags') }}
@endsection


@section('content')

    <div class="row">
        <div class="col-xl-2 col-lg-2">
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h4 class="card-header">Blog Tags</h4>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table table-bordered" id="table">
                                    <tr>
                                        <th width="150px">No:</th>
                                        <th>Name</th>
                                        <th class="text-center" width="150px">
                                            @if(Auth::user()->hasRole('Admin'))
                                                <button href="" class="create-modal btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            @endif
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <form class="form-horizontal" role="form" method="POST" action="{{route('add.tag')}}">
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title"></h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group row add">
                                                                    <label class="control-label col-sm-2" for="name">Name:</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="name" name="name"
                                                                               placeholder="Type tag name Here" required>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row add">
                                                                    <label class="control-label col-sm-2" for="name">Description: </label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="form-control" name="description"></textarea>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-success" type="submit" id="add">
                                                                    <span class="fa fa-save"></span> Save
                                                                </button>
                                                                <button class="btn btn-danger" type="button" data-dismiss="modal">
                                                                    <span class="fa fa-window-close"></span> Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>

                                    <div class="chat-box scrollable">
                                        <?php  $no=1; ?>
                                        @foreach($tag as $value)

                                            <tr class="tag{{$value->id}}">
                                                <td>{{ $value->id }}</td>
                                                <td><a href="{{route('tag.resources',$value->slug)}}">{{ ucwords($value->name) }}</a></td>
                                                <td><div class="actions">
                                                        <a class="d-inline-block show-modal btn btn-info btn-sm" data-toggle="modal"
                                                           href="#show{{$value->id}}"><i class="fa fa-eye"></i></a>
                                                        <div  class="modal fade" id="show{{$value->id}}" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title">tag Details</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="">Name:</label>
                                                                            <b><a href="{{route('tag.resources',$value->slug)}}">{{$value->name}}</a></b>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="">Description:</label>
                                                                            <b>{{$value->description}}</b>

                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="">Created:</label>
                                                                            <b>{{$value->updated_at->diffForHumans()}}</b>

                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="">Last Updated:</label>
                                                                            <b>{{$value->updated_at->diffForHumans()}}</b>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        @if(Auth::user()->hasRole('Admin'))
                                                            <a class="d-inline-block edit-modal btn btn-warning btn-sm" data-toggle="modal"
                                                               href="#{{$value->id}}"><i class="fa fa-pencil-alt"></i></a>
                                                            <div class="modal fade" id="{{$value->id}}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title">Edit tag</h4>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <form class="form-horizontal" method="POST" role="form" action="{{route('edit.tag',$value->id)}}">
                                                                                {{csrf_field()}}
                                                                                <div class="card-body">
                                                                                    <div class="form-group row">
                                                                                        <label for="name" class="control-label">tag</label>
                                                                                        <input type="text" class="form-control"
                                                                                               value="{{$value->name}}"
                                                                                               id="name" name="name">
                                                                                    </div>

                                                                                    <div class="form-group row">
                                                                                        <label for="description" class="control-label">Description</label>

                                                                                        <textarea class="form-control" name="description">{{$value->description}}</textarea>

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
                                                        @endif


                                                        @if(Auth::user()->hasRole('Admin'))
                                                            <form action="{{route('delete.tag',$value->id)}}" method="POST" class="d-inline-block">
                                                                {{csrf_field()}}
                                                                <button type="submit" class="d-inline-block delete-modal btn btn-danger btn-sm"
                                                                        onclick="return confirm('Are you sure you want to delete this tag?')"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        @endif

                                                    </div></td>
                                            </tr>





                                        @endforeach

                                    </div>
                                </table>
                                {{$tag->links('vendor.pagination.simple-bootstrap-4')}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2">
        </div>
    </div>
@endsection

@section('script')

@endsection