<?php

namespace App\Http\Controllers\User;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\user\User;
use App\Model\Country;
use App\Model\State;
use App\Model\City;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::user()->id;
        $user = User::with('country')->find($id);
        // $user->getRelation('country');
        // dd($user);
        // dd($user->getRelations());
        // dd($user->getRelation('country')->name);
        $countries = Country::select('id','name')->get();
        // $states = State::select('id','name')->get();
        // $cities = City::select('id','name')->get();
        return view('user.profile',compact('user','countries'));
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
        //
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
            'old_password' => ['required',],
            'bio' => ['required',],
            // 'phone' => ['required', 'numeric'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
           
        ]);

        $user = User::find($id);

        // dd($request->all());

        if (Hash::check($request->old_password, $user->password)){

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
                $user->company_name = $request->company_name;
                $user->company_email = $request->company_email;
                $user->bio = $request->bio;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->city = $request->city;
                $user->state = $request->state;
                $user->country = $request->country;
                $isChanged = $user->isDirty();
                $user->save();

                if( $isChanged){
                    // changes have been made
                    return redirect()->back()->with('message','user details has been Updated');
                }
                return redirect()->back()->with('message2','No changes has been made');


            }
            else{

                return redirect()->back()->with('error', 'Password does not match');
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
        //
    }
    
}
