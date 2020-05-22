<!DOCTYPE html>
<html>

<head>
  @include('layouts.user.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('tokkendetailsActive','active')
    @include('layouts.user.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.user.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Tokken details</h3>
          </div>

            <div class="card shadow">
              <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Tokken Info</p>
              </div>
              <div class="card-body">
                <h5>Appointment Info</h5>
                <hr />
                <div class="row">
                  <div class="col" style="padding-left: 20px;">
                    <p>Name: {{ $appointment->client_name }}</p>
                    <p>Email Address: {{ $appointment->getrelation('client')->email }}</p>
                    <p>Conteact no: {{ $appointment->getrelation('client')->phone }}</p>
                    <p>Service Provider: {{ $appointment->getrelation('user')->company_name }}</p>
                    <p>Date &amp; Time: {{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->date)->format('F j, Y')}} {{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->time)->format('g:i a')}}</p>
                    <p>Service: {{$appointment->getRelation('service')->service_name}} </p>
                  </div>
                </div>
                <hr />
                <h5>Account info:</h5>
                <hr />
                <div class="row">
                  <div class="col">
                    <p>Name : {{ $appointment->getrelation('client')->name }}</p>
                    <p>Email Address: {{ $appointment->getrelation('client')->email }}</p>
                    <p>Conteact no: {{ $appointment->getrelation('client')->phone }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        <footer class="bg-white sticky-footer">
          <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © BookMyAppoint.2020</span></div>
          </div>
        </footer>
      </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
      @include('layouts.user.bottom')
    </body>

    </html>
