<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

        $segment = Request::segment('2');

        switch ($segment) {
            
            case 'login':                

                $rules = [
                      
                    "email" => 'required',                        
                    "password" => "required",
                    "user_type" => "required|in:1,2,3,4"                             
                ];

                break;

            case 'register':                  

                $rules = [

                    "first_name" => "required",          
                    "last_name" => "required",          
                    "email" => "email|unique:users,email",          
                   // "password" => "required",          
                    "user_type" => "required|in:1,2,3,4",                   
                    "country_code" => "required",                      
                    "mobile_number" => "required|unique:users,mobile_number",
                ];               

                break;

            case 'forgot-password':                

                $rules = [
            
                   "email"          => "required",                   
                   "user_type"      => 'required|in:1,2,3,4'                      
                ];
                
                break;

            case 'reset-password':                

                $rules = [
            
                    "email"               => "required", 
                    "password"            => "required", 
                    //"mobile_number"       => 'digits:9',
                    "verification_code"   => 'required|digits:4'                      
                ];
                
                break;

            case 'verify':                

                $rules = [
        
                    "code" => 'required|digits:4',
                    "for" => 'required|in:1,2'                      
                ];
                
                break;

            case 'user':                

                $user = Request::get('user');
                
                $rules = [
        
                    "first_name" => "required",          
                    "last_name" => "required",          
                    "gender" => "required|in:1,2",                    
                    "address" => "required",
                    'date_of_birth' => "required",
                    'education' => "required",
                    'occupation' => "required",
                    'language' => "required",
                    'religion' => "required",
                    'height' => "required",
                    'interested_in' => "required",
                    'smoke' => "required",
                    'drink' => "required",
                    'about_me' => "required"                       
                                        
                ];
                     
                break;
            
            case 'change-password':                

                $rules = [
        
                    "current_password" => 'required',                      
                    "new_password" => 'required',                      
                ];
                
                break;
            
            case 'upload-profile-image':            

                $rules = [
    
                    "profile" => 'required',                        
                ];                

                break;

            case 'change-mobile-number':            

                $rules = [
    
                    "mobile_number" => 'required',
                    'country_code' => 'required',
                ];                

                break;

            case 'change-email':            

                $rules = [
    
                    "email" => 'required|email',                        
                ];                

                break;

            case 'resend-otp':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',  
                ]; 
                
                break;

            case 'web-login':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',
                    "verification_code"   => 'required|digits:4'
                ]; 
                
                break;

            case 'web-register':

                $rules = [
    
                    "mobile_number" => "required|unique:users,mobile_number|digits:10",
                    "full_name" => 'required',    
                    "otp" => 'required|digits:4',
                ]; 
                
                break;

            case 'send-otp':

                $rules = [
    
                    "mobile_number" => "required|unique:users,mobile_number|digits:10",
                ]; 
                
                break;

            case 'create-enquiry':

                $rules = [
        
                    //"first_name" => 'required',
                    "mobile_number" => 'required|digits:10',
                    "description" => 'required',
                    "category_id" => 'required',
                ]; 
                
                break;

            case 'get-user-info':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',
                ]; 
                
                break;

            case 'support-list':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',
                ]; 
                
                break;

            case 'support-chat':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',
                    "message" => 'required',
                ]; 
                
                break;
                
            case 'enquiry-list':

                $rules = [
        
                    "mobile_number" => 'required|digits:10',
                ]; 
                
                break;

            case 'delete-enquiry':

                $rules = [
        
                    "enquiry_id" => 'required',
                ]; 
                
                break;

            case 'enquiry-detail':

                $rules = [
        
                    "enquiry_id" => 'required',
                ]; 
                
                break;
                
            default:
                
                $rules = [];
                break;
        }
        
        return $rules;
    }
}
