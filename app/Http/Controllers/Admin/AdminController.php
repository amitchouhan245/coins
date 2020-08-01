<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Society,Block,Floor,Flat, Category,Enquiry};
use Datatables,Session,Response,Redirect;
use JWTAuth, Image, Cookie, config;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\Api\Common\BaseController;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use Carbon\Carbon;

class AdminController extends BaseController {
    
    public function dashboard(Request $request) { 

        $segment = $request->segment('1');

        if($segment == "admin") {

            $data['title'] = "Dashboard"; 
            $data['users'] = User::where(['user_type' => 2, 'status' => '1'])->count();
                    
    	    return view("Admin.layout.index",$data);

        }
    }

    public function login() {
        
        return view("Admin.layout.login");
    }

    public function forgotPassword(Request $request) {
    	
    	return view("Admin.layout.forgot_password",['title' => 'Forgot Password']);
    }

    public function resetPassword(Request $request) {
        
        return view("Admin.layout.reset-password",['title' => 'Reset Password']);
    }

    public function changePassword(Request $request) {
        
        return view('Admin.layout.change-password',['title' => 'Change Password']);
    }

    public function setSession(Request $request) {

        $segment = $request->segment('1');
        $userSession = array( $segment => $request->all());                
        
        //Session::put($userSession);
      
        $request->session()->put($userSession);
        $res['success'] = true;

        $cookie = json_encode([

            'email'             => $request->email,
            'password'          => $request->password,
            'remember_me'       => $request->remember_me,
            'mobile_number'     => $request->mobile_number

        ]);
        
        return Response::json($res)->cookie('admin',$cookie, 60);
    }

    public function profile(Request $request){

        $data['title']  = "Edit Profile";
        $user = Session::get($request->segment('1'));
        $data['profileInfo'] = User::where('id',$user['id'])->first();
        
        return view('Admin.layout.edit-profile',$data);
    }

    public function logout(Request $request){
        
        Session::flush();       
        return Redirect('admin/login');
    }

     public function updateProfile(UserRequest $request){   
        
        $userId = $request->get('user_id');        
        $user = User::find($userId);
        $user->first_name = $request->first_name;   
        $user->last_name = $request->last_name;   
        $user->email  = $request->email;
        $user->mobile_number = $request->mobile_number;   
        $user->country_code = $request->country_code;
        
        $user->save();

        return $this->sendResponse('Great! User profile has been updated successfully', $user);
    }

    public function DashboardCount(Request $request){

        $start_date = $request->get('start_date');
        $end_date   = $request->get('end_date');

        $data['resident'] = User::where(['user_type' => '4', 'status' => '1'])
                                ->whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)          
                                ->count();

        $data['society_admin'] = User::where(['user_type' => '2','status' => '1'])
                                ->whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)                            ->count(); 
        $data['supervisior'] = User::where(['user_type'=>'3','status' => '1'])
                                ->whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)
                                ->count();    

        $data['guard']  =   User::where(['user_type' => '5','status' => '1'])
                                ->whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)
                                ->count();
        
        $data['society'] = Society::whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)
                                ->count();

        $data['block'] = Block::whereDate('created_at','>=', $start_date)
                                ->whereDate('created_at','<=', $end_date)
                                ->count();

        $data['floor'] = Floor::whereDate('created_at','>=', $start_date)
                                ->whereDate('created_at','<=', $end_date)
                                ->count();

        $data['flat'] = Flat::whereDate('created_at','>=', $start_date)
                            ->whereDate('created_at','<=', $end_date)
                            ->count();                                                                      
        return Response::json($data);
    }

    public function notification(Request $request){
    
        $data['title'] = "Notification";
        return view('Admin.details.notification',$data);
      
    }
}
