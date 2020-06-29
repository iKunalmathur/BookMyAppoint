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
                        <h3 class="text-dark mb-0">Edit Slot</h3>{{-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> --}}</div>
                {{-- @include('includes.messages') --}}
                {{-- include notify --}}
                @include('includes.notify')
                </div>
            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Edit Slot info</p>
                    </div>
                    <div class="card-body">
                        <form role="form" action="{{ route('user.slot.update',$slot->id) }}" method="POST">
                       @csrf
                       @method('PUT')
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="username"><strong>Slot name</strong></label><input class="form-control" type="text" value="{{$slot->slot_name}}" name="slotname"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Date</strong><br></label><input class="form-control" value="{{$slot->date}}" name="date" id="Date" type="date"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><label for="first_name"><strong>Timing</strong></label><input class="form-control" value="{{$slot->time}}" name="time" type="time"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><label for="last_name"><strong>Message</strong></label><input class="form-control" type="text" value="{{$slot->message}}" name="message"></div>
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
    <script type="text/javascript">
        $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var minDate= year + '-' + month + '-' + day;

            $('#Date').attr('min', minDate);
        });
    </script>
</body>
</html>
