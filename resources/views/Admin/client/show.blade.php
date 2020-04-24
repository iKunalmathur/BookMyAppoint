<!DOCTYPE html>
<html>

<head>
    @include('layouts.admin.head')
</head>

<body id="page-top">
    <div id="wrapper">
        @section('clientsActive','active')
        @include('layouts.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
            @include('layouts.admin.header')
            <div class="container-fluid">
                 <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Client's Data</h3>
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                </div>
                               <div class="card shadow">
                    <div class="card-header py-3" style="padding-left: 20px;">
                        <p class="text-primary m-0 font-weight-bold">Show</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email address</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($clients as $client)  
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td><img class="rounded-circle mr-2" width="30" height="30" src="{{asset(Storage::disk('local')->url($client->image))}}"></td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td><textarea class="form-control" readonly>{{$client->address}}, {{ $client->getRelation('country')->name }}</textarea></td>
                                        <td style="padding-left: 6px;"><a class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a></td>
                                        <td style="padding-left: 11px;"><a class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a></td>
                                    </tr>
                                   @endforeach 
                                    <tr></tr>
                                    <tr></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>S.no.</strong></td>
                                        <td><strong></strong></td>
                                        <td><strong>Name</strong></td>
                                        <td><strong>Email address</strong></td>
                                        <td><strong>Contact</strong></td>
                                        <td><strong>Address</strong></td>
                                        <td><strong>Edit</strong></td>
                                        <td><strong>Delete</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                            </div>
                            <div class="col-md-6">
                                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination">
                                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    </ul>
                                </nav>
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
    @include('layouts.admin.bottom')
    <script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
    });
    </script>

</body>

</html>