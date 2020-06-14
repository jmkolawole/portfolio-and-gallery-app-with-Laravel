@extends('front_end.layouts.master')
@section('title', 'Contact Us | Moh Visual')
@section('description', 'Moh Visual: Contact Us For Enquiries And Bookings')
@section('keywords', 'Moh Visual', 'Photography, Nice Pictures')
@section('og_title','Contact Us | Moh Visual')
@section('og_url',url('/contact'))
@section('og_description','Moh Visual: Contact Us For Enquiries And Bookings')
<?php
$image = \App\Banner::where('id',1)->first();
?>
@section('og_image',asset('images/backend_images/banners/'.$image->image))

@section('content')
    <div class="wrapper light-wrapper"><div class="container inner pt-70">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h2 class="section-title text-center section-head">Get in Touch</h2>

                    <div class="space20"></div>
                    <div class="row text-center">
                        <!--/column -->
                        <div class="col-md-6"> <span class="icon icon-color color-default fs-48 mb-10"><i class="si-phone_phone-ringing"></i></span>
                            <p>+234 706 855 1286<br> +234 808 238 1939 </p>
                        </div>


                        <!--/column -->
                        <div class="col-md-6"> <span class="icon icon-color color-default fs-48 mb-10"><i class="si-mail_mail-2"></i></span>
                            <p><a class="nocolor" href="mailto:#">support@mohvisualstudios.com</a><br>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                    <div class="space30"></div>
                    <div class="form-container">
                        <form action="{{route('contact')}}" method="post">
                            {{csrf_field()}}
                            <div class="row text-center">
                                <div class="col-md-6 pr-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Your name" required="required">
                                    </div>
                                    <!--/.form-group -->
                                </div>
                                <!--/column -->
                                <div class="col-md-6 pl-10">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your e-mail" required="required">
                                    </div>
                                    <!--/.form-group -->
                                </div>
                                <!--/column -->
                                <div class="col-md-6 pr-10">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="phone" placeholder="Phone">
                                    </div>
                                    <!--/.form-group -->
                                </div>
                                <!--/column -->
                                <div class="col-md-6 pl-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                                    </div>
                                    <!--/.form-group -->
                                </div>
                                <!--/column -->
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="3" placeholder="Type your message here..." required></textarea>
                                    <div class="space20"></div>
                                    <button type="submit" class="btn" data-error="Fix errors" data-processing="Sending..." data-success="Thank you!">Submit</button>
                                    <footer class="notification-box"></footer>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </form>
                        <!--/.vanilla-form -->
                    </div>
                    <!--/.form-container -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>

@endsection