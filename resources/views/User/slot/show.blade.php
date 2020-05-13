<!DOCTYPE html>
<html>

<head>
    @include('layouts.user.head')
</head>

<body id="page-top">
    <div id="wrapper">
        @section('SlotActive','active')
        @include('layouts.user.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
                @include('layouts.user.header')
                <div class="container-fluid">
                     <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Show Slots</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('user.slot.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create</a></div>
                </div>
                <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3" style="padding-left: 20px;">
                        {{-- @include('includes.messages') --}}
                        {{-- include notify --}}
                        @include('includes.notify') 
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
                                        <th>Slot Name</th>
                                        <th>Date&nbsp;</th>
                                        <th>Time</th>
                                        <th>Occupied</th>
                                        <th>Message</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slots as $slot)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{$slot->slot_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($slot->date)->format('F j, Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($slot->time)->format('g:i a')}}</td>
                                        <td>{{ $slot->occupied? 'yes' : 'no' }}</td>
                                         <td><textarea class="form-control" readonly>{{ $slot->message }}</textarea></td>
                                        <td style="padding-left: 6px;"><a href="{{ route('user.slot.edit',$slot->id) }}" class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a></td>
                                        <td style="padding-left: 11px;"><a onclick="if(confirm('Are you sure, You want to delete this slot ?')){
                                              event.preventDefault();
                                              document.getElementById('deleteform-{{$slot->id}}').submit();
                                            }
                                            else{
                                              event.preventDefault();
                                            }" class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a></td>
                                        <form id="deleteform-{{$slot->id}}" method="POST"  action="{{ route('user.slot.destroy',$slot->id)}}" style="display: none">
                                          @csrf
                                          @method('DELETE')
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Slot Name</th>
                                        <th>Date&nbsp;</th>
                                        <th>Time</th>
                                        <th>Occupied</th>
                                        <th>Message</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
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
    @include('layouts.user.bottom')
</body>
</html>