<!DOCTYPE html>
<html lang="en">
@include('front_end.partials._head')
<body>
<div class="content-wrapper wrapper bg-pastel-default">

    @include('front_end.layouts.header')

    @include('front_end.partials._message')

    @yield('content')
    <!-- /.wrapper -->
    @include('front_end.layouts.footer')
</div>
<!-- /.content-wrapper -->
@include('front_end.partials._javascript')
</body>

</html>