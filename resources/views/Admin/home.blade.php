<!DOCTYPE html>
<html>

<head>
  @include('layouts.admin.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('dashboardActive','active')
    @include('layouts.admin.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.admin.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Admin Dashboard</h3>
          </div>
          <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
              <div class="card shadow border-left-primary py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Service provider</span></div>
                      <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $stats[0]['usercount'] }}</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
              <div class="card shadow border-left-success py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Clients/Customer</span></div>
                      <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $stats[0]['clientcount'] }}</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
              <div class="card shadow border-left-warning py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Total Appointments</span></div>
                      <div class="text-dark font-weight-bold h5 mb-0"><span>{{ $stats[0]['appointmentcount'] }}</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
              <div class="card shadow border-left-info py-2">
                <div class="card-body">
                  <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                      <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Tasks</span></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span>80%</span></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm">
                            <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Stats</h6>
            </div>
            <div class="card-body">
              <h4 class="small font-weight-bold">Total Slots<span class="float-right">{{ $stats[0]['appointmentslotcount'] }}</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                  <span class="sr-only">100%</span></div>
                </div>
                <h4 class="small font-weight-bold">Occupied Slots<span class="float-right">{{ $stats[0]['occupiedSlotPerc'] }}%</span></h4>
                <div class="progress mb-4">
                  <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['occupiedSlotPerc'] }}%;"><span class="sr-only">{{ $stats[0]['occupiedSlotPerc'] }}%</span></div>
                </div>
                <h4 class="small font-weight-bold">Pending Appointments<span class="float-right">{{ $stats[0]['penappointments'] }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['penappointments'] }}%;"><span class="sr-only">{{ $stats[0]['penappointments'] }}%</span></div>
                </div>
                <h4 class="small font-weight-bold">Completed Appointments<span class="float-right">{{ $stats[0]['comappointments'] }}%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {{ $stats[0]['comappointments'] }}%;"><span class="sr-only">{{ $stats[0]['comappointments'] }}%</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">

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
    @include('layouts.admin.bottom')
  </body>

  </html>
