@extends('back_end.layouts.master')
@section('page','All Testimonies')
@section('title','Testimonies')
@section('breadcrumb')
    {{ Breadcrumbs::render('testimony.index') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Testimonies ({{$testimonies->count()}})</h4>

                    <div class="comment-widgets scrollable">

                        @foreach($testimonies as $testimony)
                            <div class="d-flex flex-row comment-row m-t-0" id="post{{$testimony->id}}">
                                @if($testimony->image == '')
                                    <div class="p-2"><img src="assets/images/users/1.jpg" alt="user" width="50" class="img thumbnail img-responsive img-fluid"></div>
                                @endif
                                <div class="p-2"><img src="{{asset('images/backend_images/testimonies/' . $testimony->image)}}" width="50" class="img img-responsive img-fluid thumbnail"></div>
                                <div class="comment-text w-100">
                                    <h6 class="font-medium d-inline-block">{{$testimony->name}}</h6>
                                    <span class="m-b-15 d-block"><p>{{truncate($testimony->body,100)}}</p></span>
                                    <div class="comment-footer">
                                        <span class="text-muted float-right">{{$testimony->created_at->diffForHumans()}}</span>
                                        <button type="button" onclick="location.href = '{{route('testimony.edit',$testimony->id)}}';" class="btn btn-cyan btn-sm">Edit</button>
                                        <button type="button" onclick="location.href = '{{route('testimony.show',$testimony->id)}}';" class="btn btn-success btn-sm">Open</button>

                                        @if(Auth::user()->hasRole('Admin'))
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this testimony')"
                                        href="{{route('testimony.delete',$testimony->id)}}">
                                            <span style="color: white!important;">Delete</span></a>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="text-center" style="text-align:center!important;width:50%;margin: 0 auto;">
                            {!! $testimonies->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
