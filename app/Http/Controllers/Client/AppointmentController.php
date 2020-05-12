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
        $appointments = Appointment::with('user:id,company_name','appointment_slot:id,date,time,date_time','service:id,service_name')->where([
            ['client_id', '=', Auth::user()->id],])->whereHas('appointment_slot', function($q){
                $q->where('date','>=', Carbon::today());
            // })->get()->sortBy('appointment_slot.time')->sortBydesc('appointment_slot.date');
            })->get()->sortBy('appointment_slot.date_time');
            // ->sortBy('appointment_slot.date')
            return  view('client.appointment.show',compact('appointments'));

        // ])->whereDate('created_at', Carbon::today())->get();
        // dd($appointments);
        // dd($appointments);
        // foreach ($appointments as $appointment) {

        //     dd($appointment->getRelations());

        // }
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
        $users = User::all();
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
            'slot_id' => ['required',],
            'service_id'=> ['required',],
            'phone' => ['required'],
        ]);
        // $tokken_no = rand();
        $tokken_no = "ATN".rand(100000,999999);
        // dd($tokken_no);
        

        $appointment = new Appointment;
        $appointment->tokken_no = $tokken_no;
        $appointment->user_id = $request->user_id;
        $appointment->appointment_slot_id = $request->slot_id;
        $appointment->client_id = Auth::user()->id;
        $appointment->service_id = $request->service_id;
        $appointment->client_name = $request->name;
        $appointment->status = 'pending';
        $appointment->save();
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
        $appointment = Appointment::find($id);
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

        $appointment = Appointment::find($id);
        // $appointment->tokken_no = $tokken_no;
        $appointment->user_id = $request->user_id;
        $appointment->appointment_slot_id = $request->slot_id;
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
        Appointment::where('id',$id)->delete();
        return redirect()->back()->with('success','Slot Successfully Deleted');
    }

    public function getslots()
    {
        $user_id = $_GET['user_id'];
        $slots = Appointment_slot::where('user_id',$user_id)->orderBy('date', 'ASC')->orderBy('time', 'ASC')->get();
        return response()->json(json_encode($slots));
    }
    public function getservices()
    {
        $user_id = $_GET['user_id'];
        $service = Service::where('user_id',$user_id)->get();
        return response()->json(json_encode($service));
    }
}
