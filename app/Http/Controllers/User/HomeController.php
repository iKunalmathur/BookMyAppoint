<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\Appointment_slot;
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

    $this->middleware('auth:user');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Contracts\Support\Renderable
  */
  public function index()
  {
    $Totelappointment_slot = Appointment_slot::select('id','occupied')->where('user_id',Auth::id())->get()->count();
    $Ocupappointment_slot = Appointment_slot::select('id','occupied')->where('user_id',Auth::id())->where('occupied',1)->get()->count();
    $slotper = 0;
    if ($Totelappointment_slot > 0) {
      $slotper = round(($Ocupappointment_slot / $Totelappointment_slot )*100);
    }

    $Totelappointment = Appointment::select('id')->where('user_id',Auth::id())->get()->count();

    $InProappointment = Appointment::select('id')->where('user_id',Auth::id())->where('status',1)->get()->count();

    if ($Totelappointment > 0) {
      $compappostats = round(($InProappointment / $Totelappointment )*100); //compleate appointments
      $penappostats = round((($Totelappointment - $InProappointment) / $Totelappointment )*100);// pending appointments
    }else {
      $compappostats = 0;
      $penappostats = 0;
    }


    $stats[]= [
      'totelslot' => $Totelappointment_slot,
      'slotstats' => $slotper,
      'totelappostats' => $Totelappointment,
      'compappostats' => $compappostats,
      'penappostats' => $penappostats,
    ];

    return view('User.home',compact('stats'));
  }
}
