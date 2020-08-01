<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Models\{ User,State };
use Datatables;

class UserController extends BaseController {

    public function index(Request $request) {

        if ($request->ajax()) {

            $content = User::orderBy('id', 'DESC')->where('user_type',3)->withTrashed()->get();

            return Datatables::of($content)

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));
            })

            ->editColumn('user_type', function($data){

                return view('Admin.datatables.actions.user_type', compact('data'));
            })

            ->addColumn('action', function ($data) {

                return view('Admin.datatables.actions.user', compact('data'));
            })

            ->addColumn('bulk_delete', function($data) {

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })
             
            ->rawColumns(['status','action','bulk_delete','user_type'])
            ->addIndexColumn()
            ->make(true); 
        }
        
        $data['title'] = "User List";

        return view('Admin.list.user_list', $data);  
    }

    public function create(Request $request) {

        $user_id = $request->segment('4');
        
        if(!empty($user_id)){
            
            $data['title'] = "Edit User";
            $data['users'] = User::where('id',$user_id)->first();    

        }else{

            $data['title'] = "Add User";
        }
        
        return view('Admin.addUpdate.add_update_user', $data);  
    }

    public function store(UserRequest $request) {

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['country_code'] = $request->country_code;
        $data['mobile_number'] = $request->mobile_number;
        $data['user_name'] = $request->user_name;
        $data['status'] = '1';
        $data['user_type'] = $request->user_type;
        $data['created_at'] = date('y-m-d h:i:s');
        $data['password'] = bcrypt($request->password);
        $data['is_mobile_verified'] = '1';


        $insert = User::insert($data);

        if ($insert) {   
                
            return $this->sendResponse('Great! A record has been added successfully');
        
        }else{

            return $this->sendError('Oops! Failed to added a record', 401);
        }   
    }

    public function show(Request $request) {
        
        $data['title'] = "User Detail";
        $id = $request->segment('3');
        $data['user_data'] = User::where('id',$id)->first();
        
        return view('Admin.details.user_detail', $data);  
    }

    public function edit(Request $request) {

        $data['title'] = "Edit User";
        $id = $request->segment('3');
        $data['users'] = User::where('id',$id)->first(); 

        return view('Admin.addUpdate.add_update_user', $data);  
    }

    public function update(UserRequest $request) {
        
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['country_code'] = $request->country_code;
        $data['mobile_number'] = $request->mobile_number;
        $data['user_name'] = $request->user_name;
        $data['user_type'] = $request->user_type;
                $data['status'] = '1';
        $update = User::where('id',$request->id)->update($data);

        if ($update) {   
                
            return $this->sendResponse('Great! A record has been updated successfully');
        }else{

            return $this->sendError('Oops! Failed to update a record', 401);
        } 
    }

    public function driversList(Request $request) {

        if ($request->ajax()) {

            $content = User::orderBy('id', 'DESC')->where('user_type',2)->withTrashed()->get();

            return Datatables::of($content)

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));
            })

            ->editColumn('user_type', function($data){

                return view('Admin.datatables.actions.user_type', compact('data'));
            })

            ->addColumn('action', function ($data) {

                return view('Admin.datatables.actions.driver', compact('data'));
            })

            ->addColumn('bulk_delete', function($data) {

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })
             
            ->rawColumns(['status','action','bulk_delete','user_type'])
            ->addIndexColumn()
            ->make(true); 
        }
        
        $data['title'] = "Driver List";

        return view('Admin.list.driver_list', $data);  
    }

    public function addDriver(Request $request) {
        
        $user_id = $request->segment('3');
        
        if(!empty($user_id)){
            
            $data['title'] = "Edit Driver";
            $data['users'] = User::where('id',$user_id)->first();    

        }else{

            $data['title'] = "Add Driver";
        }
        
        return view('Admin.addUpdate.add_update_driver', $data);  
    }
}
