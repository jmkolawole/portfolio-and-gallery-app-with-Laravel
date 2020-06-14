
@if(Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Success:</strong>{{Session::get('success')}}
    </div>

@endif

@if(Session::has('failure'))

    <div class="alert alert-danger" role="alert">
        <strong>Failure:</strong>{{Session::get('failure')}}
    </div>

@endif


@if(count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Errors:</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

















<script>
    $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove();
            });
        }, 5000);
    });
</script>