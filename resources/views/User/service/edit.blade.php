<!DOCTYPE html>
<html>

<head>
    @include('layouts.user.head')
</head>

<body id="page-top">
    <div id="wrapper">
        @section('ServiceActive','active')
        @include('layouts.user.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
                @include('layouts.user.header')
                <div class="container-fluid">
                     <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Edit service</h3>
                      </div>
                {{-- include notify --}}
                @include('includes.notify')
                </div>
            <div class="col-5">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Edit service info</p>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('user.service.update',$service->id) }}" method="POST">
                       @csrf
                       @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="service_name"><strong>service name</strong></label><input class="form-control" type="text" value="{{$service->service_name}}" name="service_name"></div>
                                </div>
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Update</button></div>
                        </form>
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
