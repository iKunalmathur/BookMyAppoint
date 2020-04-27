<!DOCTYPE html>
<html>

<head>
    <title>BookMyAppoint-login</title>
    @include('layouts.head')
</head>

<body style="background-color: #343a40;color: rgb(52,58,64);/*ppadding-bottom: 70px;*/">
    <div class="bg-dark login-clean" style="height: 635px;color: rgb(52,58,64);">
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h2 class="sr-only">Login Form</h2>
            {{-- @include('includes.messages') --}}
            <div class="illustration"><img src="{{ asset('assets/img/icons/admin333333-96.png') }}" style="color: #0072c6;"></img></div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <br>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: #333333;">Log In</button></div>
    </div>
    @include('layouts.bottom')
</body>

</html>