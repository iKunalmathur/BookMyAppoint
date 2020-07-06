<!DOCTYPE html>
<html>

<head>
  @include('layouts.user.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('dashboardActive','active')
    @include('layouts.user.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.user.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Dashboard</h3></div>
            <div class="row" style="width: auto;">
              <div class="col-8">
                <div class="card mb-3">
                  <div class="card-body text-left shadow">
                    <div class="row">
                      <div class="col-auto"><img class="rounded-circle mb-3 mt-4" src="{{asset(Storage::disk('local')->url(Auth::user()->image))}}" width="160" height="160" /></div>
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group"><strong>Company Name:</strong><h4>{{Auth::user()->company_name}}</h4></div>
                          </div>
                          <div class="col">
                            <div class="form-group"><strong>Company Email:</strong><h4>{{Auth::user()->company_email}}</h4></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group"><strong>Name:</strong><h4>{{Auth::user()->name}}</h4></div>
                          </div>
                          <div class="col">
                            <div class="form-group"><strong>Email:</strong><h4>{{Auth::user()->email}}</h4></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group"><strong>Phone:</strong><h4>{{Auth::user()->phone}}</h4></div>
                          </div>
                          <div class="col">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Appointment Slots</h6>
                  </div>
                  <div class="card-body">
                    <h4 class="small font-weight-bold">Totel Slot<span class="float-right">100%</span></h4>
                    <div class="progress progress-sm mb-3">
                      <div class="progress-bar bg-primary" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Occupied<span class="float-right">{{ $stats[0]['slotstats']  }}%</span></h4>
                    <div class="progress progress-sm mb-3">
                      <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['slotstats']  }}%;"><span class="sr-only">{{ $stats[0]['slotstats']  }}%</span></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold m-0">Appointments</h6>
                  </div>
                  <div class="card-body">
                    <h4 class="small font-weight-bold">Totel Appointment<span class="float-right">100%</span></h4>
                    <div class="progress progress-sm mb-3">
                      <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Pending<span class="float-right">{{ $stats[0]['penappostats']  }}%</span></h4>
                    <div class="progress progress-sm mb-3">
                      <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['penappostats']  }}%;"><span class="sr-only">{{ $stats[0]['penappostats']  }}%</span></div>
                    </div>
                    <h4 class="small font-weight-bold">Compleated<span class="float-right">{{ $stats[0]['compappostats']  }}%</span></h4>
                    <div class="progress progress-sm mb-3">
                      <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['compappostats']  }}%;"><span class="sr-only">{{ $stats[0]['compappostats']  }}%</span></div>
                    </div>
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
