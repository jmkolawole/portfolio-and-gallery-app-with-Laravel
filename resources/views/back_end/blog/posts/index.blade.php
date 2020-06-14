@extends('back_end.layouts.master')
@section('page','post')
@section('title','New Post')

@section('breadcrumb')
    {{ Breadcrumbs::render('posts') }}
@endsection


@section('content')

    <style>
        .table {
            width: 100%;
            max-width: 100%;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            border: none!important;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .post-form{
            padding: 0.275rem 0.55rem;
            margin: .5rem 2em;
            line-height: 1.5;
            background-color: #fff;
            background-clip: padding-box;
            border-radius: 4px;
            width: 10rem;

        }



    </style>
    <div class="card">
        <h3 class="card-header">All Posts</h3>
        <div id="filterContainer" style="margin-left:20px!important;">

            <span><a href="javascript:void(0);" id="all">All</a></span>

            <span> | </span>

            <span> <a href="javascript:void(0);" id="published">Published</a></span>

            <span> | </span>

            <span> <a href="javascript:void(0);" id="draft">Draft</a></span>

            <span>
                <select class="post-form select-1" id="select-1">
                    <option value="all-categories">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{$category->slug}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </span>

            <span>
                <select class="post-form select-2" id="select-2">
                    <option value="all-tags">All Tags</option>
                    @foreach($tags as $tag)
                        <option value="{{$tag->slug}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </span>
        </div>


        <div class="card-body">



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="posts" style="border-collapse: collapse;border: none" >

                                <thead style="border-bottom: 1px solid #dee2e6!important;">
                                <tr class="heading" style="border: none!important;">
                                    <th rowspan="2" style="vertical-align: top!important;">Title</th>
                                    <th rowspan="2" style="vertical-align: top!important;">Image</th>
                                    <th rowspan="2" style="vertical-align: top!important;">Publisher/Author</th>
                                    <th rowspan="2" style="vertical-align: top!important;">Category</th>
                                    <th rowspan="2" style="vertical-align: top!important;">Tags</th>
                                    <th colspan="2" align="center" style=" text-align: center!important;">Date</th>
                                    <th rowspan="2" style="vertical-align: top!important;text-align: center">Actions</th>
                                </tr>
                                <tr style="border: none!important;">
                                    <th style="font-size: .9em!important;">Drafted</th>
                                    <th style="font-size: .9em!important;">Published</th>
                                </tr>
                                </thead>



                                <tbody>
                                @foreach($posts as $post)
                                    <tr style="border: none!important;" class="all @if($post->publish == 1)published
                                        @elseif($post->publish == 0)draft @endif object all-categories {{$post->category->slug}}
                                            all-tags @foreach($post->tags as $tag) {{$tag->slug}}@endforeach">
                                        <td><a href="{{route('show.post',$post->id)}}">{{$post->title}}</a></td>
                                        <td>
                                            <img src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" alt="image" width="50" class="img thumbnail img-responsive img-fluid">
                                        </td>

                                        <td>
                                            <?php
                                            $user = \App\User::where('id',$post->user_id)->first();
                                            ?>
                                            <a href="{{route('publisher.resources',$user->id)}}" title="All Posts Published By '{{$user->name}}'">{{$user->name}}</a>
                                            @if(empty($post->author))

                                            @elseif(!empty($post->author))<br>
                                            <small style="font-size:1em!important;color:#909090">({{$post->author}})</small>
                                            @endif
                                        </td>
                                        <td><a href="{{route('blog.category.resources',$post->category->slug)}}"
                                               title="All Posts In '{{$post->category->name}}' Category">{{$post->category->name}}</a></td>

                                        <td>
                                            @foreach ($post->tags as $value)
                                                {{ $loop->first ? '' : ', ' }}
                                                <a href="{{route('tag.resources',$value->slug)}}" title="All Posts With '{{$value->name}}' Tag">{{ $value->name }}</a>
                                            @endforeach
                                        </td>

                                        <td>
                                            {{date('M j, Y',strtotime($post->created_at))}}<br><small>{{$post->created_at->diffForHumans()}}</small>
                                        </td>
                                        <td>@if($post->publish == 0)
                                                Not yet
                                            @elseif($post->publish == 1)
                                                {{date('M j, Y',strtotime($post->publish_date))}}<br><small>{{\Carbon\Carbon::parse($post->publish_date)->diffForHumans()}}</small>
                                            @endif</td>
                                        <td style="text-align: center!important;">
                                            <div class="btn-group">
                                                <a class="btn btn-info" href="{{route('show.post',$post->id)}}"><i class="fa fa-lg fa-eye"></i></a>
                                                <a class="btn btn-primary" href="{{route('edit.post',$post->id)}}"><i class="fa fa-lg fa-edit"></i></a>
                                                <a class="btn btn-danger post-delete" href="{{route('delete.post',$post->id)}}" onclick="return confirm('Are You Sure You Want To Delete This Post?')">
                                                    <i class="fa fa-lg fa-trash" style="color: white!important;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection


@section('script')

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>



    <script type="text/javascript">
        $('#posts').DataTable(
            {
                "paging": false,
            }
        );
    </script>

    <script>
        jQuery('#all').on('click', function() {
            $(".all").show();
        });
        jQuery('#published').on('click', function() {

            $(".all").hide();
            $(".published").show();

        });
        jQuery('#draft').on('click', function() {

            $(".all").hide();
            $(".draft").show();

        });


        jQuery('#filterContainer select').on('change', function() {


            var cat = jQuery('#select-1').val();
            var tag = jQuery('#select-2').val();

            jQuery('tr.object').hide();

            jQuery('tr.object').each(function() {
                if(jQuery(this).hasClass(cat) && jQuery(this).hasClass(tag)) {
                    jQuery(this).show();
                }
            });
        });

    </script>

@endsection
