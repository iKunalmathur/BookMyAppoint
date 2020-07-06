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
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="{!! route('admin.clients.create') !!}"><i class="fas fa-plus fa-sm text-white-50"></i>&nbsp;Create</a>
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
                                    <td style="padding-left: 6px;"><a href="{!! route('admin.clients.edit',$client->id) !!}" class="btn btn-warning btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-pen text-white"></i></a></td>
                                    <td style="padding-left: 11px;"><a onclick="if(confirm('Are you sure ?')){
                                      event.preventDefault();
                                      document.getElementById('deleteform-{{$client->id}}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" class="btn btn-danger btn-circle ml-1" role="button" data-bs-hover-animate="pulse" style="width: 30px;height: 30px;"><i class="fas fa-trash text-white"></i></a></td>
                                    <form id="deleteform-{{$client->id}}" method="POST"  action="{{ route('admin.clients.destroy',$client->id)}}" style="display: none">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                </tr>
                                @endforeach
                                <tr></tr>
                                <tr></tr>
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
