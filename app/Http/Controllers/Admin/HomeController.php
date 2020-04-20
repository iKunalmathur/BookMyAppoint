<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\client\Client;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usercount = User::all()->count();
        $clientcount = Client::all()->count();
        return view('Admin.home',compact('usercount','clientcount'));
    }
}
