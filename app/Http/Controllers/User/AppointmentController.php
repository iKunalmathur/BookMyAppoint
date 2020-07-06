<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\client\Appointment;
use App\Model\client\Client;
use Illuminate\Support\Facades\Auth;
use App\Model\user\User;
use App\Model\user\Service;
use App\Model\user\Appointment_slot;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('client:id,name,phone','appointment_slot:id,date,time,date_time','service:id,service_name')->where('user_id',Auth::user()->id)->get()->sortBy('appointment_slot.date_time');
        return  view('user.appointment.show',compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $users = User::where('id',Auth::user()->id)->get();
        $slots = Appointment_slot::all();
        return  view('user.appointment.create',compact('users','slots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_id' => ['required',],
            'slot_id' => ['required','unique:appointments,appointment_slot_id'],
            'service_id'=> ['required',],
            'phone' => ['required'],
        ]);
        $tokken_no = "ATN".rand(100000,999999);
        $client = Client::select('id')->where('email',$request->email)->first();

        if($client == null){
            return redirect()->route('user.appointment.create')->with('message2','Customer not found, Check your email address');
        }
        $appointment = new Appointment;
        $appointment->tokken_no = $tokken_no;
        $appointment->user_id = $request->user_id;

        $appointment->appointment_slot_id = $request->slot_id;

        $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
        $appointment_slot->occupied = 1;

        $appointment->client_id = $client->id;
        $appointment->service_id = $request->service_id;
        $appointment->client_name = $request->name;
        $appointment->status = 0;
        $appointment_slot = Appointment_slot::select('id','occupied')->find($request->slot_id);
        $appointment_slot->occupied = 1;
        $appointment_slot->save();
        $appointment->save();
        return redirect()->route('user.appointment.index')->with('message','Appointment Successfully Created');
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
        $users = User::where('id',Auth::user()->id)->get();
        $slots = Appointment_slot::all();
        $appointment = Appointment::with('client')->where('status',0)->findorFail($id);
        return  view('user.appointment.edit',compact('users','slots','appointment'));
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

            'slot_id' => ['required','unique:appointments,appointment_slot_id'],
            'service_id'=> ['required',],
        ]);


        $appointment = Appointment::find($id);

        $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);
        $appointment_slot->occupied = 0;
        $appointment_slot->save();

        $appointment->appointment_slot_id = $request->slot_id;

        $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($request->slot_id);
        $appointment_slot->occupied = 1;
        $appointment_slot->save();

        $appointment->service_id = $request->service_id;

        $isChanged = $appointment->isDirty();
        $appointment->save();
        if( $isChanged){
                    // changes have been made
                    return redirect()->route('user.appointment.index')->with('message','Appointment details has been Updated');
                }
                return redirect()->route('user.appointment.index')->with('message2','No changes has been made');
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

      $appointment_slot = Appointment_slot::select('id','occupied')->findOrFail($appointment->appointment_slot_id);

      $appointment_slot->occupied = 0;
      $appointment_slot->save();
      $appointment->delete();
      return redirect()->back()->with('success','Appointment Deleted');
    }
    public function changestatus($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status =  ($appointment->status) ? 0 : 1 ;
        $appointment->save();
        return redirect()->back()->with('message','Appointment Status Changed');
    }
}
