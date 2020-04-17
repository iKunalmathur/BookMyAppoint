@extends('layouts.main')
@section('title', 'BookMyAppoint.')
@section('main-content')   
<div class="highlight-phone">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="intro">
                    <h1>Welcome To BookMyAppoint.</h1>
                    <p>Here you can book appointment&nbsp; with your own choice of service provider.</p><a class="btn btn-primary" role="button" href="#article-list" style="background-color: #0072c6;">Get Started</a></div>
                </div>
                <div class="col-sm-4">
                    <div class="d-none d-md-block iphone-mockup"><img class="device" src="{{asset('assets/img/chooose-doctor.jpg')}}" style="opacity: 1;"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="article-list" class="article-list">
        <div class="container">
            <div class="row articles">
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="{{asset('assets/img/desk.jpg')}}"></a>
                    <h3 class="name">Company name</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p>
                    <a class="action" href="#">
                        <p style="color: #007aa5;">Book Appointment&nbsp;<i class="fa fa-arrow-circle-right"></i></p>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="{{asset('assets/img/building.jpg')}}"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a></div>
                    <div
                    class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" src="{{asset('assets/img/loft.jpg')}}"></a>
                    <h3 class="name">Article Title</h3>
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, interdum justo suscipit id.</p><a class="action" href="#"><i class="fa fa-arrow-circle-right"></i></a></div>
                </div>
            </div>
        </div>
@endsection
