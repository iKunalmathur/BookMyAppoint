<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\client\Appointment;
use App\Model\user\Appointment_slot;
use Illuminate\Support\Facades\Auth;

class bookappointController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {


  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

    $sp = User::where('status',1)->where('active',1)->findOrFail($id);
    return view('bookappointment',compact('sp'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {

    $this->validate($request,[
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'slot_id' => ['required','unique:appointments,appointment_slot_id'],
      'service_id'=> ['required',],

    ]);
    $tokken_no = "ATN".rand(100000,999999);


    $appointment = new Appointment;
    $appointment->tokken_no = $tokken_no;
    $appointment->user_id = $id;

    if (!User::select('status')->findOrFail($id)->status) {
      return redirect()->back()->with('error', 'Sorry Store Closed');
    }


    $appointment->appointment_slot_id = $request->slot_id;
    $appointment->client_id = Auth::user()->id;
    $appointment->service_id = $request->service_id;
    $appointment->client_name = $request->name;
    $appointment->status = 0;
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment->save();
    $appointment_slot->save();
    return redirect()->route('client.appointment.index')->with('message','Appointment Successfully Created');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
