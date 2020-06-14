@extends('back_end.layouts.master')
@section('page','Create post')
@section('title','New Post')

@section('breadcrumb')
    {{ Breadcrumbs::render('create.post') }}
@endsection



@section('content')
    <form class="form" action="{{route('create.post')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <h3 class="card-header">Create A New Post</h3>
                    <div class="card-body">


                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Title</b></label>
                            <input class="form-control" id="title" name="title" type="text" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="exampleInputAmount"><b>Category</b></label>
                            <select class="form-control" id="input-select" name="category_id">
                                <option>Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags" class="control-label"><b>Tags (Choose Tags)</b></label>
                            <select class="form-control select2-multi" name="tags[]" multiple="multiple" id="tag-id">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><b>Body</b></label>
                            <textarea class="form-control" id="body" rows="10" placeholder="Enter Post Body Here" name="body"></textarea>
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
                                     src="{{asset('images/placeholder.jpg')}}" alt="your image"/>

                            </div>

                        </div>
                    </div>
                    <div class="card-footer"><button class="btn btn-primary" type="submit">Create</button></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6>PUBLISHER / AUTHOR</h6>
                        <hr>

                        <a href="">{{Auth::user()->name}}</a>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="author-link" id="authors-link">Add Author Here</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="author-hide" id="authors-hide">Hide Textbox</a></small>

                        <div class="form-group">
                            <input type="text" name="author" id="authors" class="form-control author" placeholder="Author Name">
                        </div>

                        <br>
                        <br>
                        <h6>SEO</h6>
                        <hr>

                        <label><b>Keywords</b></label>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-link" id="keywords-link">Click Here To Add</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="keywords-hide" id="keywords-hide">Hide Textbox</a></small>
                        <div class="form-group">

                            <input type="text" name="keywords" id="keywords" class="form-control keywords" placeholder="Add Keywords">
                        </div>

                        <label><b>Description</b></label>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="description-link" id="description-link">Click Here To Add</a></small>
                        <small class="list-group-item-text" style="float: right!important;"><a href="javascript:void(0)" class="description-hide" id="description-hide">Hide Text Area</a></small>
                        <div class="form-group">
                        <textarea class="form-control description" name="description" id="description" rows="4">

                        </textarea>
                        </div>

                        <br>
                        <br>
                        <h6>PUBLISH</h6>
                        <hr>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="publish" checked="checked" value="draft" class="custom-control-input"><span class="custom-control-label">Save As Draft</span>
                        </label>

                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="publish" class="custom-control-input" value="publish"><span class="custom-control-label">Publish</span>
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
                            <input type="checkbox" name="comment" class="custom-control-input"><span class="custom-control-label">Enable Comments</span>
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
            plugins: 'image code textcolor colorpicker lists advlist autolink lists charmap print preview hr anchor pagebreak' +
                'spellchecker searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking' +
                'table emoticons template paste help',
            toolbar: 'undo redo | link image | code | styleselect | bold italic | alignleft aligncenter alignright alignjustify|' +
                ' bullist numlist outdent indent | forecolor backcolor emoticons | print preview media fullpage',
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


            /*    $('.summernote').summernote({

                });
                */

            $("img").addClass("img-responsive");
            $("img").css("max-width", "100%");

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



            /*
            $('#tag-butto').on('click',function(){
                var name = $('#name').val();
                $.ajax({

                    type:'POST',

                    url:'new-tag',

                    data:{name:name},

                    success:function(data){
                        $.notify({
                            title: "Success : ",
                            message: "Tag Added Successfully",
                            icon: 'fa fa-check'
                        },{
                            type: "info"
                        });

                        $('#tag-id')
                                .append($('<option>', { value : data.id })
                                        .text(data.name));
                    }
                });




            });

            */

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



