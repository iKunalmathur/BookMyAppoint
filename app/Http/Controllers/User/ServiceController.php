<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\user\Service;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::where('user_id',Auth::user()->id)->get();

        return view('user.service.show',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('user.service.create');
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
            'service_name' => ['required'],
        ]);



        $service = new Service;

        $service->user_id = Auth::user()->id;
        $service->service_name = $request->service_name;
        $service->save();
        return redirect()->route('user.service.index')->with('message','service Successfully Created');


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
        $service = Service::find($id);
        return view('user.service.edit',compact('service'));
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
            'service_name' => ['required'],
        ]);



        $service = Service::find($id);

        $service->user_id = Auth::user()->id;
        $service->service_name = $request->service_name;
        $isChanged = $service->isDirty();
        $service->save();
        if( $isChanged){
                    // changes have been made
                    return redirect()->route('user.service.index')->with('message','Service details has been Updated');
                }
                return redirect()->route('user.service.index')->with('message2','No changes has been made');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::where('id',$id)->delete();
        return redirect()->back()->with('success','Service Successfully Deleted');
    }
}
