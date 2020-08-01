<?php

namespace App\Http\Controllers\Api\Common;

use App\Models\{ User, Content, AppInfo, Configuration, Education, Language, Height, Religion };
use App\Http\Controllers\Api\Common\BaseController;

use App\Http\Requests\Api\{ ContentRequest };

class ContentController extends BaseController {

    
    public function baseUrl(){

    	$res = array("success" => true, 'message' => trans('messages.BASE_URL'));

    	$res['result'] = [

    		"base_url" => url('/api').'/',             
            "profile" => url('/public/uploads/profiles').'/',
            "profile-thumbnail" => url('/public/uploads/profiles/thumbnails').'/',         
    	];	

    	return $res;
    }

    public function content(Request $request, $type){

        $data = Content::where('type', $type)->first();

        if (!empty($data)) {
            
            return $this->sendResponse(trans('messages.CONTENT'), $data);
            
        }else{
            
            return $this->sendError(trans('messages.FAILED_CONTENT'), 401);
        }
    }

    public function appInfo(Request $request){

        $data = AppInfo::first();
        
        return $this->sendResponse(trans('messages.CONTENT'), $data);        
    }    

    public function config(){
        
        $data = Configuration::first(['id','type', 'value']);

        return $this->sendResponse(trans('messages.CONTENT'), $data);
    }

    public function updateDevice(ContentRequest $request){

        $user = $request->get('user');
        $check = User::where('id', $user->id)->update($request->all());

        if ($check) {
            
            return $this->sendResponse(trans('messages.UPDATE_DEVICE'));
            
        }else{

           return $this->sendError(trans('messages.FAILED_DEVICE'), 401); 
        }
    }
    
    public function countries(){
        
        $data = $this->country_list();
        
        if ($data) {
            
            return $this->sendResponse('Country list found', $data);
            
        }else{

           return $this->sendError('Country list not found', 401); 
        }
    }

    public function states(ContentRequest $request){
        
        $data = $this->state_list();
        
        if ($data) {            
            return $this->sendResponse('State list found', $data);            
        }else{
           return $this->sendError('State list not found', 401); 
        }
    }

    public function cities(ContentRequest $request){
      
        $data = $this->city_list();
        
        if ($data) {            
            return $this->sendResponse('City list found', $data);            
        }else{
           return $this->sendError('City list not found', 401); 
        }
    }

   

}
