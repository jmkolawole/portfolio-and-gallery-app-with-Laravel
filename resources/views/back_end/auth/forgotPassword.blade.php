<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet"  href="{{ asset('css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet"  href="{{ asset('css/open-iconic-bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet"  href="{{ asset('fonts/fontawesome/css/fontawesome-all.css')}}">
    <link type="text/css" rel="stylesheet"  href="{{ asset('fonts/circular-std/style.css')}}">
    <link type="text/css" rel="stylesheet"  href="{{ asset('css/style.css')}}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
    <title>Forgot Password</title>
</head>

<body>
<!-- ============================================================== -->
<!-- forgot password  -->
<!-- ============================================================== -->
<div class="splash-container">
    <div class="card">
        <div class="card-header text-center"><a class="navbar-brand" href="{{route('home')}}">Moh Visuals</a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{route('post.link.request')}}" method="POST">
                {{csrf_field()}}
                <p>Don't worry, we'll send you an email to reset your password.</p>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="Your Email" autocomplete="off">
                </div>
                <div class="form-group pt-1"><button type="submit" class="btn btn-block btn-primary btn-xl">Reset Password</button></div>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="{{route('login.page')}}">Return to Login</a>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end forgot password  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
@include('back_end.partials._javascript')
</body>


</html>