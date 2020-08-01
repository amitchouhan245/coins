<?php

namespace App\Http\Controllers\Api\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ User, Verification };
use Image;

class BaseController extends Controller {
  
  public function sendResponse($message, $result = ""){

    $response = [

      'success' => true,          

      'message' => $message,

      'code'    => 200

    ];

    if (!empty($result)) {
      
      $response['result'] = $result;         

    }

    return response()->json($response, 200);

  }

  /*
  * @Desc: to send error or expected operation did not happened
  */
  
  public function sendError($error, $code = 404, $errorMessages = []){

    $response = [

          'success' => false,
          'message' => $error,
          'code'    => $code
      ];

      if(!empty($errorMessages)){

          $response['data'] = $errorMessages;
      }

      return response()->json($response, $code);
  }

  public function insert_verification($user, $type){

    $code = rand(1111, 9999);

    $data = array(
      
      'user_id'     => $user->id,         
      'code'        => $code,
      'created_at'  => date('Y-m-d H:i:s'),
      'updated_at'  => date('Y-m-d H:i:s'),
      'deleted_at'  => null,

    );

    Verification::UpdateOrCreate(['user_id' => $user->id], $data);
   
    return $code;
  }

  public function uploadFile($file, $type){
    
    $image = "";

    if($file && $file != "") {
      
      $image  = getTimeStamp().".".$file->getClientOriginalExtension();
    
    }

    if (!empty($image)) {
      
      switch ($type) {

        case 'profile':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();
            
            Image::make($file)->resize(200, 200)->save('public/uploads/profiles/thumbnails/'.$image);

            $file->move('public/uploads/profiles', $image);
            
            $image;

          }
          
          break;

        case 'aadhar_card':  

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();
            
            Image::make($file)->resize(200, 200)->save('public/uploads/aadhar_card/thumbnails/'.$image);

            $file->move('public/uploads/aadhar_card', $image);
            
            $image;

          }
        
        break;

        case 'category':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();
            
            Image::make($file)->resize(200, 200)->save('public/uploads/category/thumbnails/'.$image);

            $file->move('public/uploads/category', $image);
            
            $image;

          }
          
        break;

        case 'serviceDocs':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();
            
            Image::make($file)->resize(200, 200)->save('public/uploads/serviceDocs/thumbnails/'.$image);

            $file->move('public/uploads/serviceDocs', $image);
            
            $image;
          }
          
        break;

        case 'partner':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();
            
            Image::make($file)->resize(200, 200)->save('public/uploads/partner/thumbnails/'.$image);

            $file->move('public/uploads/partner', $image);
            
            $image;

          }
          
        break;


        case 'enquiry_document':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();

            Image::make($file)->resize(200, 200)->save('public/uploads/enquiry_document/thumbnails/'.$image);

            $file->move('public/uploads/enquiry_document', $image);
            
            $image;

          }
          
          break;

         case 'banner':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();

            Image::make($file)->resize(300, 100)->save('public/uploads/banner/thumbnails/'.$image);

            $file->move('public/uploads/banner', $image);
            
            $image;

          }
          
          break;

          case 'advertisement':                

          if($file && $file != "") {

            $image  = getTimeStamp().".".$file->getClientOriginalExtension();

            Image::make($file)->resize(300, 100)->save('public/uploads/advertisement/thumbnails/'.$image);

            $file->move('public/uploads/advertisement', $image);
            
            $image;

          }
          
          break;

        default:
          
          $image = "";
                     
          break;
      }
    }

    return $image;

  }
}
