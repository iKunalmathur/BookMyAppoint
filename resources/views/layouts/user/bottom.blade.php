<script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/chart.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="{{ asset('dashboard/assets/js/script.min.js') }}"></script>
    <script>
    $(function() {
      if( navigator.userAgent.match(/Android/i)
      || navigator.userAgent.match(/webOS/i)
      || navigator.userAgent.match(/iPhone/i)
      || navigator.userAgent.match(/iPad/i)
      || navigator.userAgent.match(/iPod/i)
      || navigator.userAgent.match(/BlackBerry/i)
      || navigator.userAgent.match(/Windows Phone/i)
    ){
      console.log("mobile");
      $("nav:first").addClass("toggled");
    }
    });
    </script>
@section('bottom')

@show
