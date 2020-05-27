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
    $slotper = round(($Ocupappointment_slot / $Totelappointment_slot )*100);
    // echo $slotper;
    // dd($slotper);
    $Totelappointment = Appointment::select('id')->where('user_id',Auth::id())->get()->count();
    // dd($Totelappointment);
    $InProappointment = Appointment::select('id')->where('user_id',Auth::id())->where('status',1)->get()->count();
    $compappostats = round(($InProappointment / $Totelappointment )*100);
    $penappostats = round((($Totelappointment - $InProappointment) / $Totelappointment )*100);

    $stats[]= [
      'totelslot' => $Totelappointment_slot,
      'slotstats' => $slotper,
      'totelappostats' => $Totelappointment,
      'compappostats' => $compappostats,
      'penappostats' => $penappostats,
    ];
    // dd($stats);
    return view('User.home',compact('stats'));
  }
}
