<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
            </div>
        </form>
        <ul class="nav navbar-nav flex-nowrap ml-auto">
            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto navbar-search w-100">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1" style="
            padding: 20px;
            " role="presentation">
            <div class="custom-control custom-switch">
                <input class="custom-control-input" type="checkbox" name="status" data-id="{{ Auth::user()->id }}" id="formCheck-1" {{ Auth::user()->status == 1 ? 'checked' : '' }} />
                    @if(Auth::user()->status == 1)
                    <style>
                        .statusclr{
                            color: green;
                        }
                    </style>
                    @else
                   <style>
                        .statusclr{
                            color: red;
                        }
                    </style>
                    @endif
                <label class="custom-control-label statusclr" for="formCheck-1" id="lblName"></label>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                  var status = ({{Auth::user()->status}} == 1) ? 'open' :'close';
                  $('#lblName').text(status);
                  $('#formCheck-1').change(function () {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let userId = $(this).data('id');
                    $('#lblName').text("open").css('color', 'green');

                    if (!$(this).is(':checked')) {
                        r = confirm("Are you sure you want to close ?");
                        if (r == true) {
                            $('#lblName').text("close").css('color', 'red');
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: '{{ route('user.opnclsstatus') }}',
                                data: {'status': status, 'user_id': userId},
                                success: function (data) {
                                    console.log(data.message);
                                }
                            });
                        } else {
                            $('#formCheck-1').prop("checked", true);
                            $('#lblName').text("open").css('color', 'green');
                        }
                        return false;
                    }
                    else{
                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('user.opnclsstatus') }}',
                            data: {'status': status, 'user_id': userId},
                            success: function (data) {
                                console.log(data.message);
                            }
                        });
                    }
                });
              });
          </script>
      </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow" role="presentation">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ Auth::user()->name }}</span><img class="border rounded-circle img-profile" src="{{asset(Storage::disk('local')->url(Auth::user()->image))}}"></a>
                    <div
                    class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="{{ route('client.profile.index') }}"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                    <a
                    class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 " style="color:red"></i>&nbsp;Logout</a></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
