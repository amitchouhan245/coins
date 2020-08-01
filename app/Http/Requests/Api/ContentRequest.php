<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Request;

class ContentRequest extends FormRequest
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
    public function rules()
    {
         $segment = Request::segment('2');

        switch ($segment) {
            
            case 'states':
                
                $rules = [
                    "country_id" => "required"
                ];

                break;

            case 'cities':
                
                $rules = [
                    "state_id" => "required"
                ];
                
                break;

            case 'app-info':
                
                $rules = [

                    "email"   => "required",
                    "web_url" => "required",
                    "address" => "required",
                ];
                
                break;

            case 'update-device':
                
                $rules = [

                    "device_type" => "required|in:android,iphone",
                    "notification_id" => "required"                    
                ];
                
                break;

            case 'delete-notification':
                
                $rules = [

                    "notification_id" => "required"                    
                ];
                
                break;

            case 'rules-regulation':
                
                $rules = [

                    "society_id" => "required"                    
                ];
                
                break;
            
            default:
                
                $rules = [];
                break;
        }

        return $rules;
    }
}
