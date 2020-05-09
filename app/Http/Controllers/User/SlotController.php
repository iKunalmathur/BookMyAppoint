<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\Appointment_slot;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        Appointment_slot::where('date',"<",\Carbon\Carbon::today())->delete();
        $slots = Appointment_slot::where('user_id',Auth::user()->id)->orderBy('date','ASC')->get();
        return view('user.slot.show',compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.slot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 24-hour time to 12-hour time 
        // $time_in_12_hour_format  = date("g:i a", strtotime($request->time));
        // 12-hour time to 24-hour time 
        // $time_in_24_hour_format  = date("H:i", strtotime($request->time));
        // echo "time_in_12_hour_format ".$time_in_12_hour_format;
        // echo "time_in_24_hour_format ".$time_in_24_hour_format;

        $this->validate($request,[
            'slotname' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
           
        ]);
        // dd($request->all());

        $Slot = new Appointment_slot;

        $Slot->user_id = Auth::user()->id;
        $Slot->slot_name = $request->slotname;
        $Slot->date = $request->date;
        $Slot->time = $request->time;
        $Slot->message = $request->message;
        $Slot->save();
        return redirect()->route('user.slot.index')->with('message','Slot Successfully Created');

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
        $slot = Appointment_slot::find($id);
        return view('user.slot.edit',compact('slot'));
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
            'slotname' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'time' => ['required'],
           
        ]);
        // dd($request->all());

        $Slot = Appointment_slot::find($id);

        $Slot->user_id = Auth::user()->id;
        $Slot->slot_name = $request->slotname;
        $Slot->date = $request->date;
        $Slot->time = $request->time;
        $Slot->message = $request->message;
        $isChanged = $Slot->isDirty();
        $Slot->save();
        if( $isChanged){
                    // changes have been made
                    return redirect()->route('user.slot.index')->with('message','Slot details has been Updated');
                }
                return redirect()->route('user.slot.index')->with('message2','No changes has been made');
        // return redirect()->route('user.slot.index')->with('success','Slot Successfully Updated');

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Appointment_slot::where('id',$id)->delete();
        return redirect()->back()->with('success','Slot Successfully Deleted');
    }
}
