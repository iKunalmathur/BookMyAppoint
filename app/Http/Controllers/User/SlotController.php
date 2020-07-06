<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
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
    $slots = Appointment_slot::where('user_id',Auth::user()->id)->orderBy('date_time','ASC')->get();
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
    $this->validate($request,[
      'slotname' => ['required', 'string', 'max:255'],
      'date' => ['required'],
      'time' => ['required'],

    ]);


    $Slot = new Appointment_slot;

    $Slot->user_id = Auth::user()->id;
    $Slot->slot_name = $request->slotname;
    $Slot->date = $request->date;
    $Slot->time = $request->time;
    $Slot->message = $request->message;
    $Slot->date_time = "$request->date $request->time";
    if (Appointment_slot::where('date_time','=',$Slot->date_time.":00")->exists()) {
      return redirect()->route('user.slot.index')->with('success','Slot Already Exists');
    }else {
      $Slot->save();
      return redirect()->route('user.slot.index')->with('message','Slot Successfully Created');
    }
    return redirect()->route('user.slot.index')->with('message','Something went Wrong :(');


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


    $Slot = Appointment_slot::find($id);

    $Slot->user_id = Auth::user()->id;
    $Slot->slot_name = $request->slotname;
    $Slot->date = $request->date;
    $Slot->time = $request->time;
    $Slot->message = $request->message;
    $Slot->date_time = "$request->date $request->time";
    $isChanged = $Slot->isDirty();
    if (Appointment_slot::where('user_id','=',Auth::user()->id)->where('date_time','=',$Slot->date_time.":00")->exists()) {
          return redirect()->route('user.slot.index')->with('success','Slot Already Exists');
    }else {
      $Slot->save();
      if( $isChanged){
        // changes have been made
        return redirect()->route('user.slot.index')->with('message','Slot details has been Updated');
      }
      return redirect()->route('user.slot.index')->with('message2','No changes has been made');
    }
    return redirect()->route('user.slot.index')->with('message','Something went Wrong :(');

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
  $val =  Appointment_slot::where('id',$id)->where('occupied',0)->delete();

   return ($val) ? redirect()->back()->with('message','Slot Successfully Deleted'):redirect()->back()->with('error','Failed');

  }
}
