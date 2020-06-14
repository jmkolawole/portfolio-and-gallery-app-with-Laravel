<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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

    <title>Login</title>
</head>

<body>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><a class="navbar-brand" href="{{route('home')}}">Moh Visuals</a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{route('login.page')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <input class="form-control form-control-lg" id="email" type="email" placeholder="Email" autocomplete="off" name="email">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{route('link.request')}}" class="footer-link">Forgot Password? click here</a>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
@include('back_end.partials._javascript')
</body>

</html>