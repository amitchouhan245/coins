<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ User, Ride, TaxiRequest };
use Mail, Route;
use App\Events\TaxiRequestEvent;
use App\Mail\NewUser;
use App\Http\Requests\Api\RideRequest;
use App\Http\Controllers\Api\Taxi\RideController;

class CronController extends Controller
{
    public function laterRideRequest(Request $request){

    	$where = array('ride_type' => '2','status' => '1');

    	$now = strtotime(date('Y-m-d H:i'));
			
		$oneHour = date("Y-m-d H:i", strtotime("+1 hour", $now));
		
    	$rides = Ride::where($where)
    				->whereNotNull('ride_date_time')    				
    				->whereDate('ride_date_time', $oneHour)
    				->get();    	

    	//if (count($rides) > 0) {
        if (false) {
    		
    		$rideObj = new RideController();

	    	foreach ($rides as $key => $value) {	    			    		
	    		
	    		$obj = new RideRequest();

	    		$obj->ride_id = $value->id;
	    		$obj->pickup_lat = $value->pickup_lat;
	    		$obj->pickup_long = $value->pickup_long;

    		    $rideObj->findDriver($obj);		        

	    	}
    	}

    	/*Mail::to("gawande.pankajkumar@gmail.com")
         ->send(new NewUser(User::first()));*/
    	
    }
}


