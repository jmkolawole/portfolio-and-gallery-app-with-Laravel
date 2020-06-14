@extends('back_end.layouts.master')

@section('title','Add Album Photo')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="basicform">
                <h3 class="section-title">{{$album->name}}</h3>
                <p>Add photo</p>
            </div>
            <div class="card">
                <h5 class="card-header">Album details</h5>
                <div class="card-body">
                    <form action="{{route('photo.add',$album->id)}}" method="POST" class="dropzone" id="my-awesome-dropzone"
                          enctype="multipart/form-data">
                        {{csrf_field()}}

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

<?php $id = $album->id;?>
@section('script')

    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            //Dropzone class
            var myDropzone = new Dropzone(".dropzone");
            myDropzone.on("queuecomplete", function() {
                var id = '<?php echo $id?>';
                //Redirect URL
                setTimeout(function () {
                    window.location.replace('/mohvisuals/public/admin/album/' + id)
                }, 1000);
            });
        });
    </script>
@endsection