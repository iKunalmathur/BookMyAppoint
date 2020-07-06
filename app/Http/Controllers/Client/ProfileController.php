<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\client\Client;
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
        $client = Client::find($id);
        $countries = Country::select('id','name')->get();
        $states = State::select('id','name')->get();
        $cities = City::select('id','name')->get();
        return view('client.profile',compact('client','countries','states','cities'));
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
            'old_password' => ['required',]

        ]);

        $client = Client::find($id);

        if (Hash::check($request->old_password, $client->password)){

            // new password
            if(isset($request->password)){
                $this->validate($request,[
                'password' => 'confirmed|min:4',
                ]);
                $client->password = Hash::make($request->password);
                $request->session()->flash('success', 'Password changed');
            }

            if ($request->hasFile('image')){
                $imageName = $request->image->store('public/clients_image');
                $client->image = $imageName;
            }
                $client->name = $request->name;
                $client->email = $request->email;
                $client->phone = $request->phone;
                $client->address = $request->address;
                $client->city = $request->city;
                $client->state = $request->state;
                $client->country_id = $request->country;
                $isChanged = $client->isDirty();
                $client->save();

                if( $isChanged){
                    // changes have been made
                    return redirect()->back()->with('message','Client details has been Updated');
                }
                return redirect()->back()->with('message2','No changes has been made');


            }
            else{

                return redirect()->back()->with('error', 'Password does not match');

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
