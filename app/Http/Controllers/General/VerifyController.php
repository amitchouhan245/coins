<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ User, Verification, UserSetting };
use Mail;

/*
* This controller is used to verify user.
*/
class VerifyController extends Controller {
    
    public function mobile($userId){
        
        $flag = false;
    	$code = random_code();
    	$where = ['user_id' => $userId, 'for' => '1'];    	
        $data = [   

    		"code" => $code,    		
    		"created_at" => date('Y-m-d H:i:s')
    	];

    	$check = Verification::updateOrCreate($where, $data);
        
        if ($check) {

        $message = trans('messages.VERIFYMOBILE',['code' => $code]);

            send_sms($userId, $message);
                                   
            $flag = true;
        }

        return $flag;
    }

    public function email($userId , $email = null){

        $flag = false;
    	$code = random_code();
    	$where = ['user_id' => $userId, 'for' => '2'];
    	
    	$data = [

    		"user_id"    => $userId,
    		"code"       => $code,
    		"for"        => '2',
    		"created_at" => date('Y-m-d H:i:s')
    	];        

    	$check = Verification::updateOrCreate($where, $data);

        if ($check) {

            $message = trans('messages.VERIFYEMAIL',['code' => $code]);

             // SEND MAIL HERE
            if(!empty($userId)){

                $checkData = User::where(array('email' => $email))
                            ->update(array('verification_code' => $code));

                if($checkData){
       
                  $data['email']    = $email;
                  $codeotp             = $code;
                  Mail::send('emails.user.forgot_password', ['code' => $codeotp], function ($message) use($data){

                       $message->to($data['email'])
                               ->subject('OTP');            
                  });
                }
            }

            $flag = true;            
        }
        
        return $flag;
    }

    public function verifyIt($request){                
        
        $flag = false;

        $user = $request->get('user');

        $for = $request->get('for');
        $code = $request->get('code');

        $where = array('user_id' => $user->id, 'for' => $for);        
        
        if ($code != config('constants.MASTER_VERIFICATION_CODE')) {       

            $where['code'] = $code;
        }

        $check = Verification::where($where)->first(['id']);          
        
        // d($check);die;
        if ($check) {            
            
            if ($for == 1) {

                User::where('id', $user->id)->update(['is_mobile_verified' => '1']); 
            }else{
                
                User::where('id', $user->id)->update(['is_email_verified' => '1']);
            }

            $flag = true;
        }

        return $flag;
    }

    public function user_setting($userId){

        UserSetting::create(array('user_id' => $userId));
    }    
}
