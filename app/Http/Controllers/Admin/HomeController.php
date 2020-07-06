<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\user\Appointment_slot;
use App\Model\client\Client;
use App\Model\client\Appointment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usercount = User::all()->count();
        $clientcount = Client::all()->count();
        $appointmentcount = Appointment::all()->count();
        $Penappointmentcount = Appointment::where('status',0)->get()->count();
        $Totelappointment_slot = Appointment_slot::select('id','occupied')->get()->count();
        $Occupappointment_slot = Appointment_slot::select('id','occupied')->where('occupied',1)->get()->count();
        $OccupiedSlotPerc = round(($Occupappointment_slot / $Totelappointment_slot )*100);
        $Penappointments = round(($Penappointmentcount / $appointmentcount )*100);
        $Comappointments = round((($appointmentcount-$Penappointmentcount) / $appointmentcount )*100);
        $stats[]= [
          'usercount' => $usercount,
          'clientcount' => $clientcount,
          'appointmentcount' => $appointmentcount,
          'appointmentslotcount' => $Totelappointment_slot,
          'occupiedSlotPerc' => $OccupiedSlotPerc,
          'penappointments' => $Penappointments,
          'comappointments' => $Comappointments,
        ];
        return view('Admin.home',compact('stats',));
    }
}
