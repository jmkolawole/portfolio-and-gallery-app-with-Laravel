@if(Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>Success:</strong>{{Session::get('success')}}
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