@extends('layouts.main')
@section('title', 'BookMyAppoint.')
@section('main-content')

  </style>
  <div class="container" style="margin-top: 50px;">
    {{-- include notify --}}
    @include('includes.notify')
    <div class="row">
      <div class="col-auto" style="padding-left: 12px;padding-right: 12px;"><img class="img-thumbnail" src="{{asset(Storage::disk('local')->url($sp->image))}}" width="300px" height="300px" style="min-width: 300px;width: 320px;" /></div>
      <div class="col">
        <h1><strong>{{$sp->company_name}}</strong><br /></h1>
        <h2>{{$sp->company_email}}</h2>
        <div class="row">
          <div class="col-auto">
            <p style="margin-bottom: 0;">{{$sp->phone}}</p>
          </div>
          <div class="col-auto align-self-center"><i data-toggle="tooltip" data-placement="bottom" class="fa fa-user" title="Owner/Manager"></i></div>
          <div class="col align-self-center" style="padding: 0px;">
            <h6 class="text-left" style="margin-bottom: 0;">{{$sp->name}}</h6>
          </div>
        </div>
        <p>{{$sp->address}}<br/></p>
        <p>{{$sp->bio}}<br/></p>
      </div>
    </div>
    <hr>
    <form method="POST" action="{{ route('bookappointment.update',$sp->id) }}" id="appform">
      @csrf
      @method('PUT')

      <div class="form-row">
        <div class="col">
          <div class="form-group"><label for="name"><strong>Name</strong></label><input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" /></div>
        </div>
        <div class="col">
          <div class="form-group"><label for="email"><strong>Email</strong></label><input type="text" class="form-control" name="email" value="{{Auth::user()->email}}"/></div>
        </div>
      </div>
      <div class="form-row">
        <div class="col">
          <div class="form-group"><label for="slot">
            <strong>Slot</strong>
            <br />
          </label>
          <select class="form-control" name="slot_id"  id="slot_id" required="required">
            <option value="" disabled selected>select</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="services">
            <strong>Services</strong>
          </label>
          <select class="form-control" name="service_id" id="service_id"  required="required">
            <option value="" disabled selected>select</option>
          </select></div>
        </div>
      </div>
      {{-- <input type="submit" value="submit" name="submit"> --}}
      <a class="btn btn-primary btn-icon-split" href="javascript:$('#appform').submit();" role="button"><span class="text-white-50 icon"><i class="fas fa-hands-helping"></i></span><span class="text-white text"> Book</span>
      </a>
    </form>
  </div>
  <br>
  <br>
@endsection
@section('bottom')
  <script type="text/javascript">
  $(document).ready(function() {
    var id = {{$sp->id}};
    console.log(id);
    $("#slot_id").find('option').remove();
    $("#service_id").find('option').remove();
    if (id) {
      $.ajax({
        type: "GET",
        url: '{{ route('client.getslots')}}' ,
        data:  ({user_id : id}),
        success: function(msg)
        {
          $('#slot_id').prop("disabled",false);
          $("#loding2").hide();
          var response = JSON.parse(msg);
          var state_name="";
          if(response.length>0)
          {

            for(i=0;i<response.length;i++)
            {
              slots = ""+response[i]['slot_name'];
              slotsdates = response[i]['date'];
              const d = new Date(slotsdates)
              const dtf = new Intl.DateTimeFormat('en', { year: 'numeric', month: 'short', day: '2-digit' })
              const [{ value: mo },,{ value: da },,{ value: ye }] = dtf.formatToParts(d)
              dateString = `${da}-${mo}-${ye}`

              ///////// Time AM/PM ///////////
              var timeString = response[i]['time'];
              var H = +timeString.substr(0, 2);
              var h = H % 12 || 12;
              var ampm = (H < 12 || H === 24) ? "am" : "pm";
              timeString = h + timeString.substr(2, 3)+" "+ ampm;
              document.getElementById("slot_id").options[i] =  new Option(slots+", "+dateString+", "+timeString,response[i]['id']);
              if(response[i]['occupied'] == 1){
                    document.getElementById("slot_id").options[i].setAttribute('disabled',true);
                  }else {
                    document.getElementById("slot_id").options[i];
                  }
            }

            document.getElementById('slot_id').focus();

          }


        },
    error: function(e)
    {
      alert("Country Invalid : " + e.responseText.message);
      console.log(e);
    }
  });
  $.ajax({
    type: "GET",
    url: '{{ route('client.getservices')}}' ,
    data:  ({user_id : id}),
    success: function(msg)
    {
      $('#service_id').prop("disabled",false);
      $("#loding2").hide();
      var response = JSON.parse(msg);
      var state_name="";
      if(response.length>0)
      {

        for(i=0;i<response.length;i++)
        {
          service = response[i]['service_name'];
          document.getElementById("service_id").options[i] =  new Option(service,response[i]['id']);
        }

        document.getElementById('slot_id').focus();

      }


    },
error: function(e)
{
  alert("Country Invalid : " + e.responseText.message);
  console.log(e);
}
});
}

else{
  $("#loding2").hide();
  $('#slot_id').prop("disabled",true);
}
});
</script>
@endsection
