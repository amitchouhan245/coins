<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ User };
use Mail;

/*
* This controller is used to verify user.
*/
class VerifyController extends Controller
{
    
    public function mobile($userId){

        die($userId);
    	$code = random_code();
    	
    }

    public function email($userId , $email = null){
        echo $email; die($userId);
        $flag = false;
    	$code = random_code();

    }       

}
