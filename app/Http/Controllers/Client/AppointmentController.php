<?php

namespace App\Http\Controllers\Client;


use Carbon\Carbon;
use App\Model\user\User;
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
    $appointments = Appointment::with('user','appointment_slot','service:id,service_name')->where('client_id', '=', Auth::user()->id)->get()->sortBy('appointment_slot.date_time');
    // $appointments = Appointment::with('user:id,company_name','appointment_slot:id,date','service:id,service_name')->where('client_id', '=', Auth::user()->id)->get();
    // ['client_id', '=', Auth::user()->id],])->whereHas('appointment_slot', function($q){
    // $q->where('date','>=', Carbon::today());
    // })->get()->sortBy('appointment_slot.time')->sortBydesc('appointment_slot.date');
    // })->get()->sortBy('appointment_slot.date_time');
    // foreach ($appointments as $appointment) {
    //
    //     dd($appointment->getRelations());
    //
    // }
    // ->sortBy('appointment_slot.date')
    return  view('client.appointment.show',compact('appointments'));

    // ])->whereDate('created_at', Carbon::today())->get();
    // dd($appointments);
    // dd($appointments);
    // dd($appointments->getRelation());
    // $mytime = \Carbon\Carbon::now();
    // $temp = $mytime->toDateTimeString();
    // $temp = Carbon::today()->toDateTimeString();
    // dd($temp);

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

    return  view('client.appointment.create',compact('users','slots'));
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
      'slot_id' => ['required','unique:appointments,appointment_slot_id'],
      'service_id'=> ['required',],
      'phone' => ['required'],
    ]);
    // $tokken_no = rand();
    $tokken_no = "ATN".rand(100000,999999);
    // dd($tokken_no);
    $appointment = new Appointment;
    $appointment->tokken_no = $tokken_no;
    $appointment->user_id = $request->user_id;
    //////////////////////////////////
    if (!User::select('status')->findOrFail($request->user_id)->status) {
      return redirect()->back()->with('error', 'Sorry Store Closed');
    }
    // dd("STOP");
    //////////////////////////////////
    // $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);
    // $appointment_slot->occupied = 0;
    // $appointment_slot->save();
    //////////////////////////////////
    $appointment->appointment_slot_id = $request->slot_id;
    //////////////////////////////////
    // $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    // $appointment_slot->occupied = 1;
    // $appointment_slot->save();
    //////////////////////////////////
    $appointment->client_id = Auth::user()->id;
    $appointment->service_id = $request->service_id;
    $appointment->client_name = $request->name;
    $appointment->status = 0;
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment->save();
    $appointment_slot->save();
    // dd($appointment_slot->occupied);
    return redirect()->route('client.appointment.index')->with('message','Appointment Successfully Created');

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
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
    $appointment = Appointment::with('client')->where('status',0)->findorFail($id);
    // dd($appointment->getRelations());
    return  view('client.appointment.edit',compact('users','slots','appointment'));
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
    // $tokken_no = rand();
    // $tokken_no = "ATN".rand(100000,999999);
    // dd($tokken_no);
    // dd($tokken_no);
    // dd($request->all());

    $appointment = Appointment::where('status',0)->findorFail($id);
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);
    if ($appointment->appointment_slot_id != $request->slot_id) {
      $this->validate($request,[
      'slot_id' => ['required','unique:appointments,appointment_slot_id'],
        ]);
    }
    // $appointment->tokken_no = $tokken_no;
    $appointment->user_id = $request->user_id;
    //////////////////////////////////
    $appointment_slot->occupied = 0;
    $appointment_slot->save();
    //////////////////////////////////
    $appointment->appointment_slot_id = $request->slot_id;
    //////////////////////////////////
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
    $appointment_slot->occupied = 1;
    $appointment_slot->save();
    //////////////////////////////////
    // $appointment->client_id = Auth::user()->id;
    $appointment->service_id = $request->service_id;
    $appointment->client_name = $request->name;
    // $appointment->status = 'pending';
    $isChanged = $appointment->isDirty();
    $appointment->save();
    if( $isChanged){
      // changes have been made
      return redirect()->route('client.appointment.index')->with('message','Appointment details has been Updated');
    }
    return redirect()->route('client.appointment.index')->with('message2','No changes has been made');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $appointment = Appointment::select('id','appointment_slot_id')->where('status',0)->findorFail($id);
    // dd($appointment->appointment_slot_id);
    $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);
    // dd($appointment_slot->occupied);
    $appointment_slot->occupied = 0;
    $appointment_slot->save();
    $appointment->delete();
    return redirect()->back()->with('success','Appointment Successfully Deleted');
  }

  public function getslots()
  {
    $user_id = $_GET['user_id'];
    $slots = Appointment_slot::where('user_id',$user_id)->where('date','>=', Carbon::today())->orderBy('date', 'ASC')->orderBy('time', 'ASC')->get();
    return response()->json(json_encode($slots));
  }
  public function getservices()
  {
    $user_id = $_GET['user_id'];
    $service = Service::where('user_id',$user_id)->get();
    return response()->json(json_encode($service));
  }
}
