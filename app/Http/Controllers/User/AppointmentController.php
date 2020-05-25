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
        // $appointments = Appointment::with('user:id,company_name','appointment_slot:id,date,time','service:id,service_name')->where('client_id',Auth::user()->id)->get();
//         $appointments = Appointment::with('client:id,name,phone','appointment_slot:id,date,time,date_time','service:id,service_name')->where('user_id',Auth::user()->id)->whereHas('appointment_slot', function($q){
//     $q->where('date','>=', Carbon::today());
// })->get()->sortBy('appointment_slot.date_time');
$appointments = Appointment::with('client:id,name,phone','appointment_slot:id,date,time,date_time','service:id,service_name')->where('user_id',Auth::user()->id)->get()->sortBy('appointment_slot.date_time');
        // dd($appointments);
        // dd($appointments);
        // foreach ($appointments as $appointment) {

        //     dd($appointment->getRelations());

        // }
        // dd($appointments->getRelation());
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
        // $tokken_no = rand();
        $tokken_no = "ATN".rand(100000,999999);

        // dd($tokken_no);
        // dd($request->all());

        $client = Client::select('id')->where('email',$request->email)->first();
        // dd($client);
        if($client == null){
            return redirect()->route('user.appointment.create')->with('message2','Customer not found, Check your email address');
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
        $appointment = Appointment::with('client')->findorFail($id);
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
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            // 'user_id' => ['required',],
            'slot_id' => ['required','unique:appointments,appointment_slot_id'],
            'service_id'=> ['required',],
            // 'phone' => ['required'],
        ]);
        // $tokken_no = "ATN".rand(100000,999999);
        // dd($tokken_no);
        // dd($request->all());

        $appointment = Appointment::find($id);
        // $appointment->tokken_no = $tokken_no;
        // $appointment->user_id = $request->user_id;
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
        // $appointment->client_id = Auth::user()->id;
        $appointment->service_id = $request->service_id;
        // $appointment->client_name = $request->name;
        // $appointment->status = 'pending';
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
        //
    }
    public function changestatus($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status =  ($appointment->status) ? 0 : 1 ;
        $appointment->save();
        return redirect()->back()->with('message','Appointment Status Changed');
    }
}
