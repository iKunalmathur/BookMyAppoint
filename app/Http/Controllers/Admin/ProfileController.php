<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\admin\Admin;

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
        $admin = Admin::find($id);
        return view('admin.profile',compact('admin'));
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
            // 'phone' => ['required', 'numeric'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
           
        ]);

        $admin = Admin::find($id);

        // dd($request->all());

        if (Hash::check($request->old_password, $admin->password)){

            // new password
            if(isset($request->password)){
                $this->validate($request,[
                'password' => 'confirmed|min:4',
                ]);
                $admin->password = Hash::make($request->password);
                $request->session()->flash('success', 'Password changed');
            }

            if ($request->hasFile('image')){
                $imageName = $request->image->store('public/admins_image');
                $admin->image = $imageName;
            }
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->phone = $request->phone;
                $isChanged = $admin->isDirty();
                $admin->save();

                if( $isChanged){
                    // changes have been made
                    return redirect()->back()->with('message','admin details has been Updated');
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
