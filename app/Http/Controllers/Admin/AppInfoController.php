<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Api\ContentRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Models\AppInfo;


class AppInfoController extends BaseController {

    public function appInfo(Request $request) {
    	
    	$data['title'] = "App Info";
    	$data['appData']= AppInfo::first();
    	
    	return view("Admin.settings.app_info",$data);
    }

	public function addUpdateAppInfo(ContentRequest $request){

        if(!empty($request->appInfo_id)){

        	
	       	$data = AppInfo::where('id',$request->appInfo_id)->update([


	           'contact_number' => $request->contact_number,
	           'email'   => $request->email,
	           'address' => $request->address,
	           'web_url' => $request->web_url,
	           'updated_at'   => date('Y-m-d H:i:s'),

	       	 ]);

	       	return $this->sendResponse('The AppInfo has been updated successfully');
       
       }else{ 

	       	$data = AppInfo::insert([

	           'contact_number' => $request->contact_number,
	           'email'   => $request->email,
	           'address' => $request->address,
	           'web_url' => $request->web_url,
	           'created_at'   => date('Y-m-d H:i:s'),
	           'updated_at'   => date('Y-m-d H:i:s')
	           
	       	 ]);

	       	return $this->sendResponse('The AppInfo has been added successfully');
        }  
    }
}
