@extends('back_end.layouts.master')
@section('page','Edit post')
@section('title','Edit Post: '.$post->title)

@section('breadcrumb')
    {{ Breadcrumbs::render('edit.post', $post) }}
@endsection


@section('content')


    <form class="form" action="{{route('edit.post',$post->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <h3 class="card-header">{{$post->title}}</h3>
                    <div class="card-body">

                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Title</b></label>
                            <input class="form-control" id="title" name="title" type="text" value="{{$post->title}}">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Category</b></label>
                            <select class="form-control" id="input-select" name="category_id">
                                <option>Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $post->category_id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags" class="control-label"><b>Tags (Choose Tags)</b></label>
                            <select class="form-control select2-multi" name="tags[]" multiple="multiple" id="tag-id">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}"
                                            @if($post->tags->contains($tag->id)) selected @endif>{{$tag->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label class="control-label"><b>Body</b></label>
                            <textarea class="form-control" rows="10" placeholder="Enter your address" id="body" name="body">{{$post->body}}
                            </textarea>
                        </div>



                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="exampleInputFile"><b>Feature Image</b></label>
                                    <input class="form-control-file" id="image" type="file" aria-describedby="fileHelp" name="image">
                                    <small class="form-text text-muted" id="fileHelp">Choose A Feature Image For This Post</small>
                                </div>
                            </div>

                            <style>
                                img{
                                    max-height: 11.5em!important;
                                }
                                .author,.author-hide, .keywords,.keywords-hide,.description,.description-hide{
                                    display: none;
                                }
                            </style>
                            <div class="col-md-3">
                                <img id="preview" class="img img-responsive img-thumbnail" style="width: 220px!important; height: 229px!important;"
                                     src="{{asset('images/backend_images/posts/medium/'.$post->image)}}" alt="your image"/>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer"><button class="btn btn-primary" type="submit">Update</button></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6>FEATURED IMAGE</h6>
                        <hr>
                        <div class="center" style="text-align: center;">
                            <img src="{{asset('images/backend_images/posts/large/'.$post->image)}}" class="img img-responsive img-fluid img-thumbnail">
                        </div>

                        <br>
                        <h6>PUBLISHER / AUTHOR</h6>
                        <hr>

                        @if($post->author == "")
                            <?php
                            $user = \App\User::where('id',$post->user_id)->first();
                            ?>
                            <a href="">{{$user->name}}</a>
                        @elseif(($post->author != ""))

                            <a href="">{{$post->author}}</a>
                        @endif

                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="author-link" id="authors-link">Add Author Here</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="author-hide" id="authors-hide">Hide Textbox</a></small>
                        <div class="form-group">
                            <input type="text" name="author" id="authors" class="form-control author" @if($post->author == "")placeholder="Author Name"
                                   @elseif($post->author != "")value="{{$post->author}}" @endif>
                        </div>

                        <br>
                        <br>
                        <h6>SEO</h6>
                        <hr>
s
                        <label><b>Keywords</b></label>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-link" id="keywords-link">Click Here To Edit</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-hide" id="keywords-hide">Hide Textbox</a></small>
                        <div class="form-group">

                            <input type="text" name="keywords" id="keywords" class="form-control keywords" value="{{$post->keywords}}">
                        </div>

                        <label><b>Description</b></label>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="description-link" id="description-link">Click Here To Edit</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="description-hide" id="description-hide">Hide Text Area</a></small>
                        <div class="form-group">
                            <textarea class="form-control description" name="description" id="description" rows="4">{{$post->description}}</textarea>
                        </div>

                        <br>
                        <br>
                        <h6>PUBLISH</h6>
                        <hr>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="publish" @if($post->publish == 0)checked="checked" @endif value="draft"
                                   class="custom-control-input"><span class="custom-control-label">Saved As Draft</span>
                        </label>

                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="publish" @if($post->publish == 1)checked="checked" @endif class="custom-control-input" value="publish"><span class="custom-control-label">Publish</span>
                        </label>


                        <br>
                        <br>
                        <h6>TAGS</h6>
                        <hr>
                        <div class="input-group mb-3">
                            <input type="text" id="name" class="form-control" placeholder="Tag Name" style="height: 41px!important;">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="checkTag();">Add <i class="fa fa-check-circle"></i></button>
                            </div>
                        </div>

                        <br>
                        <br>
                        <h6>COMMENTS</h6>
                        <hr>
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" name="comment" class="custom-control-input" @if($post->comment == 1)checked="checked"@endif><span class="custom-control-label">Enable Comments</span>
                        </label>



                    </div>
                </div>
            </div>


        </div>
    </form>
@endsection

@section('script')

    <script type="text/javascript" src="{{asset('js/tinymce/tinymce.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('vendor/select2/js/select2.min.js')}}"></script>

    <script>
        tinymce.init({
            selector: '#body',
            height: 480,
            relative_urls : false,
            remove_script_host: false,
            convert_urls  : true,
            plugins: 'image code textcolor colorpicker lists advlist autolink lists charmap print preview hr anchor pagebreak' +
                'spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking' +
                'table emoticons template paste help',
            toolbar: 'undo redo | link image | code | styleselect | bold italic | alignleft aligncenter alignright alignjustify|' +
                ' bullist numlist outdent indent table| forecolor backcolor emoticons | print preview media fullpage',
            // enable title field in the Image dialog
            image_title: true,
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // add custom filepicker only to Image dialog
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();

                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        // call the callback and populate the Title field with the file name
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    </script>



    <script type="text/javascript">
        $('.select2-multi').select2();
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script>

        $(document).ready(function(){

            //authors
            $("#authors-link").on("click",function(){
                $("#authors").show();
                $("#authors-link").hide();
                $("#authors-hide").show();
            })
            $("#authors-hide").on("click",function(){
                $("#authors").hide();
                $("#authors-hide").hide();
                $("#authors-link").show();
            });

            //Keywords
            $("#keywords-link").on("click",function(){
                $("#keywords").show();
                $("#keywords-link").hide();
                $("#keywords-hide").show();
            })
            $("#keywords-hide").on("click",function(){
                $("#keywords").hide();
                $("#keywords-hide").hide();
                $("#keywords-link").show();
            });

            //Description
            $("#description-link").on("click",function(){
                $("#description").show();
                $("#description-link").hide();
                $("#description-hide").show();
            })
            $("#description-hide").on("click",function(){
                $("#description").hide();
                $("#description-hide").hide();
                $("#description-link").show();
            });

            //Tag Add

            });


    </script>
    <script>
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        function checkTag(){
            var name = $('#name').val();

            $.ajax({
                type:'POST',
                url:'{{route('check.tag')}}',
                data:{name:name},
                success:function(resp){
                    if(resp == "exists"){
                        alert('Whoops: This Tag Exists Already');
                    }else {
                        $('#tag-id').append($('<option>', { value : resp.id })
                            .text(resp.name));
                        alert('Tag Added Successfully');

                    }
                },error:function(){

                    alert('Error');

                }
            });
        }
    </script>
@endsection
