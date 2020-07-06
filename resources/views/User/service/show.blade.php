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
                        <h3 class="text-dark mb-0">Show Service</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('user.service.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create</a></div>
                </div>
                <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3" style="padding-left: 20px;">
                      <div class="row">
                        <div class="col">
                          <p class="text-primary m-0 font-weight-bold">Services List</p>
                        </div>
                      </div>
                        {{-- include notify --}}
                        @include('includes.notify')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Service</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{$service->service_name}}</td>
                                        <td style="padding-left: 6px;"><a href="{{ route('user.service.edit',$service->id) }}" class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a></td>
                                        <td style="padding-left: 11px;"><a onclick="if(confirm('Are you sure, You want to delete this service ?')){
                                              event.preventDefault();
                                              document.getElementById('deleteform-{{$service->id}}').submit();
                                            }
                                            else{
                                              event.preventDefault();
                                            }" class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a></td>
                                        <form id="deleteform-{{$service->id}}" method="POST"  action="{{ route('user.service.destroy',$service->id)}}" style="display: none">
                                          @csrf
                                          @method('DELETE')
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
