<?php

namespace App\Http\Controllers\Api\Common;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Http\Controllers\General\VerifyController As VerifyController;
use App\Events\UserEvent;
use App\Http\Resources\User as UserResource;
use App\User;
use JWTAuth, Image, Cookie, config;
use App\Models\User As UserModel;

use Tymon\JWTAuth\Exceptions\JWTException;

/* 
    THIS CONTROLLER IS USED FOR AUTHENTICATE USER ETC  
    - Dev: By pankaj gawande        
*/

class AuthController extends BaseController
{    
    /**
    * @Description: this function is used to register user (admin, passenger and driver). 
    * 
    */

    public function register(UserRequest $request){     
        
        $user = $request->all();       
        $user['password'] = bcrypt(@$user['password']);
        $user = User::Create($user);
        $obj = new VerifyController();
        $check = $obj->mobile($user->id);
        
        $credentials = array('mobile_number' => $user['mobile_number'],
                            'password' => $request->password);
                                  
        return $this->getUser($credentials, 3);
    }
    
    /*
    * @Desc: This function is used to login
    * @Dev: Pankaj Gawande
    */



    public function login(UserRequest $request){
        
        if($user['user_type'] != 1){
        
            $user['password'] = $user['password'];
        }
        return $this->getUser($user, 1);              
    }
    
    public function getUser($credentials, $type) {
                
        if (!$token = JWTAuth::attempt($credentials)) {

            return $this->sendError('Oops! You have entered incorrect login credentials', 401);
        }else{
    
            $user = JWTAuth::user();            

            if ($user->user_type == '2') {

                $data = UserModel::with(

                    'societyAdmin:id,user_id,society_id',
                    'societyAdmin.society:id,title'
                )
                        ->find($user->id);
            }else{

                $data = UserModel::find($user->id);
            }                        

            $data->token = $token;
               
            if ($type == 1) {                
                                
                if ($user->status == '1') {

                    $message = "Login successfully";                 
                
                }else{

                   return $this->sendError('Oops! Your account is inactive now, please contact to administrator', 401); 
                }

            }else{
                
                event(new UserEvent($data));
                       
                $message = "Registered successfully";

            }

          
            return $this->sendResponse($message, new UserResource($data));          
        }

    }

    /*
    * @Desc: This function is used to send request for forgot password
    * @Dev: Pankaj Gawande
    */

    public function forgotPassword(UserRequest $request){
                
        $user = User::where($request->all())->first(['id']);
        
        if (empty($user)) {            

            $message = "Oops! Looks like you have not registered with us.";
            return $this->sendError($message, 401);
            
        }else{

            $obj = new VerifyController();
                
            if (empty($request->email)) {
                
                $obj->mobile($user->id);
                $value = $request->mobile_number;
                

            }else{

                $obj->email($user->id , $request->email);
                $value = $request->email;
            }
            
            $message = "We have sent you a verification code on $value"; 

            return $this->sendResponse($message);   
        }
        
    }

    public function resetPassword(UserRequest $request){

        if ($request->email != "") {
            
            $where = array('email' => $request->email);    
        
        }else{

            $where = array('mobile_number' => $request->mobile_number);
        }

        if ($request->verification_code == config('constants.MASTER_VERIFICATION_CODE') && config('constants.APP_MODE') == "DEVELOPEMENT") {
            
        }else{
            
            $where['verification_code'] = $request->verification_code;            
        }
        
        $update = array('password' => bcrypt($request->password));

        $check = User::where($where)->update($update);

        if ($check) {
            
            return $this->sendResponse('Great! Your password has been reset successfully');
        
        }else{

            return $this->sendError("Oops! You have entered incorrect verification code", 401);
        }
    }

    /*
    * @DESC: This function is used to verify mobile
    * @Dev: Pankaj Gawande
    */

    public function verify(UserRequest $request){        
        
        $obj = new VerifyController();
        
        $check = $obj->verifyIt($request);

        // d($check);die;
        if ($check) {
            
            if ($request->for == 1) {
                
                return $this->sendResponse('Great! Your mobile number has been verified successfully');

            }else{                
                
                return $this->sendResponse('Great! Your email has been verified successfully');
            }
        
        }else{

            return $this->sendError('Oops! You have entered incorrect verification code', 401);
        }
    }
      
    function resendCode(UserRequest $request){        
             
        $user = $request->get('user');
        $type = $request->get('type');
        
        $verify = new VerifyController();

        if ($type == "mobile") {
            
            $message = 'We have resend you a verification code on your registered mobile number';
            $check = $verify->mobile($user->id);
        
        }else{

            $message = 'We have resend you a verification code on your registered email id';
            $check = $verify->email($user->id , $user->email);
        }
        
        if ($check) {

            return $this->sendResponse($message);

        }else{

            return $this->sendError('Oops! Failed to resend verification code', 401);
        }    

    }

    /**/

    public function changePassword(UserRequest $request){
        
        $user = $request->get('user');
        
        $credentials = array(            
            "email" => $user->email,
            "password" => $request->current_password,
        );
        
        if (! $token = JWTAuth::attempt($credentials)) {

            return $this->sendError("Oops ! Failed to change password", 401);
        
        }else{

            $user = User::find($user->id);
            $user->password = bcrypt($request->new_password);
            $user->save();

            return $this->sendResponse("Great ! You have been change password successfully");
        }
    
    }

    public function logout(Request $request){
        
        $user = $request->get('user');        
                
        return $this->sendResponse('Logout Successfully');
    }
  

}

