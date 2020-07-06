<!DOCTYPE html>
<html>

<head>
    @include('layouts.client.head')
</head>

<body id="page-top">
    <div id="wrapper">
        @section('dashboardActive','active')
        @include('layouts.client.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
                @include('layouts.client.header')
                <div class="container-fluid">
                   <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3></div>
                    <div class="row" style="width: auto;">
                        <div class="col-8">
                            <div class="card mb-3">
                                <div class="card-body text-left shadow">
                                    <div class="row">
                                        <div class="col-auto text-center"><img class="rounded-circle mb-3 mt-4" src="{{asset(Storage::disk('local')->url(Auth::user()->image))}}" width="160" height="160" /></div>
                                        <div class="col">
                                            <div class="form-group"><strong>Name:</strong><h4>{{Auth::user()->name}}</h4></div>
                                            <div class="form-group"><strong>Email:</strong><h4>{{Auth::user()->email}}</h4></div>
                                            <div class="form-group"><strong>Phone:</strong><h4>{{Auth::user()->phone}}</h4></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 float-right">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">Appointments </h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Total Appointments<span class="float-right">{{$totalAppointments}}</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-primary" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">In Process<span class="float-right">{{ $Penappointmentsper }}%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $Penappointmentsper }}%;"><span class="sr-only">{{ $Penappointmentsper }}%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Compleated<span class="float-right">{{ $Comappointmentsper }}%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {{ $Comappointmentsper }}%;"><span class="sr-only">{{ $Comappointmentsper }}%</span></div>
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
@include('layouts.client.bottom')

</body>

</html>
