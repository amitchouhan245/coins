<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Common\BaseController;
use App\Models\{ User,Block,Country,City,Flat,Floor,Society,Complaint };

class ActivityController extends BaseController {
    
    public function updateStatus(Request $request) {         

    	$type = $request->type;    	
    	$model_name = '\\App\\Models\\'.$type;
    	$model = new $model_name;

    	$check = $model->where('id', $request->id)
    		->update(['status' => $request->status]);
    
		if ($check) {
			
			$msg = 'Great! Status has been inactivated successfully';
			$data['icon'] = "warning";

			if ($request->status == 1) {	
				$msg = 'Great! Status has been activated successfully';
				$data['icon'] = "success";
			}

            if ($request->status == 2) {               
                $msg = 'Great! Status has been cancel successfully';
                $data['icon'] = "success";
            }

    		return $this->sendResponse($msg, $data);			

		}else{

    		return $this->sendError('Oops! Failed to update status', 401);
		}    	
    }
    
    public function complaintStatus(Request $request){
        
        $type = $request->type;     
        $model_name = '\\App\\Models\\'.$type;
        $model = new $model_name;
        
        $check = $model->where('id', $request->id)
            ->update(['status' => $request->status]);
    
        if ($check) {
            
            $msg = 'Great! Status has been inactivated successfully';
            $data['icon'] = "warning";

            if ($request->status == 1) {    
                $msg = 'Great! Status has been activated successfully';
                $data['icon'] = "success";
            }

            if ($request->status == 2) {               
                $msg = 'Great! Status has been cancel successfully';
                $data['icon'] = "success";
            }

            return $this->sendResponse($msg, $data);            

        }else{

            return $this->sendError('Oops! Failed to update status', 401);
        }
    }
    public function deleteRecord(Request $request){

    	$type = $request->type;    	
    	$model_name = '\\App\\Models\\'.$type;
    	$model = new $model_name;

    	$check = $model->where('id', $request->id)
    		->delete();
    
		if ($check) {	
        		
    		return $this->sendResponse('Great! A record has been deleted successfully');
		}else{

    		return $this->sendError('Oops! Failed to delete a record', 401);
		} 
    }

    public function restoreRecord(Request $request){

        $type = $request->type;        
        $model_name = '\\App\\Models\\'.$type;
        $model = new $model_name;

        $check = $model->withTrashed()
                    ->where('id', $request->id)
                    ->restore();
            
        if ($check) {            
            return $this->sendResponse('Great! A record has been restored successfully');           
        }else{
            return $this->sendError('Oops! Failed to restore a record', 401);
        } 
    }

    public function bulkdeleteRecord(Request $request){

        $type = $request->type;   

        $model_name = '\\App\\Models\\'.$type;
        $model = new $model_name;

        $check = $model->whereIn('id', $request->id)
            ->forceDelete();

        if ($check) {
            
            return $this->sendResponse('Great! All record has been  deleted successfully');            

        }else{

            return $this->sendError('Oops! Failed to delete a record', 401);

        } 
    }

}
