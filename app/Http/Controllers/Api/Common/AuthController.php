<?php

namespace App\Http\Controllers\Api\Common;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Http\Controllers\General\VerifyController As VerifyController;
use App\Events\UserEvent;
use App\Http\Resources\User as UserResource;
use App\Models\{User,Verification, MobileOtp};
use JWTAuth, Image, Cookie, config;
use App\Models\User As UserModel;

use Tymon\JWTAuth\Exceptions\JWTException;

/* 
    THIS CONTROLLER IS USED FOR AUTHENTICATE USER ETC  
    - Dev: By pankaj gawande        
*/

class AuthController extends BaseController {

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
                                  
        return $this->getUser($credentials, 1);
    }
    
    /*
    * @Desc: This function is used to login
    * @Dev: Pankaj Gawande
    */

    public function login(UserRequest $request){

        $user = $request->all();

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

                $data = UserModel::find($user->id);

            }else{

                $data = UserModel::find($user->id);
            }                        

            $data->token = $token;
               
            if (($type == 1) || ($type == 2) ) {                
                                
                if ($user->status == '1') {

                    $message = "Login successfully";                 
                
                }else{

                   return $this->sendError('Oops! Your account is inactive now, please contact to administrator', 401); 
                }

            }else{
                
                //event(new UserEvent($data));
                       
                $message = "Registered successfully";
            }
          
            return $this->sendResponse($message, new UserResource($data));          
        }
    }

    /*
    * @Desc: This function is used to send request for forgot password
    * @Dev: Pankaj Gawande
    */

/*    public function forgotPassword(UserRequest $request){
                
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
        
    }*/

      public function forgotPassword(UserRequest $request){

    $user = User::where(['email' => $request->get('email'), 
                         'user_type' => (Int)$request->user_type])
                ->first(['id']);

    if (!empty($user)) {
      
      //SEND EMAIL WITH VERIFICATION CODE
      
      //Save verification code
      $data = $this->insert_verification($user, "Forgot Password");      

      return $this->sendResponse('We have sent you a verification code on your email id, please check email inbox and reset your password', $data);

    }

    return $this->sendError('Oops! Your email id is not registered with us', 401);
  
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
      
    public function sendOtp(UserRequest $request) {

       $mobileNumber = $request->get('mobile_number');
       $code = rand('1111','9999');

       $check = MobileOtp::where('mobile_number',$mobileNumber)->first();

       if(!empty($check)){

            $data = MobileOtp::where('mobile_number',$mobileNumber)->update(['code' => $code]);

       }else{

            $insertData = [

                'mobile_number' => $mobileNumber, 
                'code' => $code 
            ];

            $data = MobileOtp::create($insertData);
       }
       
       if ($data) {

            return $this->sendResponse('We have send you a verification code on your mobile number. Otp : '. $code );
       }else{

            return $this->sendError('Oops! Something went wrong ', 401); 
       }
    }

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

    public function social(UserRequest $request){
        
        $socialId = $request->get('social_id');        
        
        if (empty($socialId)) {
            
           return $this->sendError('Redirect this to passenger sign page', 451);

        }else{

            $user = User::where('social_id', $socialId)->first();

            if (!empty($user)) {

                $user->token = JWTAuth::fromUser($user);
                return $this->sendResponse('Login successfully', $user);                                                        
            }else{
                
                return $this->sendError('Redirect this to passenger sign page', 451);                
            }            
        }
    }

    public function logout(Request $request){
        
        $user = $request->get('user');        
                
        return $this->sendResponse('Logout Successfully');
    }

    public function ResendOtp(UserRequest $request) {

        $user = User::where('mobile_number',$request->mobile_number)->first();
        $type = 'mobile';
  
        if(!empty($user)) {

            if ($type == "mobile") {

                $otp = rand(1000,9999);

                $verification =  Verification::where(['user_id' => $user->id, 'for' => 1 ])->first();
                
                if(!empty($verification)){

                   $ver =  Verification::where(['user_id' => $user->id, 'for' => 1 ])->update(['code' => $otp]);
                }else{

                    $data = [
                        
                        'user_id' => $user->id,
                        'for' => 1,
                        'code' =>$otp,
                    ];

                    $ver =  Verification::create($data);
                }

                $message = 'We have send you a verification code on your registered mobile number .'.'Otp : '.$otp;

                $update = User::where('id',$user->id)->update(['verification_code' => $otp]);
                
            }
            
            if ($ver) {

                return $this->sendResponse($message);

            }else{

                return $this->sendError('Oops! Failed to send verification code', 401);
            }  

        }else{

            return $this->sendError('Oops! Your mobile number is not registered with us', 401);
        }
    }
    
    public function WebLogin(UserRequest $request) {
        
        $code = $request->verification_code;
        
        $user = User::where('mobile_number',$request->mobile_number)->first();
   
        if(!empty($user)){

                $data = [

                    'mobile_number' => $request->mobile_number,
                    'password' => $request->mobile_number
                ];

            if ($code == config('constants.MASTER_VERIFICATION_CODE') && config('constants.APP_MODE') == "DEVELOPEMENT") {

                return $this->getUser($data, 2); 

            }else {

                $verification = Verification::where([
                    
                    'user_id' => $user->id

                ])->first(); 
   
                if(!empty($verification)) {

                    return $this->getUser($data, 2); 

                }else {

                    return $this->sendError('Oops! You have entered wrong otp', 401);
                }
            }

        }else{

            return $this->sendError('Oops! Your mobile number is not registered with us', 401);
        }
    }

    public function WebRegister(UserRequest $request) {

        $data = [

            'first_name'        => $request->full_name,
            'user_type'         => 2,
            'country_code'      => '91',
            'mobile_number'     => $request->mobile_number,
            'verification_code' => $request->otp,
            'password'          => bcrypt($request->mobile_number),
            'is_mobile_verified'=> '1'
        ];

        if ($request->otp == config('constants.MASTER_VERIFICATION_CODE') ) {

            $user = User::Create($data);

            $info = [

                'mobile_number' => $user->mobile_number,
                'password' => $user->mobile_number
            ];

            return $this->getUser($info, 3);
            
        }else{

            $check = MobileOtp::where([
            
                'mobile_number' => $request->mobile_number,
                'code' => $request->otp
            
            ])->first();

            if (!empty($check)) {

                $user = User::Create($data);
                
                $info = [

                    'mobile_number' => $user->mobile_number,
                    'password' => $user->mobile_number
                ];
                
                return $this->getUser($info, 3);
            
            }else{

                return $this->sendError('Oops! You have entered incorrect verification code ', 401);
            }
        }
    }
}

