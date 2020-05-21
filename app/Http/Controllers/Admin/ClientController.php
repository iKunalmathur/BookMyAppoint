<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\client\Client;
use App\Model\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('country')->paginate(20);
        // dd($clients);
        // dd($clients->getRelations());
        return view('Admin.client.show',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $countries = Country::select('id','name')->get();
      return view('admin.client.create',compact('countries'));
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
         'email' => ['required', 'string', 'email', 'max:255','unique:clients', 'unique:users'],
         'old_password' => ['required',],
         'phone' => ['required'],
         // 'password' => ['required', 'string', 'min:8', 'confirmed'],

     ]);

     $client = new Client;

     // dd($request->all());

     if (Hash::check($request->old_password, Auth::user()->password)){

         // new password
         if(isset($request->password)){
             $this->validate($request,[
             'password' => 'confirmed|min:4',
             ]);
             $client->password = Hash::make($request->password);
             // $request->session()->flash('success', 'Password changed');
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
             // $isChanged = $client->isDirty();
             $client->save();

             // if( $isChanged){
             //     // changes have been made
             //     return redirect()->back()->with('message','Client details has been Updated');
             // }
             return redirect()->back()->with('message','Client created Successfully');



         }
         else{

             return redirect()->back()->with('error', 'Admin Password does not match');
             // $request->session()->flash('error', ' Password does not match');

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
      $client = Client::find($id);
      $countries = Country::select('id','name')->get();
      return view('admin.client.edit',compact('client','countries'));
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
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'old_password' => ['required',],
            'phone' => ['required'],
            // 'image' => ['required'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $client = Client::find($id);

        if ($client->email !== $request->email) {
           $this->validate($request,[
             'email' => ['required', 'string', 'email', 'max:255', 'unique:clients', 'unique:users'],
            ]);
        }
        // dd($request->all());

        if (Hash::check($request->old_password, Auth::user()->password)){

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
        Client::find($id)->delete();
        return redirect()->back()->with('success','Client Successfully Deleted');
    }
}
