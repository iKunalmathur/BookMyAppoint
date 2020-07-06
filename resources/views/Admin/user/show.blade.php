<!DOCTYPE html>
<html>

<head>
  @include('layouts.admin.head')
</head>

<body id="page-top">
  <div id="wrapper">
    @section('usersActive','active')
    @include('layouts.admin.sidebar')
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        {{-- header --}}
        @include('layouts.admin.header')
        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">User's Data</h3>
            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{!! route('admin.users.create') !!}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create</a>
          </div>
          <div class="card shadow">
            <div class="card-header py-3" style="padding-left: 20px;">
              <p class="text-primary m-0 font-weight-bold">Show</p>
              {{-- include notify --}}
              @include('includes.notify')
            </div>
            <div class="card-body">
              <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                  <thead>
                    <tr>
                      <th>S.no.</th>
                      <th style="width: auto;">Company name</th>
                      <th>Name</th>
                      <th>Email address</th>
                      <th>Contact</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td><img class="rounded-circle mr-2" width="30" height="30" src="{{asset(Storage::disk('local')->url($user->image))}}">{{ $user->company_name }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
                        <td style="padding-left: 6px;">
                          <a class="btn btn-warning btn-circle ml-1" role="button" href="{!! route('admin.users.edit',$user->id) !!}" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i>
                          </a>
                        </td>
                        <td style="padding-left: 11px;"><a onclick="if(confirm('Are you sure, You want to delete this user ?')){
                          event.preventDefault();
                          document.getElementById('deleteform-{{$user->id}}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a></td>
                        <form id="deleteform-{{$user->id}}" method="POST"  action="{{ route('admin.users.destroy',$user->id)}}" style="display: none">
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
      @include('layouts.admin.bottom')
      <script>
      $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
      });
      </script>
    </body>
    </html>
