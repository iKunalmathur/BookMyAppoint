  
@if (count($errors)>0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong><i class="fas fa-exclamation-circle"></i></strong>&nbsp;&nbsp;&nbsp;{{ $error }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
    @endforeach
@endif
{{--  --}}
@if (session()->has('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong><i class="far fa-check-circle"></i></strong>&nbsp;&nbsp;&nbsp;{{ session('error') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif
{{--  --}}
@if (session()->has('success'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
	  <strong><i class="far fa-check-circle"></i></strong>&nbsp;&nbsp;&nbsp;{{ session('success') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif
{{--  --}}
@if (session()->has('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong><i class="far fa-check-circle"></i></strong>&nbsp;&nbsp;&nbsp;{{ session('message') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif
{{--  --}}
@if (session()->has('message2'))
	<div class="alert alert-info alert-dismissible fade show" role="alert">
	  <strong><i class="fa fa-info-circle"></i></strong>&nbsp;&nbsp;&nbsp;{{ session('message2') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif