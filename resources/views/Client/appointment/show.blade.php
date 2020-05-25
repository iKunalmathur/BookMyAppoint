<!DOCTYPE html>
<html>

<head>
  @include('layouts.client.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('appointmentActive','active')
    @include('layouts.client.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.client.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Show app</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{{ route('client.appointment.create') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create</a></div>
          </div>
          <div class="col">
            <div class="card shadow">
              <div class="card-header py-3" style="padding-left: 20px;">
                <div class="row">
                  <div class="col">
                    <p class="text-primary m-0 font-weight-bold">Appointment List</p>
                  </div>
                  <div class="col"><button class="btn  float-right" type="button" data-toggle="modal" data-target="#myModal" style="background-color: #f8f9fc;"><i class="fa fa-history" style="color: #4285f4;"></i></button></div>
                </div>
                {{-- @include('includes.messages') --}}
                @include('includes.notify')
              </div>
              <!-- Modal -->
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Previous Appointments</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-1">
                          <p class="text-center">S.no.</p>
                        </div>
                        <div class="col-2">
                          <p class="text-center">Tokken no</p>
                        </div>
                        <div class="col-3">
                          <p class="text-center">Service provider</p>
                        </div>
                        <div class="col-2">
                          <p class="text-center">Service</p>
                        </div>
                        <div class="col-2">
                          <p class="text-center">Date</p>
                        </div>
                        <div class="col-2">
                          <p class="text-center">Time</p>
                        </div>
                      </div>
                      @foreach($appointments as $appointment)
                        @if ($appointment->getRelation('appointment_slot')->date < date('Y-m-d'))
                          <div class="row">
                            <div class="col-1">
                              <p class="text-center">{{ $loop->index +1 }}</p>
                            </div>
                            <div class="col-2">
                              <p class="text-center">{{$appointment->tokken_no}}</p>
                            </div>
                            <div class="col-3">
                              <p class="text-center">{{$appointment->getRelation('user')->company_name}}</p>
                            </div>
                            <div class="col-2">
                              <p class="text-center">{{$appointment->getRelation('service')->service_name}}</p>
                            </div>
                            <div class="col-2">
                              <p class="text-center">{{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->date)->format('F j, Y')}}</p>
                            </div>
                            <hr>
                            <div class="col-2">
                              <p class="text-center">{{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->time)->format('g:i a')}}</p>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                    {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div> --}}
                </div>

              </div>
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
                      <th class="text-center">S.no.</th>
                      <th class="text-center">Tokken no</th>
                      <th class="text-center">Service provider</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Time</th>
                      <th class="text-center">Edit</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($appointments as $appointment)
                      @if ($appointment->getRelation('appointment_slot')->date >=  date('Y-m-d'))
                        @php  $i = 0 @endphp
                        @foreach ($appointments as $compare)
                          @if ($compare->getRelation('appointment_slot')->date_time == $appointment->getRelation('appointment_slot')->date_time)
                            @php $i++  @endphp
                          @endif
                        @endforeach
                        <tr @if ($appointment->status)
                          {{-- style="background-color: #8BC34A;color: #3a3b45;" --}}
                        @endif>
                        <td class="text-center">{{ $loop->index +1 }}</td>
                        <td class="text-center"><p>{{$appointment->tokken_no}}<p></td>
                          <td class="text-center">{{$appointment->getRelation('user')->company_name}}</td>
                          <td class="text-center">{{$appointment->getRelation('service')->service_name}}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->date)->format('F j, Y')}}
                            @if ($i == 2)
                              <hr style="border-top-color: red;">
                            @endif
                          </td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($appointment->getRelation('appointment_slot')->time)->format('g:i a')}}
                            @if ($i == 2)
                              <hr style="border-top-color: red;">
                            @endif
                          </td>
                          {{-- <td class="text-center">{{ $appointment->occupied? 'yes' : 'no' }}</td> --}}
                          {{-- <td class="text-center"><textarea class="form-control" readonly>{{ $appointment->message }}</textarea></td> --}}
                          @if (!$appointment->status)
                            <td class="text-center" style="padding-left: 6px;">
                              <a href="{{ route('client.appointment.edit',$appointment->id) }}" class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a>
                              {{-- @endif --}}
                              <td class="text-center" style="padding-left: 11px;">
                                {{-- @if ($appointment->status !== 'completed') --}}
                                <a onclick="if(confirm('Are you sure, You want to delete this appointment ?')){
                                  event.preventDefault();
                                  document.getElementById('deleteform-{{$appointment->id}}').submit();
                                }
                                else{
                                  event.preventDefault();
                                }" class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a>
                              </td>
                              @else
                                <td class="text-right" style="padding-right: 0px;color: #0f9d58;"><strong>Do</strong></td>
                                <td class="text-left" style="padding-left: 0px;color: #0f9d58;"><strong>ne</strong></td>
                            @endif
                              <form id="deleteform-{{$appointment->id}}" method="POST"  action="{{ route('client.appointment.destroy',$appointment->id)}}" style="display: none">
                                @csrf
                                @method('DELETE')
                              </form>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th class="text-center">S.no.</th>
                          <th class="text-center">Tokken no</th>
                          <th class="text-center">Service provider</th>
                          <th class="text-center">Service</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Time</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
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
