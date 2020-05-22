<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\user\User;
use App\Model\client\Client; 
use App\Model\user\Service;
use App\Model\client\Appointment;
use App\Model\user\Appointment_slot;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $appointments = Appointment::with('client','user','appointment_slot','service:id,service_name')->get()->sortBy('appointment_slot.date_time');
    // foreach ($appointments as $appointment) {
    //
    //     dd($appointment->getRelations());
    //
    // }
    return  view('admin.appointment.show',compact('appointments'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $users = User::select('id','company_name','status')->where('active',1)->get();
    $slots = Appointment_slot::all();
    return  view('admin.appointment.create',compact('users','slots'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // dd($request->all());
    $this->validate($request,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'user_id' => ['required',],
        'slot_id' => ['required',],
        'service_id'=> ['required',],
        'phone' => ['required'],
    ]);
    // $tokken_no = rand();
    $tokken_no = "ATN".rand(100000,999999);
    // dd($tokken_no);
    $client = Client::select('id')->where('email',$request->email)->first();
    // dd($client);
    if($client == null){
        return redirect()->route('admin.appointment.create')->with('message2','Customer not found, Check your email address');
    }

    $appointment = new Appointment;
    $appointment->tokken_no = $tokken_no;
    $appointment->user_id = $request->user_id;
    //////////////////////////////////
    $appointment->appointment_slot_id = $request->slot_id;
    //////////////////////////////////
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment_slot->save();
      //////////////////////////////////
    $appointment->client_id = $client->id;
    $appointment->service_id = $request->service_id;
    $appointment->client_name = $request->name;
    $appointment->status = 'pending';
    $appointment_slot = Appointment_slot::select('id','occupied')->find($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment_slot->save();
    $appointment->save();
    // dd($appointment_slot->occupied);
    return redirect()->route('admin.appointment.index')->with('message','Appointment Successfully Created');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $users = User::all();
    $slots = Appointment_slot::all();
    $appointment = Appointment::with('client')->findorFail($id);
    // dd($appointment->getRelations());
    return  view('admin.appointment.edit',compact('users','slots','appointment'));
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
        'user_id' => ['required',],
        'slot_id' => ['required',],
        'service_id'=> ['required',],
        'phone' => ['required'],
    ]);

    $appointment = Appointment::find($id);
    $appointment->user_id = $request->user_id;
    //////////////////////////////////
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);
    $appointment_slot->occupied = 0;
    $appointment_slot->save();
    //////////////////////////////////
    $appointment->appointment_slot_id = $request->slot_id;
    //////////////////////////////////
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment_slot->save();
    ////////////////////////////////
    $appointment->service_id = $request->service_id;
    $appointment->client_name = $request->name;
    $isChanged = $appointment->isDirty();
    $appointment->save();
    if( $isChanged){
                // changes have been made
                return redirect()->route('admin.appointment.index')->with('message','Appointment details has been Updated');
            }
            return redirect()->route('admin.appointment.index')->with('message2','No changes has been made');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $appointment = Appointment::select('id','appointment_slot_id')->findOrFail($id);
    $appointment_slot = Appointment_slot::select('id','occupied')->find($appointment->appointment_slot_id);
    $appointment_slot->occupied = 0;
    $appointment_slot->save();
    $appointment->delete();
    return redirect()->back()->with('success','Slot Successfully Deleted');
  }
  public function getslots()
  {
      $user_id = $_GET['user_id'];
      $slots = Appointment_slot::where('user_id',$user_id)->where('occupied',0)->where('date','>=', Carbon::today())->orderBy('date', 'ASC')->orderBy('time', 'ASC')->get();
      return response()->json(json_encode($slots));
  }
  public function getservices()
  {
      $user_id = $_GET['user_id'];
      $service = Service::where('user_id',$user_id)->get();
      return response()->json(json_encode($service));
  }
}
