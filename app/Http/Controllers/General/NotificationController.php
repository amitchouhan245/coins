<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Models\User;
use App;

class NotificationController extends Controller
{
    
    public function user($Id, $type){


        $fields = ['id','status','first_name','last_name','mobile_number'];

        $field = ['id'];

        $user = User::select($fields)->find($Id);

        switch ($type) {

            //new event
            case 'Event':              

                $title  = "New Event";
                $message = "Great ! You are near by a new event";
                $userArray = array($user->id);
                $type = "NEW_EVENT";
                break;

    		default:
								
                $userArray = array();

    			break;			

    	}
		
		if (count($userArray) > 0) {
		            	
			$body = array(

                "type" => $type, 
                "message"  => $message,
                "id"       => $Id,
                "json"     => $user                   
            );
        	
        	send_notification($userArray, $body, $title);
		}            

    }

}
