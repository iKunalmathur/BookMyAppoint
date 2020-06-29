<nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color: rgb(238,244,247);">
  <div class="container"><a class="navbar-brand pulse animated" href="{{ route('index') }}">BookMyAppoint.</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
    <div
    class="collapse navbar-collapse" id="navcol-1">
    <ul class="nav navbar-nav mr-auto">
      <li class="nav-item" role="presentation"></li>
      <li class="nav-item" role="presentation"></li>
      {{-- <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Dropdown </a> --}}
      {{-- <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div> --}}
    </li>
  </ul>
  @auth('client')
    <span class="navbar-text actions">
      <a class="btn btn-primary action-button" role="button" href="{{ route('client.home') }}" style="background-color: #0072c6;">Home</a>
    </span>
    @else
      <span class="navbar-text actions">
        <a class="login" href="{{ route('client.login') }}">Log In</a>
        <a class="btn btn-primary action-button" role="button" href="{{ route('client.register') }}" style="background-color: #0072c6;">Sign Up</a>
      </span>
  @endauth
</div>
</div>
</nav>
