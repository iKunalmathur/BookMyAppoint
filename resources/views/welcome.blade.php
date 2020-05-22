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
          @if ($users)
            @foreach($users as $user)
              <div class="col-sm-6 col-md-4 item"><a href="#"><img class="img-fluid" width="300" height="300" src="{{asset(Storage::disk('local')->url($user->image))}}"></a>
                <h3 class="name">{{$user->company_name}}</h3>
                <p class="description">{{$user->bio}}</p>
                @if($user->status)
                  <a class="action" href="{{ Route('bookappointment.show',$user->id) }}">
                    <p style="color: #007aa5;">Book Appointment&nbsp;<i class="fas fa-handshake"></i></p>
                  </a>
                @else
                  <a class="action">
                    <p style="color:red;">Closed&nbsp;<i class="fas fa-store-alt-slash"></i></p>
                  </a>
                @endif

              </div>
            @endforeach
          @endif
        </div>
      </div>
    @endsection
