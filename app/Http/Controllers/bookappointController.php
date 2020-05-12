<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\client\Appointment;
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
        $sp = User::find($id);
        // dd($sp);
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
        // dd($id);
        // dd($request->all());
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'user_id' => ['required',],
            'slot_id' => ['required',],
            'service_id'=> ['required',],
            // 'phone' => ['required'],
        ]);
        $tokken_no = rand();

        // dd($tokken_no);
        $appointment = new Appointment;
        $appointment->tokken_no = $tokken_no;
        $appointment->user_id = $id;
        $appointment->appointment_slot_id = $request->slot_id;
        $appointment->client_id = Auth::user()->id;
        $appointment->service_id = $request->service_id;
        $appointment->client_name = $request->name;
        $appointment->status = 'pending';
        $appointment->save();
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
