<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Country;
use App\Model\State;
use App\Model\City;

class MapController extends Controller
{
    public function getStates()
    {
    	$country_id = $_GET['country_id'];
    	$states = State::select('id','name')->where('country_id',$country_id)->get();
        return response()->json(json_encode($states));
    }

    public function getCities()
    {
    	$state_id = $_GET['state_id'];
    	$cities = City::select('id','name')->where('state_id',$state_id)->get();
        return response()->json(json_encode($cities));
    }
}
