<!DOCTYPE html>
<html>

<head>
    @include('layouts.admin.head')
</head>

<body id="page-top">
    <div id="wrapper">
        @section('dashboardActive','active')
        @include('layouts.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                {{-- header --}}
            @include('layouts.admin.header')
            <div class="container-fluid">
                 <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Admin Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a></div>
               
            </div>
    </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © BookMyAppoint.2020</span></div>
        </div>
    </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    @include('layouts.admin.bottom')
</body>

</html>