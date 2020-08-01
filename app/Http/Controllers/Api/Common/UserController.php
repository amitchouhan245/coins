<?php

namespace App\Http\Controllers\Api\Common;

use App\Models\{ User, UserInfo, UserImage };
use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\Api\Common\BaseController;
use App\Http\Controllers\General\VerifyController;
use App\Http\Resources\User as UserResource;
use Image;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->get('user');

        $profile = User::where('id', $user->id)
                    ->with('userInfo','profiles')
                    ->first();

        return $this->sendResponse(trans('messages.INDEX_PROFILE'), new UserResource($profile)); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {   
        $user = $request->get('user');

        $userUpdate = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
        ];

        $check = User::where('id', $user->id)->update($userUpdate);

         if($check){

            $userInfo = [
                'gender' => $request->gender,
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'education' => $request->education,
                'occupation' => $request->occupation,
                'language' => $request->language,
                'religion' => $request->religion,
                'height' => $request->height,
                'interested_in' => $request->interested_in,
                'smoke' => $request->smoke,
                'drink' => $request->drink,
                'about_me' => $request->about_me
            ];

            UserInfo::updateOrCreate(['user_id' => $user->id], $userInfo);

            return $this->sendResponse('Great! User detail updated successfully');
          
          }else{

            return $this->sendError('Oops! Failed to updated user details', 401);
          }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadProfileImage(UserRequest $request){

        $user = $request->get('user');
        $userImageId = $request->get('user_image_id');
        $flag = false;

        $count = UserImage::where('user_id', $user->id)->count();

        if ($count < 5 || !empty($userImageId)) {
            
            if($request->file('profile') != "" && $request->file('profile') != null){
                
                $profile = $this->uploadFile($request->file('profile'), 'profile');

                UserImage::updateOrCreate(['id' => $userImageId], 
                    ['user_id' => $user->id,
                    'image' => $profile,
                    'status' => '0',
                    'reason' => null]);        
                
                $flag = true;
            }

            if ($flag) {
                
                $data = UserImage::where('user_id', $user->id)->get();

                return $this->sendResponse('Nice! Profile image uploaded successfully', $data);

            }else{

                return $this->sendError('Oops! Failed to upload profile image', 401);
            }

        }else{

            return $this->sendError('Oops! You can upload maximum 5 profile images', 401);
        }

    }

    public function supportChat(Request $request) {

      $user = $request->get('user');
      return $this->sendResponse('Nice! Profile image uploaded successfully', $user);
      
    }
}
