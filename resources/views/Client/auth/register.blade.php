<!DOCTYPE html>
<html style="line-height: 0;">

<head>
    <title>BookMyAppoint-Register</title>
    @include('layouts.head')
</head>

<body class="d-flex flex-column" style="background-color: #343a40;">
    <div class="register-photo" style="background-color: #343a40;">
        <div class="form-container">
            <div class="image-holder" style="background: url({{ asset('assets/img/HEAD-.png') }});"></div>
            <form method="POST" action="{{ route('client.register') }}">
                @csrf
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"placeholder="Password" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="form-group">
                   <input id="password-confirm" type="password" class="form-control" placeholder="Password (repeat)" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" required type="checkbox">I agree to the license terms.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: #0072c6;">Sign Up</button></div><a class="already" href="{{ route('client.login') }}">You already have an account? Login here.</a></form>
        </div>
    </div>
    @include('layouts.bottom')
</body>

</html>