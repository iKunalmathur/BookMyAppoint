<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $users = User::all();
    return view('Admin.user.show',compact('users'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $countries = Country::select('id','name')->get();
    return view("admin.user.create",compact('countries'));
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

      'company_name' => ['required', 'string', 'max:255'],
      'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255','unique:clients', 'unique:users'],
      'old_password' => ['required',],
      'password' => ['required',],
      'phone' => ['required'],


    ]);

    $user = new  User;


    if (Hash::check($request->old_password, Auth::user()->password)){

      // new password
      if(isset($request->password)){
        $this->validate($request,[
          'password' => 'confirmed|min:4',
        ]);
        $user->password = Hash::make($request->password);
      }

      if ($request->hasFile('image')){
        $imageName = $request->image->store('public/users_image');
        $user->image = $imageName;
      }
      $user->company_name = $request->company_name;
      $user->company_email = $request->company_email;
      $user->bio = $request->bio;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->phone = $request->phone;
      $user->address = $request->address;
      $user->city = $request->city;
      $user->state = $request->state;
      $user->country_id = $request->country;
      $user->save();

      return redirect()->back()->with('message','User created Successfully');


    }
    else{

      return redirect()->back()->with('error', 'Admin Password does not match');

    }
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
    // $user = User::find($id);
    $user = User::with('country')->find($id);
    $countries = Country::select('id','name')->get();
    return view("admin.user.edit",compact('user','countries'));
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
      'company_name' => ['required', 'string', 'max:255'],
      'company_email' => ['required', 'string', 'email', 'max:255',],
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255',],
      'old_password' => ['required',],
      'bio' => ['required',],

    ]);

    $user = User::find($id);
    // dd($request->all());

    if (Hash::check($request->old_password, Auth::user()->password)){

      // new password
      if(isset($request->password)){
        $this->validate($request,[
          'password' => 'confirmed|min:4',
        ]);
        $user->password = Hash::make($request->password);
        $request->session()->flash('success', 'Password changed');
      }

      if ($request->hasFile('image')){
        $imageName = $request->image->store('public/users_image');
        $user->image = $imageName;
      }

      if ($request->company_email == $request->email) {
          $user->company_email = $request->company_email;
      }elseif ($user->company_email !== $request->company_email) {
        $this->validate($request,[
          'company_email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:users,email', 'unique:clients,email',],
        ]);
        $user->company_email = $request->company_email;
      }else{

      }

      if ($request->email == $request->company_email) {
          $user->email = $request->email;
      }elseif ($user->email !== $request->email) {
        $this->validate($request,[
          'email' => ['required', 'string', 'email', 'max:255', 'unique:clients', 'unique:users', 'unique:users,company_email'],
        ]);
          $user->email = $request->email;
      } else {
        // code...
      }



      $user->company_name = $request->company_name;
      $user->bio = $request->bio;
      $user->name = $request->name;

      $user->phone = $request->phone;
      $user->address = $request->address;
      $user->city = $request->city;
      $user->state = $request->state;
      $user->country_id = $request->country;
      $isChanged = $user->isDirty();
      $user->save();

      if( $isChanged){
        // changes have been made
        return redirect()->back()->with('message','user details has been Updated');
      }
      return redirect()->back()->with('message2','No changes has been made');


    }
    else{

      return redirect()->back()->with('error', 'Admin Password does not match');
      // $request->session()->flash('error', ' Password does not match');

    }

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    User::find($id)->delete();
    return redirect()->back()->with('success','User Successfully Deleted');
  }
  public function activeinactivestatus(Request $request)
  {
    $user = User::findOrFail($request->user_id);

    $user->active = $request->active;
    $user->save();
    return response()->json(['message' => 'active status updated successfully.']);
  }
  public function openclosestatus(Request $request)
  {

    $user = User::findOrFail($request->user_id);
    $user->status = $request->status;
    $user->save();
    return response()->json(['message' => 'open status updated successfully.']);
  }
}
