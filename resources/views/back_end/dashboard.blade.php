@extends('back_end.layouts.master')

@section('page','dashboard')

@section('title','Dashboard')
@section('breadcrumb')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')

    <div class="ecommerce-widget">

        <div class="row">
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- recent orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Recent Albums</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Cover_image</th>
                                    <th class="border-0">Category</th>
                                    <th class="border-0">Title</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Created:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;?>
                                @foreach($albums as $album)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <div class="m-r-10"><img src="{{asset('images/backend_images/albums/small/'.$album->cover_image)}}" alt="user" class="rounded" width="45"></div>
                                    </td>
                                    <td><a href="{{route('category.resources',$album->category->slug)}}">{{$album->category->name}}</a></td>
                                    <td><a href="{{route('album.show',$album->id)}}">{{$album->name}}</a></td>
                                    <td>{{truncate($album->description,80)}}</td>
                                    <td>{{$album->created_at->diffForHumans()}}</td>

                                </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('album.index')}}" class="btn btn-outline-light float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Created:</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;?>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="{{route('category.resources',$category->slug)}}">{{$category->name}}</a></td>
                                        <td>{{$category->description}}</td>
                                        <td>{{$category->created_at->diffForHumans()}}</td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('category.index')}}" class="btn btn-outline-light float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Recent Pictures</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Picture</th>
                                    <th class="border-0">Category</th>
                                    <th class="border-0">Featured</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Created:</th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;?>
                                @foreach($pictures as $picture)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <a href="{{route('picture.show',$picture->id)}}"><div class="m-r-10"><img src="{{asset('images/backend_images/pictures/small/'.$picture->image)}}" alt="user" class="rounded" width="45"></div></a>
                                        </td>
                                        <td><a href="{{route('category.resources',$picture->category->slug)}}">{{$picture->category->name}}</a></td>
                                        <td>@if($picture->feature == 1 ) Yes @else No @endif</td>
                                        <td>{{truncate($picture->description,100)}}</td>
                                        <td>{{$picture->created_at->diffForHumans()}}</td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('picture.index')}}" class="btn btn-outline-light float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- recent orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Customer Testimonies</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Image</th>
                                    <th class="border-0">Title</th>
                                    <th class="border-0">Body</th>
                                    <th class="border-0">Created:</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                ?>

                                @foreach($testimonies as $testimony)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <div class="m-r-10"><img src="{{asset('images/backend_images/testimonies/'.$testimony->image)}}" alt="user" class="rounded" width="45"></div>
                                        </td>
                                        <td><a href="{{route('testimony.show',$testimony->id)}}">{{$testimony->name}}</a></td>
                                        <td>{{truncate($testimony->body,80)}}</td>
                                        <td>{{$testimony->created_at->diffForHumans()}}</td>

                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('testimony.index')}}" class="btn btn-outline-light float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if(Auth::user()->hasRole('Admin'))
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Banners</h5>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h6 class="card-header">Page</h6>
                                    <div class="card-body p-0">
                                        <img src="{{asset('images/backend_images/banners/'.$banner->image)}}"
                                             alt="Avatar" class="image img img-thumbnail img-responsive">

                                        <label class="form-spacer" style="color: lightseagreen"><i class="fa fa-pencil"></i> Caption 1</label>
                                        <p style="padding-left: 3px;!important;">{{$banner->text_1}}</p>

                                        <label class="form-spacer" style="color: lightseagreen"><i class="fa fa-pencil"></i> Caption 2</label>
                                        <p style="padding-left: 3px;!important;">{{$banner->text_2}}</p>
                                        <hr>
                                        <div style="text-align: center!important;">
                                        <span class="text-center">
                                            <a href="{{route('banner.home.edit')}}">Change</a></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card" style="margin: 0!important;">
                                    <h6 class="card-header">Categories</h6>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            @foreach($banners as $banner)
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                <div class="card">
                                                    <div class="card-body p-0">
                                                        <img src="{{asset('images/backend_images/banners/'.$banner->image)}}"
                                                             alt="Avatar" class="image img img-thumbnail">
                                                        <span style="color: skyblue!important;font-size: .8em;">{{$banner->category->name}}</span>/
                                                        <span><a href="{{route('banner.edit',$banner->id)}}">Change</a></span>
                                                    </div>

                                                </div>
                                            </div>
                                                @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                <div class="card">
                    <h5 class="card-header">Administrators</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">Username</th>
                                    <th class="border-0">Avatar</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Role(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                ?>


                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            <div class="m-r-10"><img src="{{asset('images/backend_images/users/'.$user->image)}}" alt="user" class="rounded" width="45"></div>
                                        </td>
                                        <td>
                                            @if($user->active == 0)
                                                <span class="label label-danger">Inactive</span>
                                            @elseif($user->active == 1)
                                                <span class="label label-success">Active</span>
                                            @endif
                                        </td>

                                        <td>
                                           @foreach($user->roles as $level)
                                               {{$level->name}}
                                               @endforeach
                                        </td>




                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="9"><a href="{{route('show.users')}}" class="btn btn-outline-light float-right">View More</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         @endif

    </div>

@endsection