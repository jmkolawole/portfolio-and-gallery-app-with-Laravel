@extends('back_end.layouts.master')
@section('page','show post')
@section('title',$post->title)


@section('breadcrumb')
    {{ Breadcrumbs::render('show.post', $post) }}
@endsection


@section('content')

    <style>
        .tag a{
            color: white!important;
            text-decoration: none!important;
        }
    </style>

    <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="display: inline;float: left;" class="card-title">{{$post->title}}</h3>

                                    <span style="display: inline;float: right;">Category: <a href="{{route('category.resources',$post->category->slug)}}"><b>{{$post->category->name}}</b></a></span>
                                </div>
                            </div>

                            <hr>

                            <div style="margin-top: 10px!important;">
                                {!! $post->body !!}
                            </div>

                            <hr>
                            <h6>Tags</h6>

                            <div class="bs-component tag">
                                @foreach($post->tags as $tag)
                                    <span class="badge badge-pill badge-info"><a href="{{route('tag.resources',$tag->slug)}}">{{$tag->name}}</a></span>
                                @endforeach
                            </div>

                            <style>
                                .message{
                                    margin-top: 5px;
                                }
                                .me a{
                                    color: azure;
                                }
                                .message img{
                                    width: 50px!important;
                                }
                            </style>

                        </div>
                        <br>
                        <br>


                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>FEATURED IMAGE</h6>
                            <hr>
                            <div>
                                <img src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" class="img img-responsive img-thumbnail">
                            </div>

                            <br>
                            <br>
                            <h6>AUTHOR</h6>
                            <hr>
                            @if(empty($post->author))
                                <?php
                                $user = \App\User::where('id',$post->user_id)->first();
                                ?>
                                <a href="">{{$user->name}}</a>
                            @elseif(!empty($post->author))
                                <a href="">{{$post->author}}</a>
                            @endif

                            @if(!empty($post->keywords))
                                <br>
                                <br>
                                <h6>KEYWORDS</h6>
                                <hr>
                                <div class="card mb-3 text-black bg-light">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            {{$post->keywords}}
                                        </blockquote>
                                    </div>
                                </div>
                            @endif

                            <br>
                            <br>

                            @if(!empty($post->description))
                                <br>
                                <h6>DESCRIPTION</h6>
                                <hr>
                                <div class="card mb-3 text-black bg-light">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            {{$post->description}}
                                        </blockquote>
                                    </div>
                                </div>
                            @endif


                            <br>
                            <br>
                            <h6>URL:</h6>
                            <pre style="display: block; white-space: pre-line;margin-top: -7.5%"><a href="{{url('/').'/blog'.'/'.($post->slug)}}">
                                    {{url('/').'/blog'.'/'.($post->slug)}}</a></pre>



                            <br>
                            <br>
                            <i class="fa fa-clock"></i><h6>TIMELINE</h6>
                            <div class="bs-component">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#created"><small>Created</small></a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#updated"><small>Updated</small></a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#published"><small>Published</small></a></li>
                                </ul>
                                <div class="tab-content" id="myTabContent" style="padding-top: 1em!important;">
                                    <div class="tab-pane fade active show" id="created">
                                        <p>
                                            <i class="fa fa-clock"></i> {{date('M j, Y h:ia',strtotime($post->created_at))}}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="updated">
                                        <p>
                                            {{date('M j, Y h:ia',strtotime($post->updated_at))}}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="published">
                                        <p>
                                            @if(!empty($post->publish_date))
                                                {{date('M j, Y h:ia',strtotime($post->publish_date))}}
                                            @elseif(empty($post->publish_date))
                                                Not Yet Published
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>


                            <br>
                            <br>
                            <h6><i class="fa fa-eye"></i> UNIQUE VIEWS:</h6>
                            <p></p>

                            <br>
                            <br>
                            <div class="row">

                                @if($post->publish == 0)
                                    <div class="col-md-6">

                                <span><p><a class="btn btn-outline-info btn-sm" style="font-size: .8em!important;" href="{{route('publish.post',$post->id)}}">
                                            <i class="icon fa fa-pencil"></i> Publish This Post</a></p></span>
                                    </div>
                                @elseif($post->publish == 1)

                                    <div class="col-md-6">
                                <span><p><a class="btn btn-sm btn-outline-secondary" href="{{route('hide.post',$post->id)}}" style="font-size: .8em!important;">
                                            <i class="icon fa fa-eye-slash"></i> Hide This Post</a></p></span>
                                    </div>
                                @endif

                                @if($post->comment == 0)
                                    <div class="col-md-6">
                                <span><p style="margin-left: -1em!important;"><a style="font-size: .8em!important;"
                                                                                 class="btn btn-outline-success btn-sm" href="{{route('allow.comment',$post->id)}}">
                                            <i class="fa fa-comment"></i> Enable Comments</a>
                                    </p></span>
                                    </div>
                                @elseif($post->comment == 1)
                                    <div class="col-md-6">
                                    <span><p style="margin-left: -1em!important;"><a class="btn btn-outline-warning btn-sm" style="font-size: .8em!important;" href="{{route('disallow.comment',$post->id)}}">
                                                <i class="fa fa-comment-slash"></i> Disable Comments</a></p></span>
                                    </div>
                                @endif


                                @if($post->publish == 1)

                                    <div class="form-spacer col-md-12" style="margin-top: 1em!important;">
                                    <span><p><a class="btn btn-sm btn-block btn-info" href="{{route('send.newsletter',$post->id)}}">
                                                <i class="fa fa-address-book"></i> Send Notification</a></p></span>
                                    </div>
                                @endif

                            </div>

                            <br>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer">
                                    <button class="btn btn-primary btn-block" onclick="location.href = '{{route('edit.post',$post->id)}}'" type="button">Edit</button>
                                </div>
                                <div class="col-md-6 no-space col-sm-12 col-xs-12 form-spacer bottom-button">
                                    <a class="btn btn-danger btn-block" href="{{route('delete.post',$post->id)}}"
                                       onclick="return confirm('Are You Sure You Want To Delete This Post?')"
                                       style="color: white!important;" id="post-delete" type="button">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                    @if($post->comments->count() > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <h3 class="tile-title">Comments</h3>
                                    <div class="messanger">
                                        <div class="messages">
                                            @foreach($post->comments as $comment)
                                                <div class="message">
                                                    <img style="display: inline-block!important; margin:-48px 10px 0 0!important;"
                                                         src="{{'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $comment->email ) ) )}}">

                                                    <p class="info" style="display: inline-block!important;"><b style="color: maroon!important;">{{ucwords($comment->name)}}</b><br>{{$comment->comment}}<br>
                                                        <small><a href="#{{$comment->id}}" data-toggle="modal">Edit</a> |
                                                            @if($comment->hide == 1)
                                                                <a href="{{route("hide.comment",$comment->id)}}">Hide</a> |
                                                            @elseif($comment->hide == 0)
                                                                <a href="{{route("show.comment",$comment->id)}}">Show</a> |
                                                            @endif
                                                            <a href="{{route('delete.comment',$comment->id)}}"
                                           onclick="return confirm('Are You Sure You Want To Delete This Comment? Note That All Replies Will Be Deleted As Well.')"
                                                               class="delete-comment">Delete</a>
                                                        </small>
                                                    </p>

                                                    <div class="modal fade" id="{{$comment->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title">Edit Comment</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <form class="form-horizontal" method="POST" role="form"
                                                                          action="{{route('update.comment',$comment->id)}}">
                                                                        {{csrf_field()}}
                                                                        <div class="card-body">
                                                                            <div class="form-group row">
                                                                                <label for="name" class="control-label">Name:</label>
                                                                                <input type="text" class="form-control"
                                                                                       value="{{$comment->name}}"
                                                                                       id="name" name="name">
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="name" class="control-label">Email:</label>
                                                                                <input type="text" class="form-control" id="email"
                                                                                       value="{{$comment->email}}" name="email">
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="cono1" class="control-label">Message</label>

                                                                                <textarea class="form-control" name="comment">{{$comment->comment}}</textarea>

                                                                            </div>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div>
                                                </div>

                                                @foreach($comment->comments as $reply)

                                                    <div class="message" style="margin-left:50px!important;">
                                                        <img style="display: inline-block!important; margin:-48px 10px 0 0!important;"
                                                             src="{{'https://www.gravatar.com/avatar/' . md5( strtolower( trim( $reply->email ) ) )}}">
                                                        <p class="info" style="display: inline-block!important;"><b style="color: darkgreen">{{ucwords($reply->name)}}</b>
                                                            <br>{{$reply->comment}}<br>
                                                            <small><a data-toggle="modal" href="#{{$reply->id}}">Edit</a> |
                                                                @if($reply->hide == 1)
                                                                <a href="{{route("hide.comment",$reply->id)}}">Hide</a> |
                                                                @elseif($reply->hide == 0)
                                                                <a href="{{route("show.comment",$reply->id)}}">Show</a> |
                                                                @endif
                                                                <a href="{{route('delete.comment',$reply->id)}}"
                                                                   onclick="return confirm('Are You Sure You Want To Delete This Comment?')" class="delete-reply">Delete</a></small>
                                                        </p>
                                                        <div class="modal fade" id="{{$reply->id}}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Edit Comment</h4>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form class="form-horizontal" method="POST" role="form"
                                                                              action="{{route('update.comment',$reply->id)}}">
                                                                            {{csrf_field()}}
                                                                            <div class="card-body">
                                                                                <div class="form-group row">
                                                                                    <label for="name" class="control-label">Name:</label>
                                                                                    <input type="text" class="form-control"
                                                                                           value="{{$reply->name}}"
                                                                                           id="name" name="name">
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="name" class="control-label">Email:</label>
                                                                                    <input type="text" class="form-control" id="email"
                                                                                           value="{{$reply->email}}" name="email">
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="cono1" class="control-label">Message</label>

                                                                                    <textarea class="form-control" name="comment">{{$reply->comment}}</textarea>

                                                                                </div>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div><!-- /.modal-content -->
                                                            </div><!-- /.modal-dialog -->
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>


        </div>

    </div>
@endsection




@section('script')
    <script>

        function base_url(){
            var pathparts = location.pathname.split('/');
            if(location.host == 'localhost'){
                var url = location.origin+'/'+pathparts[1].trim('/')+'/'+pathparts[2].trim('/')+'/';
            }else{s
                var url = location.origin;
            }

            return url;
        }
    </script>
@endsection
