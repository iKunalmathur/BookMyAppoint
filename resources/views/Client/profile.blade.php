
<!DOCTYPE html>
<html>

<head>
    @include('layouts.client.head')
    <style type="text/css">
        input[type="file"] {
    display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @section('profileActive','active')
        @include('layouts.client.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
            @include('layouts.client.header')
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
            <form role="form" action="{{ route('client.profile.update',$client->id) }}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{asset(Storage::disk('local')->url(Auth::user()->image))}}" width="160" height="160">
                                <label for="file-upload" class="custom-file-upload">
                                    <i class="fas fa-upload"></i> Upload image
                                </label>
                                <input id="file-upload" name="image" type="file"/>
                                {{-- <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div> --}}
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Appointments&nbsp;</h6>
                            </div>
                            <div class="card-body">
                                <h4 class="small font-weight-bold">Pending<span class="float-right">20%</span></h4>
                                <div class="progress progress-sm mb-3">
                                    <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
                                </div>
                                <h4 class="small font-weight-bold">In Process<span class="float-right">40%</span></h4>
                                <div class="progress progress-sm mb-3">
                                    <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                                </div>
                                <h4 class="small font-weight-bold">Compleated<span class="float-right">Complete!</span></h4>
                                <div class="progress progress-sm mb-3">
                                    <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        {{-- <div class="row mb-3 d-none">
                            <div class="col">
                                <div class="card text-white bg-primary shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-success shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">
                                        
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="companyname"><strong>Name</strong></label><input class="form-control" value="{{$client->name}}"  type="text" placeholder="name" name="name"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" value="{{$client->email}}"  type="email" placeholder="user@example.com" name="email"></div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="first_name"><strong>Contact no.</strong></label><input class="form-control" value="{{$client->phone}}" type="text" placeholder="phone" name="phone"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="last_name"><strong>Old Password</strong></label><input class="form-control"  type="text" placeholder="**********" name="old_password"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                        
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Contact Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" type="text" value="{{$client->phone}}"  name="address"></div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group"><label for="city"><strong>City</strong></label><input class="form-control" type="text" placeholder="Los Angeles" name="city"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group"><label for="country"><strong>Country</strong></label><input class="form-control" type="text" placeholder="USA" name="country"></div>
                                                </div>
                                            </div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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