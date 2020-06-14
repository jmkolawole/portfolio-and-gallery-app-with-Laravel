@extends('front_end.layouts.master')
@section('title', 'About Moh Visual | mohvisual')
@section('description','Moh Visual: Take Breath-taking Pictures And Start Living In Your Dreams. Book A Date With Me')
@section('keywords', 'Moh Visual Studios, Best Photographer')
@section('og_title','About Moh Visual | mohvisual')
@section('og_url',url('/about'))
@section('og_description','Take Excellent And Breath-taking Pictures')
@section('og_image',asset('front_end/images/Moh2.jpg'))


@section('content')
    <div class="wrapper light-wrapper">
        <div class="container inner pt-60">
            <div class="boxed">
                <div class="bg-white shadow rounded">
                    <div class="image-block-wrapper">
                        <div class="image-block col-lg-6">
                            <div class="image-block-bg bg-image" data-image-src="front_end/images/Moh2.jpg"></div>
                        </div>
                        <!--/.image-block -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-6">
                                    <div class="box d-flex">
                                        <div class="align-self-center">
                                            <h3 class="mb-20">I'm here to capture your moments</h3>
                                            <p class="lead">
                                                My name is Mohammed Adedeji and photography is my passion.
                                                It's what I love to do and I do it with apt attention to my art and to my customers.
                                                I take pictures from weddings to portraits, lifestyle, fashion and arts photography without exception to families and ceremonies.

                                                There are moments we cherish, moments we love and moments we adore.
                                                The best way to relive these moments is to capture them.
                                                You can count on me to capture your perfect and cherished moments.

                                                What I think makes photography great is when I'm able to understand what you truly want and capture it.
                                                Your satisfaction and joy is my motivation.  I think and breathe what you want captured.
                                                You can check my portfolio and testimonials for references and contact me if you want to request my services.
                                                I look forward to capturing your  beautiful moments.

                                            </p>
                                            <ul class="social social-color">
                                                <li><a href="https://twitter.com/mykelpound"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="https://www.facebook.com/mykeldollar"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="https://www.instagram.com/moh_visuals/?hl=en"><i class="fa fa-instagram"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                        <!--/.container-fluid -->
                    </div>
                    <!--/.image-block-wrapper -->
                </div>
                <!-- /.bg -->
            </div>
            <!-- /.boxed -->
        </div>
        <!-- /.container -->
    </div>

    <div class="wrapper light-wrapper">
        <div class="container inner">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-20">My Skills</h4>
                    <ul class="progress-list">
                        <li>
                            <p>Photoshop</p>
                            <div class="progressbar line pastel-default" data-value="90"></div>
                        </li>
                        <li>
                            <p>Colouring</p>
                            <div class="progressbar line pastel-default" data-value="80"></div>
                        </li>
                        <li>
                            <p>Studio Photography</p>
                            <div class="progressbar line pastel-default" data-value="85"></div>
                        </li>
                    </ul>
                    <!-- /.progress-list -->
                </div>
                <!--/column -->
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </div>

@endsection


