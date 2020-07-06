<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Model\client\Appointment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalAppointments = Appointment::where('client_id',Auth::id())->get()->count();
        $Penappointments = Appointment::where('status',0)->where('client_id',Auth::id())->get()->count();
        $Penappointmentsper = 0;
        $Comappointmentsper = 0;
        if ($totalAppointments > 0) {
          $Penappointmentsper = round(($Penappointments / $totalAppointments )*100);
          $Comappointmentsper = round((($totalAppointments - $Penappointments) / $totalAppointments )*100);
        }
        return view('Client.home',compact('totalAppointments','Penappointmentsper','Comappointmentsper'));
    }
}
