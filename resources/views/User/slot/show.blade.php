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
                <div class="row">
                  <div class="col">
                    <p class="text-primary m-0 font-weight-bold">Appointment slots List</p>
                  </div>
                  <div class="col"><button class="btn  float-right" type="button" data-toggle="modal" data-target="#myModal" style="background-color: #f8f9fc;"><i class="fa fa-history" style="color: #4285f4;"></i></button></div>
                </div>
                <!-- Modal -->
              <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Previous Appointment Slots</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="row text-center">
                        <div class="col-1">
                          <p>S.no.</p>
                        </div>
                        <div class="col-2">
                          <p>Slot Name</p>
                        </div>
                        <div class="col-2">
                          <p>Date&nbsp;</p>
                        </div>
                        <div class="col-2">
                          <p>Time</p>
                        </div>
                        <div class="col-2">
                          <p>Occupied</p>
                        </div>
                        <div class="col-2">
                          <p>Message</p>
                        </div>
                      </div>
                      @foreach($slots as $slot)
                        @if ($slot->date <  date('Y-m-d') )
                      <div class="row text-center">
                        <div class="col-1">
                          <p>{{ $loop->index +1 }}</p>
                        </div>
                        <div class="col-2">
                          <p>{{$slot->slot_name}}</p>
                        </div>
                        <div class="col-2">
                          <p>{{ \Carbon\Carbon::parse($slot->date)->format('F j, Y')}}</p>
                        </div>
                        <div class="col-2">
                          <p>{{ \Carbon\Carbon::parse($slot->time)->format('g:i a')}}</p>
                        </div>
                        <div class="col-2">
                          <p>{{ $slot->occupied? 'yes' : 'no' }}</p>
                        </div>
                        <div class="col-2">
                          <p>{{ $slot->message }}</p>
                        </div>
                      </div>
                    @endif
                    @endforeach
                    </div>
                  </div>

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
                        <th class="text-center">S.no.</th>
                        <th class="text-center">Slot Name</th>
                        <th class="text-center">Date&nbsp;</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Occupied</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($slots as $slot)
                        @if ($slot->date >=  date('Y-m-d') )
                        <tr>
                          <td class="text-center">{{ $loop->index +1 }}</td>
                          <td class="text-center">{{$slot->slot_name}}</td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($slot->date)->format('F j, Y')}} </td>
                          <td class="text-center">{{ \Carbon\Carbon::parse($slot->time)->format('g:i a')}}</td>
                          <td class="text-center">{{ $slot->occupied? 'yes' : 'no' }}</td>
                          <td class="text-center"><textarea class="form-control" readonly>{{ $slot->message }}</textarea></td>
                          <td class="text-center" style="padding-left: 6px;"><a href="{{ route('user.slot.edit',$slot->id) }}" class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a></td>
                          <td class="text-center" style="padding-left: 11px;"><a onclick="if(confirm('Are you sure, You want to delete this slot ?')){
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
                      @endif
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
