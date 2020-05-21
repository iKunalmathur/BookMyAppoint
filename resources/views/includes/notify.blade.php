  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
  <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'> -->
  {{-- <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'> --}}
  <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.5/bootstrap-notify.min.js'></script>
  <style>
    .mt {
      margin-top: 20px;
    }
  </style>
  <script>
    window.console = window.console || function(t) {};
  </script>
  <script>
    if (document.location.search.match(/type=embed/gi)) {
      window.parent.postMessage("resize", "*");
    }
  </script>
  <script id="rendered-js">
    @if (session()->has('message'))
    $.notify({
    // options
    title: '<strong>Success</strong>',
    message: "<br>{{ session('message') }}",
    icon: 'fas fa-check',
    target: '_blank' },
    {
    // settings
    element: 'body',
    //position: null,
    type: "success",
    //allow_dismiss: true,
    //newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutRight' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });
@endif

{{-- ------------------------------------- --}}

@if (session()->has('message2'))
$.notify({
    // options
    title: '<strong>Info</strong>',
    message: "<br>{{ session('message2') }}",
    icon: 'fas fa-info-circle' },
    {
    // settings
    element: 'body',
    position: null,
    type: "info",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated bounceInDown',
        exit: 'animated bounceOutUp' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });
@endif

{{-- ------------------------------------- --}}

@if (session()->has('success'))
$.notify({
    // options
    title: '<strong>Warning</strong>',
    message: "<br>{{ session('success') }}",
    icon: 'fas fa-exclamation-triangle' },
    {
    // settings
    element: 'body',
    position: null,
    type: "warning",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated bounceIn',
        exit: 'animated bounceOut' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });
@endif

{{-- ------------------------------------- --}}

@if (count($errors)>0)
  @foreach ($errors->all() as $error)
    $.notify({
        // options
        title: '<strong>Danger</strong>',
        message: "<br>{{ $error }}",
        icon: 'fas fa-times-circle' },
        {
        // settings
        element: 'body',
        position: null,
        type: "danger",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
          from: "top",
          align: "right" },

          offset: 20,
          spacing: 10,
          z_index: 1031,
          delay: 3300,
          timer: 1000,
          url_target: '_blank',
          mouse_over: null,
          animate: {
            enter: 'animated flipInY',
            exit: 'animated flipOutX' },

            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class' });


  @endforeach
@endif

 {{-- ------------------------------------- --}}

@if (session()->has('error'))
      $.notify({
        // options
        title: '<strong>Danger</strong>',
        message: "<br>{{ session('error') }}",
        icon: 'fas fa-times-circle' },
        {
        // settings
        element: 'body',
        position: null,
        type: "danger",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
          from: "top",
          align: "right" },

          offset: 20,
          spacing: 10,
          z_index: 1031,
          delay: 3300,
          timer: 1000,
          url_target: '_blank',
          mouse_over: null,
          animate: {
            enter: 'animated flipInY',
            exit: 'animated flipOutX' },

            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class' });

      {{-- ------------------------------------- --}}
@endif
@if (session()->has('primary'))
$.notify({
    // options
    title: '<strong>Primary</strong>',
    message: "<br>Lorem ipsum Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum.",
    icon: 'fas fa-ruble-sign' },
    {
    // settings
    element: 'body',
    position: null,
    type: "success",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated lightSpeedIn',
        exit: 'animated lightSpeedOut' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });
@endif

{{-- ------------------------------------- --}}

@if (session()->has('default'))
$.notify({
    // options
    title: '<strong>Default</strong>',
    message: "<br>Lorem ipsum Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum.",
    icon: 'fas fa-check-circle' },
    {
    // settings
    element: 'body',
    position: null,
    type: "warning",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated rollIn',
        exit: 'animated rollOut' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });

{{-- ------------------------------------- --}}
@endif
@if (session()->has('link'))
$.notify({
    // options
    title: '<strong>Link</strong>',
    message: "<br>Lorem ipsum Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum.",
    icon: 'glyphicon glyphicon-search' },
    {
    // settings
    element: 'body',
    position: null,
    type: "danger",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
      from: "top",
      align: "right" },

      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 3300,
      timer: 1000,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated zoomInDown',
        exit: 'animated zoomOutUp' },

        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class' });
@endif

{{-- ------------------------------------- --}}
      </script>
