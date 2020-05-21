<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\User;
class welcomeController extends Controller
{
    public function index()
    {
    	$users = User::select('id','company_name','bio','status','image')->where('active',1)->get();
    	// dd($users);
    	return view('welcome',compact('users'));
    }
}
